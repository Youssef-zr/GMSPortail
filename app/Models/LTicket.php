<?php

namespace App\Models;

use App\Models\File;
use App\User;
use Illuminate\Database\Eloquent\Model;

class LTicket extends Model
{
    protected $table = "ltickets";
    protected $guarded = [];

    /**
     * Get the user associated with the LTicket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function admin()
    {
        return $this->hasOne(User::class, 'id', 'IDUtilisateur');
    }

    /**
     * Get the user associated with the LTicket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'IDClient');
    }

    /**
     * Get all of the files for the LTicket
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class, 'lTicket', 'id');
    }

    public function reply_user()
    {
        $userInfo = null;
        if ($this->admin() != null) {
            $userInfo = $this->admin();
        } else if ($this->client() != null) {
            $userInfo = $this->client();
        }

        return $userInfo;
    }
}
