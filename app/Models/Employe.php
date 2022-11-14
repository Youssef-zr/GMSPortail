<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $guarded = [];
    protected $table = "employes";
   
    /**
     * Get the client associated with the Employe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'IDClient');
    }

    /**
     * Get the site associated with the Employe
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function site()
    {
        return $this->hasOne(Site::class, 'id', 'IDSite');
    }
}
