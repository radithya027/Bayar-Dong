@extends('layouts.auth2')
@section('title', __('lang_v1.login'))
@inject('request', 'Illuminate\Http\Request')
@section('content')
    @php
        $username = old('username');
        $password = null;
        if (config('app.env') == 'demo') {
            $username = 'admin';
            $password = '123456';
        }
    @endphp

<div class="login-container">
    <!-- Left side - Welcome Image -->
    <div class="welcome-container">
        <div class="welcome-image"></div>
    </div>

    <!-- Right side - Login Form -->
    <div class="login-form-container">
        <div class="login-box">
            <h1 class="login-title">Login</h1>
            
            <form method="POST" action="{{ route('login') }}" id="login-form">
                {{ csrf_field() }}
                
                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                    <input type="text" 
                           name="username" 
                           id="username"
                           class="form-input"
                           placeholder="Username"
                           value="{{ $username }}"
                           required 
                           autofocus>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <div class="password-input-container">
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="form-input"
                               placeholder="Password"
                               value="{{ $password }}"
                               required>
                        <button type="button" id="show_hide_icon" class="show-hide-password">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon-eye" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none">
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-options">
                    <div class="remember-me">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>
                    </div>
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">Forgot My Password</a>
                    </div>
                </div>

                @if(config('constants.enable_recaptcha'))
                    <div class="recaptcha-container">
                        <div class="g-recaptcha" data-sitekey="{{ config('constants.google_recaptcha_key') }}"></div>
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        @endif
                    </div>
                @endif

                <button type="submit" class="login-button">
                    Login
                </button>
            </form>

            <div class="additional-links">
                @if (!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                    @if (config('constants.allow_registration'))
                        <div class="register-section">
                            <span>Don't have an account?</span>
                            <a href="{{ route('business.getRegister') }}@if(!empty(request()->lang)){{'?lang='.request()->lang}}@endif">
                                {{ __('business.register') }}
                            </a>
                        </div>
                        
                        {{-- @if (Route::has('pricing') && config('app.env') != 'demo' && $request->segment(1) != 'pricing')
                            <div class="pricing-section">
                                <a href="{{ action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']) }}" class="pricing-button">
                                    <i class="fas fa-tag"></i>
                                    @lang('superadmin::lang.pricing')
                                </a>
                            </div>
                        @endif --}}
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

    <style>

        .login-container {
            display: flex;
            min-height: 65vh;  /* Further reduced height */
            background: #fff;
            max-width: 800px;  /* Slightly reduced width */
            margin: 2rem auto;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .login-form-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;  /* Reduced padding */
            max-width: 400px;  /* Reduced width */
        }

        .additional-links {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
            text-align: center;
        }

        .register-section {
            margin-bottom: 1rem;
        }

        .register-section span {
            color: #666;
            margin-right: 0.5rem;
        }

        .register-section a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .pricing-section {
            display: flex;
            justify-content: center;
            margin-top: 0.5rem;
        }

        /* .pricing-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 6rem;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
        } */

        .pricing-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        }

        .pricing-button i {
            margin-right: 0.5rem;
        }

        .login-box {
            width: 100%;
            max-width: 280px;  /* Reduced width */
            padding: 0.75rem;  /* Reduced padding */
        }

        .login-title {
            font-size: 20px;  /* Reduced size */
            font-weight: 600;
            color: #333;
            margin-bottom: 0.75rem;
        }

        .form-group {
            margin-bottom: 0.75rem;  /* Reduced margin */
        }

        .form-input {
            width: 100%;
            padding: 7px;  /* Reduced padding */
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
            transition: all 0.3s;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            font-size: 13px;
        }

        .forgot-password a {
            color: #4299e1;
            text-decoration: none;
            font-size: 13px;
        }

        .login-button {
            width: 100%;
            padding: 7px;
            background: #4a5568;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            margin-top: 0.5rem;
        }

        .welcome-container {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            max-width: 400px;  /* Reduced width */
            border-top-left-radius: 12px;  /* Changed to left side */
            border-bottom-left-radius: 12px;  /* Changed to left side */
        }

        .welcome-image {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://img.freepik.com/free-photo/close-up-view-measuring-weight-fruit-supermarket_342744-1102.jpg?t=st=1740042682~exp=1740046282~hmac=5b5ff0a4d4cf63e200c5b10ce7e124dbaf6a54ba603c4c66bd74eaed6e598543&w=740');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .welcome-content h2 {
            font-size: 24px;  /* Reduced size */
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-content p {
            font-size: 14px;
            max-width: 80%;
            margin: 0 auto;
        }

        .remember-me label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 13px;
            color: #4a5568;
        }

        .register-link {
            margin-top: 0.75rem;
            text-align: center;
            font-size: 13px;
            color: #4a5568;
        }

        .password-input-container {
            position: relative;
        }

        .show-hide-password {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .icon-eye {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                max-width: 100%;
                margin: 0;
                min-height: 100vh;
                border-radius: 0;
            }
            
            .welcome-container {
                display: none;
            }
            
            .login-form-container {
                width: 100%;
                max-width: 100%;
            }

            .login-box {
                max-width: 100%;
            }
        }
    </style>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#show_hide_icon').off('click');
            $('.change_lang').click(function() {
                window.location = "{{ route('login') }}?lang=" + $(this).attr('value');
            });
            
            $('#show_hide_icon').on('click', function(e) {
                e.preventDefault();
                const passwordInput = $('#password');
                
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    $(this).html('<svg xmlns="http://www.w3.org/2000/svg" class="icon-eye" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none"><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"/><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87"/><path d="M3 3l18 18"/></svg>');
                } else {
                    passwordInput.attr('type', 'password');
                    $(this).html('<svg xmlns="http://www.w3.org/2000/svg" class="icon-eye" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none"><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/></svg>');
                }
            });
        });
    </script>
@endsection