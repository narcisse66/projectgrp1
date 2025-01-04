<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    // Affiche le formulaire de contact
    public function create(Request $request)
    {
        // Récupère l'email passé en paramètre dans l'URL ou laisse vide
        $email = $request->query('email', ''); // Si 'email' n'est pas dans l'URL, on met une chaîne vide par défaut
        return view('message.create', compact('email'));
    }

    // Envoie l'email
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Envoi de l'email
        Mail::raw($request->message, function ($message) use ($request) {
            $message->to($request->email)
                ->subject($request->subject)
                ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });

        return back()->with('success', 'Message envoyé avec succès!');
    }
}
