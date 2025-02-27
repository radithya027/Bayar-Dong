<div class="pos-tab-content" style="font-family: Poppins, sans-serif;">
     <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('stock_expiry_alert_days', __('business.view_stock_expiry_alert_for') . ':*') !!}
                <div class="input-group">
                <span class="input-group-addon">
                    <i class="fas fa-calendar-times"></i>
                </span>
                {!! Form::number('stock_expiry_alert_days', $business->stock_expiry_alert_days, ['class' => 'form-control','required']); !!}
                <span class="input-group-addon">
                    @lang('business.days')
                </span>
                </div>
            </div>
        </div>
    </div>
</div>