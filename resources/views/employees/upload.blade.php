@extends('layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Multiple Employees') }}</div>
                    <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form method="POST" action="{{ route('employees.import') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Upload File') }}</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control-file @error('file') is-invalid @enderror" name="file" required>

                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Upload') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection