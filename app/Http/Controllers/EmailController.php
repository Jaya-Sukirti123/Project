<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use function response;

class EmailController extends Controller
{
    public function send(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
         
        Mail::send('email\send', ['title' => $title, 'content' => $content], function ($message)
            {
                //$message->from('jaya.sukirti@sts.in', 'Jaya Sukirti');
                $message->to('jaya.sukirti@sts.in');
                $message->subject('practice mail');
            });

        return response()->json(['message' => 'Request completed']);
    }
}
