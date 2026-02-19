<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileRepository
{
    public function storeTicketFiles($ticket, $attachments, $userId)
    {
        $storedFiles = [];

        foreach ($attachments as $attachment) {
            $originalName = $attachment->getClientOriginalName();
            $extension = $attachment->getClientOriginalExtension();
            $size = $attachment->getSize();

            // Generate unique filename
            $fileName = uniqid().'_'.time().'.'.$extension;

            // Store in storage/app/public/tickets/{ticket_id}/
            $path = $attachment->storeAs(
                'tickets/'.$ticket->id,
                $fileName,
                'public'
            );

            // Create file record
            $file = File::create([
                'name' => $fileName,
                'extension' => $extension,
                'size' => $size,
                'user_id' => $userId,
                'fileable_id' => $ticket->id,
                'fileable_type' => get_class($ticket),
                'status' => 1, // 1 = active
            ]);

            $storedFiles[] = $file;
        }

        return $storedFiles;
    }

    public function getFileUrl($file)
    {
        return Storage::disk('public')->url('tickets/'.$file->fileable_id.'/'.$file->name);
    }
}
