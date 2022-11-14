<?php

namespace App\Models;

use App\Models\Client;
use App\Models\typeDocument;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];
    protected $table = "documents";

    /**
     * Get the client associated with the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'IDClient');
    }

    /**
     * Get the typeDocument associated with the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function typeDocument()
    {
        return $this->hasOne(TypeDocument::class, 'id', 'IDType');
    }
}
