<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $guarded = [];
    protected $table = "plannings";
    protected $casts = [
        'days' => "array",
    ];

    /**
     * Get the client associated with the Planning
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'IDClient');
    }
}
