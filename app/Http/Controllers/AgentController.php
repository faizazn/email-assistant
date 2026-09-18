<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendPromptRequest;
use App\Mail\AiEmail;
use App\Models\Contact;
use App\Models\Prompt;
use App\Services\HuggingFaceService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AgentController extends Controller
{
    public function __construct(protected HuggingFaceService $huggingFace)
    {
    }

    public function prompt(SendPromptRequest $request)
    {
        $validated = $request->validated();

        $contact = Contact::findOrFail($validated['contact_id']);
        $prompt  = Prompt::findOrFail($validated['prompt_id']);

        $filledPrompt = str_replace(
            '{friend_name}',
            $contact->name,
            $prompt->prompt
        );

        $aiMessage = $this->huggingFace->generateText($filledPrompt);

        if (!$aiMessage) {
            return to_route('home')->with('error', 'AI service is unavailable, try again later.');
        }

        try {
            Mail::to($contact->email)->send(new AiEmail($aiMessage));
        } catch (\Throwable $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            return to_route('home')->with('error', 'Could not send the email.');
        }

        session()->forget(['contact_id', 'prompt_id']);

        return to_route('home')->with('success', 'Message sent successfully.');
    }
}