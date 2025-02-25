@extends('layouts.app')
@section('title', __('lang_v1.notification_templates'))

<style>
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
    }
    p, span, a, label, th, td {
        font-family: 'Poppins', sans-serif;
    }
</style>

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">{{ __('lang_v1.notification_templates')}}</h1>
</section>

<!-- Main content -->
<section class="content">
    {!! Form::open(['url' => action([\App\Http\Controllers\NotificationTemplateController::class, 'store']), 'method' => 'post' ]) !!}

    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.notifications') . ':'])
                @include('notification_template.partials.tabs', ['templates' => $general_notifications])
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.customer_notifications') . ':'])
                @include('notification_template.partials.tabs', ['templates' => $customer_notifications])
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.supplier_notifications') . ':'])
                @include('notification_template.partials.tabs', ['templates' => $supplier_notifications])

                <div class="callout callout-warning">
                    <p>@lang('lang_v1.logo_not_work_in_sms'):</p>
                </div>
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <button type="submit" class="tw-dw-btn tw-text-white tw-dw-btn-lg"
                style="background-color: #1E2B32; border: none; padding: 12px 24px; border-radius: 5px; font-family: 'Poppins', sans-serif;">
                @lang('messages.save')
            </button>
        </div>
    </div>
    
    {!! Form::close() !!}

</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
    $('textarea.ckeditor').each( function(){
        var editor_id = $(this).attr('id');
        tinymce.init({
            selector: 'textarea#'+editor_id,
        });
    });
</script>
@endsection