<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'POS') }}</title> 
    @include('layouts.partials.css')
    
    <style>
        html, body {
            font-family: 'Poppins', sans-serif;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            height: 100vh;
            padding: 0;
            margin: 0;
        }

        .row.eq-height-row {
            height: 100%;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
        }

        .eq-height-col {
            height: 100%;
        }

        .left-col {
            position: relative;
            background: linear-gradient(45deg, rgba(33, 150, 243, 0.7), rgba(63, 81, 181, 0.7));
            padding: 0;
        }


        .left-col-content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .right-col {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: #f8f9fa;
        }

        .language-select-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        #change_lang {  
            border: 1px solid #ddd;
            border-radius: 4px;
            background: white;
        }

        .register-links {
            text-align: right;
            margin-bottom: 1rem;
        }

        .login-form {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            max-width: 500px;
            margin: 0 auto;
            width: 100%;
        }

        .btn.bg-maroon {
            background-color: #d81b60;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .btn.bg-maroon:hover {
            background-color: #c41853;
        }

        @media (max-width: 768px) {
            .left-col {
                display: none;
            }

            .right-col {
                width: 100%;
                padding: 1rem;
            }

            .login-form {
                padding: 1rem;
            }
        }

        .login-header {
            text-align: center;
        }

        .login-header img {
            max-width: 200px;
            height: auto;
            margin-bottom: 1rem;
        }

        .login-header small {
            color: white;
            font-size: 1.2rem;
            display: block;
        }

    </style>
</head>

<body>
    @if (session('status'))
        <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
    @endif
    @inject('request', 'Illuminate\Http\Request')
    
    <div class="container-fluid">
        <div class="row eq-height-row">
            <!-- Left Column with Background Image -->
            <div class="col-md-5 col-sm-5 hidden-xs left-col eq-height-col">
                <div class="left-col-content login-header">
                    <div>
                        <a href="">
                            <img src="http://127.0.0.1:8000/uploads/cms/logo.png" class="img-rounded" alt="Logo">
                        </a>
                        <br/>
                        @if(!empty(config('constants.app_title')))
                            <small>{{config('constants.app_title')}}</small>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column with Form -->
            <div class="col-md-7 col-sm-12 col-xs-12 right-col eq-height-col">
                <div class="login-form">
                    <!-- Language Selector -->
                    <div class="language-select-container">
                        <select class="form-control input-sm" id="change_lang">
                            @foreach(config('constants.langs') as $key => $val)
                                <option value="{{$key}}" 
                                    @if((empty(request()->lang) && config('app.locale') == $key) 
                                    || request()->lang == $key) 
                                        selected 
                                    @endif
                                >
                                    {{$val['full_name']}}
                                </option>
                            @endforeach
                        </select>

                        <div class="register-links">
                            @if(!($request->segment(1) == 'business' && $request->segment(2) == 'register'))
                         
                            @endif
                            @if($request->segment(1) != 'login')
                                &nbsp; &nbsp;<span class="text-white">{{ __('business.already_registered')}} </span>
                                <a href="{{ action([\App\Http\Controllers\Auth\LoginController::class, 'login']) }}@if(!empty(request()->lang)){{'?lang=' . request()->lang}} @endif">
                                    {{ __('business.sign_in') }}
                                </a>
                            @endif
                        </div>
                    </div>

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.javascripts')
    <script src="{{ asset('js/login.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.select2_register').select2();

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            $('#change_lang').change(function(){
                window.location = "{{ route('repair-status') }}?lang=" + $(this).val();
            });
        });
    </script>
</body>
</html>