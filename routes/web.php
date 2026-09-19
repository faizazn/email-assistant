<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\HistoryController;

//Contact Routes
Route::get('/', [ContactController::class,'index'])->name('home');
Route::get('contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('choose/{contact}/contacts', [ContactController::class, 'chooseContact'])->name('contacts.choose');

//Prompt Routes
Route::get('prompts/create', [PromptController::class, 'create'])->name('prompts.create');
Route::post('prompts', [PromptController::class, 'store'])->name('prompts.store');
Route::get('choose/{prompt}/prompts', [PromptController::class, 'choosePrompt'])->name('prompts.choose');
Route::post('agent', [AgentController::class, 'prompt'])->name('prompt.send');
Route::get('history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
