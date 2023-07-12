@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Task Assigning') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <form method="POST" action="{{ url('assigned') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="emp_name" class="col-md-4 col-form-label text-md-end">{{ __('Employ Name') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="emp_name">
                                    <option>..Select Employ..</option>
                                    @foreach($employ as $value)
                                    <option value="{{$value->id}}">{{$value->emp_name}}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="department" class="col-md-4 col-form-label text-md-end">{{ __('Enter Email') }}</label>
                            <div class="col-md-6">
                                <input type="hidden" name="task_id" value="{{$task_id}}">
                            <input id="emp_email" type="email" class="form-control @error('emp_email') is-invalid @enderror" name="emp_email" value="" required autocomplete="emp_email" autofocus>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Task Assigned') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
