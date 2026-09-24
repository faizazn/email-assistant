<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendPromptRequest;
use App\Mail\AiEmail;
use App\Models\Contact;
use App\Models\Prompt;
use App\Models\SentEmail;
use App\Services\HuggingFaceService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    public function __construct(protected HuggingFaceService $huggingFace)
    {
    }

    /**
     * Étape 1: Générer le texte AI et créer un draft (sans l'envoyer)
     */
    public function generate(SendPromptRequest $request)
    {
        $validated = $request->validated();

        $contact = Contact::where('id', $validated['contact_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $prompt = Prompt::findOrFail($validated['prompt_id']);

        $filledPrompt = str_replace('{friend_name}', $contact->name, $prompt->prompt);

        $aiMessage = $this->huggingFace->generateText($filledPrompt);

        if (!$aiMessage) {
            return to_route('home')->with('error', 'AI service is unavailable, try again later.');
        }

        $draft = SentEmail::create([
            'user_id'           => auth()->id(),
            'contact_id'        => $contact->id,
            'prompt_id'         => $prompt->id,
            'generated_message' => $aiMessage,
            'status'            => 'draft',
        ]);

        session()->forget(['contact_id', 'prompt_id']);

        return view('agent.preview', compact('draft'));
    }

    /**
     * Étape 2: Regénérer le texte (au cas où le résultat ne plaît pas)
     */
    public function regenerate(SentEmail $sentEmail)
    {
        abort_if($sentEmail->user_id !== auth()->id(), 403);
        abort_if($sentEmail->status !== 'draft', 403);

        $contact = $sentEmail->contact;
        $prompt  = $sentEmail->prompt;

        $filledPrompt = str_replace('{friend_name}', $contact->name, $prompt->prompt);

        $aiMessage = $this->huggingFace->generateText($filledPrompt);

        if (!$aiMessage) {
            return back()->with('error', 'AI service is unavailable, try again later.');
        }

        $sentEmail->update(['generated_message' => $aiMessage]);

        return view('agent.preview', ['draft' => $sentEmail]);
    }

    /**
     * Étape 3: Confirmer et envoyer l'email
     */
    public function send(SentEmail $sentEmail)
    {
        abort_if($sentEmail->user_id !== auth()->id(), 403);
        abort_if($sentEmail->status !== 'draft', 403);

        try {
            Mail::to($sentEmail->contact->email)->send(new AiEmail($sentEmail->generated_message));

            $sentEmail->update(['status' => 'sent']);
        } catch (\Throwable $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());

            $sentEmail->update([
                'status'        => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return to_route('home')->with('error', 'Could not send the email.');
        }

        return to_route('home')->with('success', 'Message sent successfully.');
    }
}