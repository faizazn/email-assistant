@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900 tracking-tight">History</h1>
        <p class="text-slate-500 mt-1 text-sm">All emails you've sent through Ink & Wire.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Prompt</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($sentEmails as $email)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 text-xs font-semibold flex-shrink-0">
                                    {{ strtoupper(substr($email->contact->name ?? 'D', 0, 1)) }}
                                </div>
                                <span class="font-medium text-slate-900">
                                    {{ $email->contact->name ?? 'Deleted contact' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <p class="text-slate-600 truncate">
                                {{ $email->prompt->prompt ?? 'Deleted prompt' }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            @if ($email->status === 'sent')
                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-1 rounded-full text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Sent
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 border border-red-200 px-2.5 py-1 rounded-full text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Failed
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs">
                            {{ $email->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center">
                            <svg class="w-16 h-16 text-slate-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-slate-400 font-medium">No emails sent yet</p>
                            <p class="text-slate-400 text-xs mt-1">Your sending history will appear here.</p>
                            <a href="{{ route('home') }}" class="inline-block mt-4 text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                Compose your first message →
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($sentEmails->hasPages())
        <div class="mt-6">
            {{ $sentEmails->links() }}
        </div>
    @endif
</div>
@endsection