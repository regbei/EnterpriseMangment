@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="col-md-3 col-sm-12 col-lg-5">
            <div class="card overflow-hidden rounded-5 shadow">
                <div class="card-header h4 fw-bold text-center">{{ __('الشركة الوطنية للنفط') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row-col-4 mb-3">
                            <div class="input-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email@example.com" required autocomplete="email" autofocus>
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        
                        <div class="row-col-4 mb-3">
                            
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="*******" required autocomplete="current-password">
                                <span class="input-group-text"><i class="fas fa-user-lock"></i></span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="submit" class=" btn btn-warning fs-5 fw-bold w-25 rounded-5">
                                    {{ __('دخول') }}
                                </button>
                                {{-- @if (Route::has('password.request'))
                                    <a class="list-item me-auto link" href="{{ route('password.request') }}">
                                        {{ __('هل نسيت كلمة السر؟?') }}
                                    </a>
                                    @endif --}}
                                </div>
                            </div>
                            
                            {{-- <div class="row mb-3">
                                <div class="">
                                    <div class="form-check">
                                        <label class="form-check-label" for="remember">{{ __('تذكرني') }}</label>
                                        
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
