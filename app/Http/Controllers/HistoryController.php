<?php

namespace App\Http\Controllers;

class HistoryController extends Controller
{
    public function index()
    {
        $sentEmails = auth()->user()
            ->sentEmails()
            ->with(['contact', 'prompt'])
            ->latest()
            ->paginate(10);

        return view('history.index', compact('sentEmails'));
    }
}