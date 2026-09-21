<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\HistoryController;

Route::middleware('auth')->group(function () {

    // Contact Routes
    Route::get('/', [ContactController::class,'index'])->name('home');
    Route::get('contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('choose/{contact}/contacts', [ContactController::class, 'chooseContact'])->name('contacts.choose');
    Route::get('contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Agent
    Route::post('agent/generate', [AgentController::class, 'generate'])->name('agent.generate');
    Route::post('agent/{sentEmail}/send', [AgentController::class, 'send'])->name('agent.send');
    Route::post('agent/{sentEmail}/regenerate', [AgentController::class, 'regenerate'])->name('agent.regenerate');

    // Prompt Routes
    Route::get('prompts/create', [PromptController::class, 'create'])->name('prompts.create');
    Route::post('prompts', [PromptController::class, 'store'])->name('prompts.store');
    Route::get('choose/{prompt}/prompts', [PromptController::class, 'choosePrompt'])->name('prompts.choose');
    Route::get('prompts/{prompt}/edit', [PromptController::class, 'edit'])->name('prompts.edit');
    Route::put('prompts/{prompt}', [PromptController::class, 'update'])->name('prompts.update');
    Route::delete('prompts/{prompt}', [PromptController::class, 'destroy'])->name('prompts.destroy');

    // History
    Route::get('history', [HistoryController::class, 'index'])->name('history.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';