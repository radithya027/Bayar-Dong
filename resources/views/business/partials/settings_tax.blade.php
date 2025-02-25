<div class="pos-tab-content" style="font-family: 'Poppins', sans-serif; padding: 20px; border-radius: 8px;">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('tax_label_1', __('business.tax_1_name') . ':', ['style' => 'font-weight: 600; color: #333;']) !!}
                <div class="input-group" style="border-radius: 8px; overflow: hidden; border: 1px solid #ccc;">
                    <span class="input-group-addon" style="background: #eee; border: none; padding: 10px;">
                        <i class="fa fa-info" style="color: #666;"></i>
                    </span>
                    {!! Form::text('tax_label_1', $business->tax_label_1, ['class' => 'form-control', 'style' => 'border: none; padding: 10px;', 'placeholder' => __('business.tax_1_placeholder')]) !!}
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('tax_number_1', __('business.tax_1_no') . ':', ['style' => 'font-weight: 600; color: #333;']) !!}
                <div class="input-group" style="border-radius: 8px; overflow: hidden; border: 1px solid #ccc;">
                    <span class="input-group-addon" style="background: #eee; border: none; padding: 10px;">
                        <i class="fa fa-info" style="color: #666;"></i>
                    </span>
                    {!! Form::text('tax_number_1', $business->tax_number_1, ['class' => 'form-control', 'style' => 'border: none; padding: 10px;']) !!}
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('tax_label_2', __('business.tax_2_name') . ':', ['style' => 'font-weight: 600; color: #333;']) !!}
                <div class="input-group" style="border-radius: 8px; overflow: hidden; border: 1px solid #ccc;">
                    <span class="input-group-addon" style="background: #eee; border: none; padding: 10px;">
                        <i class="fa fa-info" style="color: #666;"></i>
                    </span>
                    {!! Form::text('tax_label_2', $business->tax_label_2, ['class' => 'form-control', 'style' => 'border: none; padding: 10px;', 'placeholder' => __('business.tax_1_placeholder')]) !!}
                </div>
            </div>
        </div>
        
        <div class="clearfix"></div>
        
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('tax_number_2', __('business.tax_2_no') . ':', ['style' => 'font-weight: 600; color: #333;']) !!}
                <div class="input-group" style="border-radius: 8px; overflow: hidden; border: 1px solid #ccc;">
                    <span class="input-group-addon" style="background: #eee; border: none; padding: 10px;">
                        <i class="fa fa-info" style="color: #666;"></i>
                    </span>
                    {!! Form::text('tax_number_2', $business->tax_number_2, ['class' => 'form-control', 'style' => 'border: none; padding: 10px;']) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="form-group">
                <div class="checkbox" style="margin-top: 20px;">
                    <label style="font-weight: 500; color: #333;">
                        {!! Form::checkbox('enable_inline_tax', 1, $business->enable_inline_tax , ['class' => 'input-icheck']) !!}
                        {{ __( 'lang_v1.enable_inline_tax' ) }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>