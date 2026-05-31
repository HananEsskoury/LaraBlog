<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Afficher la page de contact
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Traiter l'envoi du formulaire de contact
     */
    public function submit(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|in:question,collaboration,author,bug,other',
            'message' => 'required|string|min:10|max:5000',
        ]);

        // Option 1: Sauvegarder en base de données
        $contact = ContactMessage::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'ip'      => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Option 2: Envoyer un email (décommentez quand vous aurez configuré Mail)
        // Mail::to('contact@larablog.com')->send(new ContactFormMail($validated));
        
        // Option 3: Envoyer une notification à l'admin
        // $admin = User::where('usertype', 'admin')->first();
        // if ($admin) {
        //     $admin->notify(new NewContactMessageNotification($contact));
        // }

        return redirect()->route('contact')
            ->with('success', 'Merci pour votre message ! Nous vous répondrons dans les plus brefs délais.');
    }

    /**
     * Afficher tous les messages (admin uniquement)
     */
    public function messages()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.contact-messages', compact('messages'));
    }

    /**
     * Afficher un message spécifique
     */
    public function showMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Marquer comme lu si ce n'est pas déjà fait
        if (!$message->is_read) {
            $message->update(['is_read' => true, 'read_at' => now()]);
        }
        
        return view('admin.contact-message-detail', compact('message'));
    }

    /**
     * Supprimer un message
     */
    public function deleteMessage($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        
        return redirect()->route('admin.contact.messages')
            ->with('success', 'Message supprimé avec succès.');
    }

    /**
     * Marquer comme lu/non lu
     */
    public function toggleRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update([
            'is_read' => !$message->is_read,
            'read_at' => $message->is_read ? null : now()
        ]);
        
        return back()->with('success', 'Statut du message mis à jour.');
    }
}