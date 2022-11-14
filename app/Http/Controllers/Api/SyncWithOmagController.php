<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class SyncWithOmagController extends Controller
{
    // get list of clients omag id to be synchronized with omag db
    public function clientsLocalSync()
    {
        $token = request()->get('token');
        if ($token != "") {
            $checkHashedValue = Hash::check(Config::get('values.API_value'), $token);

            if ($checkHashedValue) {
                $clients = Client::where('sync', "1")->pluck("code_client_omag")->toArray();
                $ids = [];
                foreach ($clients as $client) {
                    array_push($ids, intval($client));
                }

                return response()->json($ids, 200);
            }
        }

        return response()->json(['error' => "not autorized please contact your administrator"], 404);
    }

    public function setClientsOmagSites(Request $request, $clients)
    {
        $token = request()->get('token');

        if ($token != "") {
            $checkHashedValue = Hash::check(Config::get('values.API_value'), $token);

            if ($checkHashedValue) {

                // omag clients sites synchronized
                $omagClientsSites = json_decode($clients);

                foreach ($omagClientsSites as $clientSites) {

                    // client info
                    $code_client_omag = $clientSites->code_client_omag;
                    $client = Client::where("code_client_omag", $code_client_omag)->first();

                    // client sites list
                    $omagSitesList = $clientSites->sites_list;

                    if (count($omagSitesList) > 0) {

                        // remove old client sites
                        $oldClientSites = Site::where('IDClient', $client->id)->get();
                        foreach ($oldClientSites as $site) {
                            $site->delete();
                        }

                        // set new sites to this client
                        foreach ($omagSitesList as $omagSite) {
                            $newSite = new Site();
                            $newSite->IDClient = $client->id;
                            $newSite->libelle = $omagSite->libelle;
                            $newSite->save();
                        }

                        // change client syn status
                        $client->fill(['sync' => "0"])->save();
                    }

                }

                // success
                return response()->json(["status" => "data synchronized with omag successfully", "omagClientsSites" => $omagClientsSites], 200);
            }
        }

        // bad token
        return response()->json(['error' => "not autorized please contact your administrator"], 404);
    }
}
