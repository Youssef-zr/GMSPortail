<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = "sites";
    protected $guarded = [];

    /**
     * Get the client associated with the Site
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'IDClient');
    }
}
