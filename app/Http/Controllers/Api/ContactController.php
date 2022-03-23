<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(Request $request){
        $data = $request->validate( [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'attachment' => 'nullable|file'
        ]
        );
        $newContact = new Contact();
        $newContact->fill($data);

        if(key_exists('attachment', $data)) {
            $newContact->attachment = Storage::put('contactAttachments', $data['attachment']);
        }

        $newContact->save();
        return response()->json($newContact);
    }
}
