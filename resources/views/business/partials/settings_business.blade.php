<div class="pos-tab-content active">
    <div class="row">
        <div class="col-sm-4 border">
            <div class="form-group">
                {!! Form::label('name', __('business.business_name') . ':*', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                {!! Form::text('name', $business->name, ['class' => 'form-control tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required', 'placeholder' => __('business.business_name')]); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('start_date', __('business.start_date') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-calendar"></i>
                    </span>
                    {!! Form::text('start_date', @format_date($business->start_date), ['class' => 'form-control start-date-picker tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'placeholder' => __('business.start_date'), 'readonly']); !!}
                </div>
        </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('default_profit_percent', __('business.default_profit_percent') . ':*', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!} @show_tooltip(__('tooltip.default_profit_percent'))
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    {!! Form::text('default_profit_percent', @num_format($business->default_profit_percent), ['class' => 'form-control input_number tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;"]); !!}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('currency_id', __('business.currency') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>
                    {!! Form::text('default_profit_percent', @num_format($business->default_profit_percent), ['class' => 'form-control input_number tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;"]); !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('currency_symbol_placement', __('lang_v1.currency_symbol_placement') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                {!! Form::select('currency_symbol_placement', ['before' => __('lang_v1.before_amount'), 'after' => __('lang_v1.after_amount')], $business->currency_symbol_placement, ['class' => 'form-control select2 tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required']); !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('time_zone', __('business.time_zone') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-clock"></i>
                    </span>
                    {!! Form::select('time_zone', $timezone_list, $business->time_zone, ['class' => 'form-control select2 tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required']); !!}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('business_logo', __('business.upload_logo') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                {!! Form::file('business_logo', ['accept' => 'image/*', 'class' => 'tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;"]); !!}
                <p class="help-block tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;"><i> @lang('business.logo_help')</i></p>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('fy_start_month', __('business.fy_start_month') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!} @show_tooltip(__('tooltip.fy_start_month'))
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-calendar"></i>
                    </span>
                    {!! Form::select('fy_start_month', $months, $business->fy_start_month, ['class' => 'form-control select2 tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required']); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('accounting_method', __('business.accounting_method') . ':*', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!} @show_tooltip(__('tooltip.accounting_method'))
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-calculator"></i>
                    </span>
                    {!! Form::select('accounting_method', $accounting_methods, $business->accounting_method, ['class' => 'form-control select2 tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required']); !!}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('transaction_edit_days', __('business.transaction_edit_days') . ':*', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!} @show_tooltip(__('tooltip.transaction_edit_days'))
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-edit"></i>
                    </span>
                    {!! Form::number('transaction_edit_days', $business->transaction_edit_days, ['class' => 'form-control tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'placeholder' => __('business.transaction_edit_days'), 'required']); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('date_format', __('lang_v1.date_format') . ':*', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-calendar"></i>
                    </span>
                    {!! Form::select('date_format', $date_formats, $business->date_format, ['class' => 'form-control select2 tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required']); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('time_format', __('lang_v1.time_format') . ':*', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fas fa-clock"></i>
                    </span>
                    {!! Form::select('time_format', [12 => __('lang_v1.12_hour'), 24 => __('lang_v1.24_hour')], $business->time_format, ['class' => 'form-control select2 tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required']); !!}
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('currency_precision', __('lang_v1.currency_precision') . ':*', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!} @show_tooltip(__('lang_v1.currency_precision_help'))
                {!! Form::select('currency_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->currency_precision, ['class' => 'form-control select2 tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('quantity_precision', __('lang_v1.quantity_precision') . ':*', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!} @show_tooltip(__('lang_v1.quantity_precision_help'))
                {!! Form::select('quantity_precision', [0 =>0, 1=>1, 2=>2, 3=>3,4=>4], $business->quantity_precision, ['class' => 'form-control select2 tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;", 'required']); !!}
            </div>
        </div>
    </div>
     {{-- code --}}
    <div class="row hide">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('code_label_1', __('lang_v1.code_1_name') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::text('code_label_1', $business->code_label_1, ['class' => 'form-control tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;"]); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('code_1', __('lang_v1.code_1') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::text('code_1', $business->code_1, ['class' => 'form-control tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;"]); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('code_label_2', __('lang_v1.code_2_name') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::text('code_label_2', $business->code_label_2, ['class' => 'form-control tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;"]); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('code_2', __('lang_v1.code_2') . ':', ['class' => 'tw-text-sm tw-font-medium tw-text-gray-500 tw-truncate tw-whitespace-nowrap', 'style' => "font-family: 'Poppins', sans-serif;"]) !!}
                <div class="input-group">
                    <span class="input-group-addon tw-text-sm tw-font-medium tw-text-gray-500" style="font-family: 'Poppins', sans-serif;">
                        <i class="fa fa-info"></i>
                    </span>
                    {!! Form::text('code_2', $business->code_2, ['class' => 'form-control tw-text-sm tw-font-medium tw-text-gray-500', 'style' => "font-family: 'Poppins', sans-serif;"]); !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row hide">
        <div class="col-sm-8">
            <div class="form-group">
                <label>
                    {!! Form::checkbox('common_settings[is_enabled_export]', true, !empty($common_settings['is_enabled_export']) ? true : false , 
                    [ 'class' => 'input-icheck']); !!} {{ __( 'lang_v1.enable_export' ) }}
                </label>
            </div>
        </div>
    </div>
</div>