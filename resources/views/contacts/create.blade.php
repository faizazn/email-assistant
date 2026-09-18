@extends('layouts.app')

@section('content')
    <div class="row my-4">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header text-center bg-white">
                    <h4 class="mt-2">
                        Add new contact
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('contacts.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" name="name" id="name" 
                                placeholder="Name*"
                                class="form-control @error('name')
                                    is-invalid
                                @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" id="email" 
                                placeholder="Email*"
                                class="form-control @error('email')
                                    is-invalid
                                @enderror">
                            @error('email')
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