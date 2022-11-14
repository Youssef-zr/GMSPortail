<?php

namespace App\Models;

use App\Models\File;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];
    protected $table = "tickets";

    /**
     * Get all of the files for the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class, 'IDTicket', 'id');
    }

    /**
     * Get the client associated with the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(client::class, 'id', 'IDClient');
    }

    /**
     * Get the service associated with the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'IDService');
    }

    /**
     * Get all of the replies for the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(LTicket::class, 'IDTicket', 'id');
    }

    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'IDUtilisateur');
    }
    /**
     * Get the lastReplyName associated with the Ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lastReply()
    {
        $lastReply = LTicket::where('IDTicket', $this->id)->latest()->first();

        if ($lastReply->IDUtilisateur != null) {
            return ['from' => $lastReply->admin->name, "lastUpdateDate" => $lastReply->created_at->format('Y-m-d H:i')];
        } elseif ($lastReply->IDClient != null) {
            return ['from' => $lastReply->client->raison_sociale, "lastUpdateDate" => $lastReply->created_at->format('Y-m-d H:i')];
        }
    }
}
