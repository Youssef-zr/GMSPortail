<?php

namespace App\Models;

use App\Models\Planning;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];
    protected $table = "clients";

    public function getCreatedAtAttribute()
    {
        return $this->created_at->format('Y-m-d H:m');
    }
    /**
     * Get all of the users for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'IDClient', 'id');
    }

    /**
     * Get the user associated with the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'IDClient', 'id');
    }

    /**
     * Get all of the employes for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employes()
    {
        return $this->hasMany(Employe::class, 'IDClient', 'id');
    }

    /**
     * Get all of the events for the Client
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Planning::class, 'IDCLient', 'id');
    }
}
