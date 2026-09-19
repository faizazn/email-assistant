@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto my-8">
    <h4 class="text-xl font-semibold text-gray-800 mb-4">Email History</h4>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prompt</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($sentEmails as $email)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $email->contact->name ?? 'Deleted contact' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-700 max-w-xs truncate">
                            {{ $email->prompt->prompt ?? 'Deleted prompt' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if ($email->status === 'sent')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Sent</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs" title="{{ $email->error_message }}">Failed</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $email->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">No emails sent yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $sentEmails->links() }}
    </div>
</div>
@endsection