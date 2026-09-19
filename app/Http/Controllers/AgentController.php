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

    public function prompt(SendPromptRequest $request)
    {
        $validated = $request->validated();

        $contact = Contact::where('id', $validated['contact_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $prompt = Prompt::where('id', $validated['prompt_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $filledPrompt = str_replace('{friend_name}', $contact->name, $prompt->prompt);

        $aiMessage = $this->huggingFace->generateText($filledPrompt);

        if (!$aiMessage) {
            SentEmail::create([
                'user_id'           => auth()->id(),
                'contact_id'        => $contact->id,
                'prompt_id'         => $prompt->id,
                'generated_message' => '',
                'status'            => 'failed',
                'error_message'     => 'AI service returned no content.',
            ]);

            return to_route('home')->with('error', 'AI service is unavailable, try again later.');
        }

        try {
            Mail::to($contact->email)->send(new AiEmail($aiMessage));

            SentEmail::create([
                'user_id'           => auth()->id(),
                'contact_id'        => $contact->id,
                'prompt_id'         => $prompt->id,
                'generated_message' => $aiMessage,
                'status'            => 'sent',
            ]);
        } catch (\Throwable $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());

            SentEmail::create([
                'user_id'           => auth()->id(),
                'contact_id'        => $contact->id,
                'prompt_id'         => $prompt->id,
                'generated_message' => $aiMessage,
                'status'            => 'failed',
                'error_message'     => $e->getMessage(),
            ]);

            return to_route('home')->with('error', 'Could not send the email.');
        }

        session()->forget(['contact_id', 'prompt_id']);

        return to_route('home')->with('success', 'Message sent successfully.');
    }
}