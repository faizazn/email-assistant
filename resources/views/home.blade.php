@extends('layouts.app')

@section('content')
    <div class="row my-5">
        <div class="col-md-4">
            <form action="{{ route('prompt.send') }}" method="post">
                @csrf
                <input type="hidden" name="contact_id" value="{{ session('contact_id') }}">
                <input type="hidden" name="prompt_id" value="{{ session('prompt_id') }}">

                <div class="mb-3">
                    <input
                        type="text"
                        placeholder="Choose a contact from the list"
                        class="form-control"
                        value="{{ optional($contacts->find(session('contact_id')))->name }}"
                        readonly
                    >
                </div>
                <div class="mb-3">
                    <textarea
                        rows="5"
                        placeholder="Choose a prompt from the list"
                        class="form-control"
                        readonly
                    >{{ optional($prompts->find(session('prompt_id')))->prompt }}</textarea>
                </div>
                @if (session('contact_id') && session('prompt_id'))
                    <button class="btn btn-primary">
                        Submit
                    </button>
                @endif
            </form>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mt-2">List of contacts</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($contacts as $contact)
                            <li class="list-group-item @if(session('contact_id') === $contact->id) active @endif">
                                <a href="{{ route('contacts.choose', $contact->id) }}"
                                   class="text-decoration-none @if(session('contact_id') === $contact->id) text-white @else text-dark @endif">
                                    {{ $contact->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mt-2">List of prompts</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($prompts as $prompt)
                            <li class="list-group-item @if(session('prompt_id') === $prompt->id) active @endif">
                                <a href="{{ route('prompts.choose', $prompt->id) }}"
                                   class="text-decoration-none @if(session('prompt_id') === $prompt->id) text-white @else text-dark @endif">
                                    {{ $prompt->prompt }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection