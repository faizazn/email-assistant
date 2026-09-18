@extends('layouts.app')

@section('content')
    <div class="row my-4">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-center bg-white">
                    <h4 class="mt-2">
                        Add new prompt
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('prompts.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="prompt" class="form-label">Prompt*</label>
                            <textarea rows="5" name="prompt" id="prompt" 
                                placeholder="Prompt*"
                                class="form-control @error('prompt')
                                    is-invalid
                                @enderror"></textarea>
                            @error('prompt')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection