<?php

namespace App\Models;

use App\Traits\UploadFiles;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use UploadFiles;

    protected $table = "files";
    protected $guarded = [];

    public static function add_ReplyFiles($files, $reply_id, $ticket_id)
    {
        foreach ($files as $file) {
            $storagePath = "assets/dist/storage/tickets";
            $fileInformation = UploadFiles::storeFile($file, $storagePath);

            $newFile = new File();
            $fileInformation['IDTicket'] = $ticket_id;
            $fileInformation['lTicket'] = $reply_id;
            $newFile->fill($fileInformation)->save();
        }
    }

}
