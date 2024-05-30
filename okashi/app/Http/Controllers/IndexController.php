<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function showIndex() {
        $files = Storage::disk('public')->allFiles('carousel/');
        $r = Product::where('price', '<', 3.0 )->inRandomOrder()->limit(5)->get();
        return view('index', ['recommended' => $r, 'carousel' => $files]);
    }

    public function aboutContact(Request $request){
        $request->validate([
            'comment' => 'required',
        ]);

        $comment = $request->input('comment');
        $email = auth()->user()->email_address;

        Mail::send('emails.contact', ['comment' => $comment], function ($message) {
            $message->to(auth()->user()->email_address)
                    ->subject('Contact Form Submission');
        });

        return redirect('/about')->with('success', 'Your message has been sent!');
    }
}
