<!-- Purchase related settings -->
<div class="pos-tab-content" style="font-family: 'Poppins', sans-serif;">
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                {!! Form::label('default_credit_limit', __('lang_v1.default_credit_limit') . ':', ['class' => 'form-label fw-bold']) !!}
                {!! Form::text('common_settings[default_credit_limit]', $common_settings['default_credit_limit'] ?? '', [
                    'class' => 'form-control border rounded-3 shadow-sm input_number',
                    'placeholder' => __('lang_v1.default_credit_limit'), 
                    'id' => 'default_credit_limit'
                ]) !!}
            </div>
        </div>
    </div>
</div>
