<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\NewSiteContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(Request $request){
        $data = $request->validate( [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'attachment' => 'nullable'
        ]
        );
        $newContact = new Contact();
        $newContact->fill($data);

        if(key_exists('attachment', $data)) {
            $newContact->attachment = Storage::put('contactAttachments', $data['attachment']);
        }

        $newContact->save();

        Mail::to('admin@sito.com')->send(new NewSiteContactMail());

        return response()->json($newContact);
    }
}
