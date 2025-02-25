<style>
@media print {
  #scrollable-container {
    position: absolute;
  }
}
</style>

<div class="row" style="color: #000000 !important;">
		@if(empty($receipt_details->letter_head))
			<!-- Logo -->
			@if(!empty($receipt_details->logo))
				<img style="max-height: 120px; width: auto;" src="{{$receipt_details->logo}}" class="img img-responsive center-block">
			@endif

			<div class="col-md-12 col-sm-12 width-100">
				<!-- Header text -->
				@if(!empty($receipt_details->header_text))
					{!! $receipt_details->header_text !!}
				@endif

				<!-- Shop & Location Name  -->
				@if(!empty($receipt_details->display_name))
					<h3 class="text-center" style="text-align: center; color: #000000 !important">
						{{$receipt_details->display_name}}
					</h3>
				@endif

				<!-- Sub heading -->
				<p class="text-center">
				@if(!empty($receipt_details->sub_heading_line1))
					{{ $receipt_details->sub_heading_line1 }}
				@endif
				@if(!empty($receipt_details->sub_heading_line2))
					<br>{{ $receipt_details->sub_heading_line2 }}
				@endif
				@if(!empty($receipt_details->sub_heading_line3))
					<br>{{ $receipt_details->sub_heading_line3 }}
				@endif
				@if(!empty($receipt_details->sub_heading_line4))
					<br>{{ $receipt_details->sub_heading_line4 }}
				@endif		
				@if(!empty($receipt_details->sub_heading_line5))
					<br>{{ $receipt_details->sub_heading_line5 }}
				@endif
				</p>
			</div>
		@else
			<div class="col-md-12 col-sm-12 width-100 text-center">
				<img style="max-width: 100%; height:auto; margin-bottom: 10px;" src="{{$receipt_details->letter_head}}">
			</div>
		@endif

		<!-- Title of receipt -->
		<div class="col-md-12 col-sm-12 width-100 text-center">
		@if(!empty($receipt_details->invoice_heading))
			<h2 class="text-center" style="text-align: center; color: #000000 !important">
				{!! $receipt_details->invoice_heading !!}
			</h2>
		@endif
		</div>

	<div class="col-md-12 col-sm-12 width-100 text-center">
		<!-- Invoice  number, Date  -->
			<div class="col-md-6 col-sm-6 col-xs-6 align-left text-left width-50 f-left word-wrap">
				@if(!empty($receipt_details->invoice_no_prefix))
					<strong>{!! $receipt_details->invoice_no_prefix !!}</strong>
				@endif
				{{$receipt_details->invoice_no}}

				@if(!empty($receipt_details->types_of_service))
					<br/>
					<span class="pull-left text-left">
						<strong>{!! $receipt_details->types_of_service_label !!}:</strong>
						{{$receipt_details->types_of_service}}
						<!-- Waiter info -->
						@if(!empty($receipt_details->types_of_service_custom_fields))
							@foreach($receipt_details->types_of_service_custom_fields as $key => $value)
								<br><strong>{{$key}}: </strong> {{$value}}
							@endforeach
						@endif
					</span>
				@endif

				<!-- Table information-->
		        @if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
		        	<br/>
					<span class="pull-left text-left">
						@if(!empty($receipt_details->table_label))
							<strong>{!! $receipt_details->table_label !!}</strong>
						@endif
						{{$receipt_details->table}}
					</span>
		        @endif

				<!-- customer info -->
				@if(!empty($receipt_details->customer_info))
					<br/>
					<strong>{{ $receipt_details->customer_label }}</strong> {!! $receipt_details->customer_info !!} <br>
				@endif
				@if(!empty($receipt_details->client_id_label))
					<br/>
					<strong>{{ $receipt_details->client_id_label }}</strong> {{ $receipt_details->client_id }}
				@endif
				@if(!empty($receipt_details->customer_tax_label))
					<br/>
					<strong>{{ $receipt_details->customer_tax_label }}</strong> {{ $receipt_details->customer_tax_number }}
				@endif
				@if(!empty($receipt_details->customer_custom_fields))
					<br/>{!! $receipt_details->customer_custom_fields !!}
				@endif
				@if(!empty($receipt_details->sales_person_label))
					<br/>
					<strong>{{ $receipt_details->sales_person_label }}</strong> {{ $receipt_details->sales_person }}
				@endif
				@if(!empty($receipt_details->commission_agent_label))
					<br/>
					<strong>{{ $receipt_details->commission_agent_label }}</strong> {{ $receipt_details->commission_agent }}
				@endif
				@if(!empty($receipt_details->customer_rp_label))
					<br/>
					<strong>{{ $receipt_details->customer_rp_label }}</strong> {{ $receipt_details->customer_total_rp }}
				@endif
			</div>

			<div class="col-md-6 col-sm-6 col-xs-6 align-right text-right width-50 f-right word-wrap">
				<strong>{{$receipt_details->date_label}}</strong> {{$receipt_details->invoice_date}}

				@if(!empty($receipt_details->due_date_label))
				<br><strong>{{$receipt_details->due_date_label}}</strong> {{$receipt_details->due_date ?? ''}}
				@endif

				@if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
					<br>
					@if(!empty($receipt_details->brand_label))
						<strong>{!! $receipt_details->brand_label !!}</strong>
					@endif
					{{$receipt_details->repair_brand}}
		        @endif


		        @if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
					<br>
					@if(!empty($receipt_details->device_label))
						<strong>{!! $receipt_details->device_label !!}</strong>
					@endif
					{{$receipt_details->repair_device}}
		        @endif

				@if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
					<br>
					@if(!empty($receipt_details->model_no_label))
						<strong>{!! $receipt_details->model_no_label !!}</strong>
					@endif
					{{$receipt_details->repair_model_no}}
		        @endif

				@if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no))
					<br>
					@if(!empty($receipt_details->serial_no_label))
						<strong>{!! $receipt_details->serial_no_label !!}</strong>
					@endif
					{{$receipt_details->repair_serial_no}}<br>
		        @endif
				@if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status))
					@if(!empty($receipt_details->repair_status_label))
						<strong>{!! $receipt_details->repair_status_label !!}</strong>
					@endif
					{{$receipt_details->repair_status}}<br>
		        @endif
		        
		        @if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
					@if(!empty($receipt_details->repair_warranty_label))
						<strong>{!! $receipt_details->repair_warranty_label !!}</strong>
					@endif
					{{$receipt_details->repair_warranty}}
					<br>
		        @endif
		        
				<!-- Waiter info -->
				@if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff))
		        	<br/>
					@if(!empty($receipt_details->service_staff_label))
						<strong>{!! $receipt_details->service_staff_label !!}</strong>
					@endif
					{{$receipt_details->service_staff}}
		        @endif
		        @if(!empty($receipt_details->shipping_custom_field_1_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_1_label!!} :</strong> {!!$receipt_details->shipping_custom_field_1_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_2_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_2_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_3_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_3_label!!}:</strong> {!!$receipt_details->shipping_custom_field_3_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_4_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_4_label!!}:</strong> {!!$receipt_details->shipping_custom_field_4_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->shipping_custom_field_5_label))
					<br><strong>{!!$receipt_details->shipping_custom_field_2_label!!}:</strong> {!!$receipt_details->shipping_custom_field_5_value ?? ''!!}
				@endif
				{{-- sale order --}}
				@if(!empty($receipt_details->sale_orders_invoice_no))
					<br>
					<strong>@lang('restaurant.order_no'):</strong> {!!$receipt_details->sale_orders_invoice_no ?? ''!!}
				@endif

				@if(!empty($receipt_details->sale_orders_invoice_date))
					<br>
					<strong>@lang('lang_v1.order_dates'):</strong> {!!$receipt_details->sale_orders_invoice_date ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_1_value))
					<br>
					<strong>{{ $receipt_details->sell_custom_field_1_label }}:</strong> {!!$receipt_details->sell_custom_field_1_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_2_value))
					<br>
					<strong>{{ $receipt_details->sell_custom_field_2_label }}:</strong> {!!$receipt_details->sell_custom_field_2_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_3_value))
					<br>
					<strong>{{ $receipt_details->sell_custom_field_3_label }}:</strong> {!!$receipt_details->sell_custom_field_3_value ?? ''!!}
				@endif

				@if(!empty($receipt_details->sell_custom_field_4_value))
					<br>
					<strong>{{ $receipt_details->sell_custom_field_4_label }}:</strong> {!!$receipt_details->sell_custom_field_4_value ?? ''!!}
				@endif

			</div>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	@includeIf('sale_pos.receipts.partial.common_repair_invoice')
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-md-12 col-sm-12 width-100">
		<br/>
		@php
			$p_width = 64;
		@endphp
		@if(!empty($receipt_details->item_discount_label))
			@php
				$p_width -= 10;
			@endphp
		@endif
		@if(!empty($receipt_details->discounted_unit_price_label))
			@php
				$p_width -= 10;
			@endphp
		@endif
		<div class="table-responsive">
		<table class="table table-bordered" style="border: 1px solid #000 !important">
			<thead>
				<tr>
					<th style="width: 4%; border: 1px solid #000 !important" class="text-center">TT</td>
					<th style="width: {{$p_width}}%; border: 1px solid #000 !important" class="text-center">{{$receipt_details->table_product_label}}</td>
					<th style="width: 8%; border: 1px solid #000 !important" class="text-center">{{$receipt_details->table_qty_label}}</td>
					<th style="width: 10; border: 1px solid #000 !important" class="text-center">{{$receipt_details->table_unit_price_label}}</td>
					@if(!empty($receipt_details->item_discount_label))
						<th style="width: 10%; border: 1px solid #000 !important" class="text-center">{{$receipt_details->item_discount_label}}</td>
					@endif
					@if(!empty($receipt_details->discounted_unit_price_label))
						<th style="width: 10%; border: 1px solid #000 !important" class="text-center">{{$receipt_details->discounted_unit_price_label}}</td>
					@endif
					<th style="width: 14%; border: 1px solid #000 !important" class="text-center">{{$receipt_details->table_subtotal_label}}</td>
				</tr>
			</thead>
			<tbody>
				@forelse($receipt_details->lines as $line)
					<tr>
						<td style="border: 1px solid #000 !important">{{$loop->iteration}}</td>
						<td style="border: 1px solid #000 !important">
							@if(!empty($line['image']))
								<img src="{{$line['image']}}" alt="Product image" class="product-thumbnail-small" style="float: left; margin-right: 8px;">
							@endif
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku']))<br>@lang('product.sku'): {{$line['sub_sku']}} @endif
							@if(!empty($line['brand'])), @lang('product.brand'): {{$line['brand']}} @endif
							@if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
                            @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
                            @if(!empty($line['product_description']))<br>@lang('lang_v1.description'): {{$line['product_description']}} @endif
                            @if(!empty($line['sell_line_note']))<br>@lang('brand.note'): {{$line['sell_line_note']}} @endif
                            @if(!empty($line['lot_number']))<br>{{$line['lot_number_label']}}: {{$line['lot_number']}} @endif 
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}: {{$line['product_expiry']}} @endif

                            @if(!empty($line['warranty_name']))<br><small>{{$line['warranty_name']}}</small>@endif
							@if(!empty($line['warranty_description']))<small>( {{$line['warranty_description']}} )</small>@endif
							@if(!empty($line['warranty_exp_date']))<small>- @lang('lang_v1.to'): {{@format_date($line['warranty_exp_date'])}}</small>@endif

                            @if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br><small>
                            	1 {{$line['units']}} = {{$line['base_unit_multiplier']}} {{$line['base_unit_name']}} <br>
                            	{{$line['base_unit_price']}} x {{$line['orig_quantity']}} = {{$line['line_total']}}
                            </small>
                            @endif
                        </td>
						<td style="border: 1px solid #000 !important">
							{{$line['quantity']}} {{$line['units']}} 

							@if($receipt_details->show_base_unit_details && $line['quantity'] && $line['base_unit_multiplier'] !== 1)
                            <br><small>
                            	{{$line['quantity']}} x {{$line['base_unit_multiplier']}} = {{$line['orig_quantity']}} {{$line['base_unit_name']}}
                            </small>
                            @endif
						</td>
						<td class="ws-nowrap align-right" style="border: 1px solid #000 !important">{{$line['unit_price_before_discount']}}</td>
						@if(!empty($receipt_details->item_discount_label))
							<td class="ws-nowrap align-right" style="border: 1px solid #000 !important">
								{{$line['total_line_discount'] ?? '0'}}

								@if(!empty($line['line_discount_percent']))
								 	<br>({{$line['line_discount_percent']}} %)
								@endif
							</td>
						@endif
						@if(!empty($receipt_details->discounted_unit_price_label))
							<td class="ws-nowrap align-right" style="border: 1px solid #000 !important">
								{{$line['unit_price_inc_tax']}} 
							</td>
						@endif
						<td class="ws-nowrap align-right" style="border: 1px solid #000 !important">{{$line['line_total']}}</td>
					</tr>
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
							<tr>
								<td style="border: 1px solid #000 !important">&nbsp;</td>
								<td style="border: 1px solid #000 !important">
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sub_sku']))<br>@lang('product.sku'): {{$modifier['sub_sku']}} @endif @if(!empty($modifier['cat_code'])), {{$modifier['cat_code']}}@endif
		                            @if(!empty($modifier['sell_line_note']))<br>@lang('brand.note'): {{$modifier['sell_line_note']}} @endif 
		                        </td>
								<td style="border: 1px solid #000 !important">{{$modifier['quantity']}} {{$modifier['units']}} </td>
								<td class="ws-nowrap align-right" style="border: 1px solid #000 !important">{{$modifier['unit_price_inc_tax']}}</td>
								@if(!empty($receipt_details->item_discount_label))
									<td class="ws-nowrap align-right" style="border: 1px solid #000 !important">0</td>
								@endif
								@if(!empty($receipt_details->discounted_unit_price_label))
									<td class="ws-nowrap align-right" style="border: 1px solid #000 !important">{{$modifier['unit_price_exc_tax']}}</td>
								@endif
								<td class="ws-nowrap align-right" style="border: 1px solid #000 !important">{{$modifier['line_total']}}</td>
							</tr>
						@endforeach
					@endif
				@empty
					<tr>
						<td style="border: 1px solid #000 !important" colspan="5">&nbsp;</td>
						@if(!empty($receipt_details->item_discount_label))
    					<td style="border: 1px solid #000 !important"></td>
    					@endif
    					@if(!empty($receipt_details->discounted_unit_price_label))
    					<td style="border: 1px solid #000 !important"></td>
    					@endif
					</tr>
				@endforelse
			</tbody>
		</table>
		</div>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-md-6 col-sm-6 col-xs-6 width-50 f-left">
		<table class="table table-slim">

			@if(!empty($receipt_details->payments))
				@foreach($receipt_details->payments as $payment)
					<tr>
						<td>{{$payment['method']}}</td>
						<td class="align-right" >{{$payment['amount']}}</td>
						<td class="align-right">{{$payment['date']}}</td>
					</tr>
				@endforeach
			@endif

			<!-- Total Paid-->
			@if(!empty($receipt_details->total_paid))
				<tr>
					<td style="font-weight:bold">
						{!! $receipt_details->total_paid_label !!}
					</td>
					<td class="align-right">
						{{$receipt_details->total_paid}}
					</td>
				</tr>
			@endif

			<!-- Total Due-->
			@if(!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label))
			<tr>
				<td style="font-weight:bold">
					{!! $receipt_details->total_due_label !!}
				</td>
				<td class="align-right">
					{{$receipt_details->total_due}}
				</td>
			</tr>
			@endif

			@if(!empty($receipt_details->all_due))
			<tr>
				<td style="font-weight:bold">
					{!! $receipt_details->all_bal_label !!}
				</td>
				<td class="align-right">
					{{$receipt_details->all_due}}
				</td>
			</tr>
			@endif
		</table>
	</div>

	<div class="col-md-6 col-sm-6 col-xs-6 width-50 f-left">
        <table class="table table-slim">
					<!-- Total quantity -->
					@if(!empty($receipt_details->total_quantity_label))
						<tr>
							<td style="width:60%; font-weight:bold">
								{!! $receipt_details->total_quantity_label !!}
							</td>
							<td class="align-right">
								{{$receipt_details->total_quantity}}
							</td>
						</tr>
					@endif

					<!-- Total items -->
					@if(!empty($receipt_details->total_items_label))
						<tr>
							<td style="width:60%; font-weight:bold">
								{!! $receipt_details->total_items_label !!}
							</td>
							<td class="align-right">
								{{$receipt_details->total_items}}
							</td>
						</tr>
					@endif
					
					<!-- Subtotal -->
					<tr>
						<td style="width:60%; font-weight:bold">
							{!! $receipt_details->subtotal_label !!}
						</td>
						<td class="align-right">
							{{$receipt_details->subtotal}}
						</td>
					</tr>
					
					@if(!empty($receipt_details->total_exempt_uf))
					<tr>
						<td style="width:60%; font-weight:bold">
							@lang('lang_v1.exempt')
						</td>
						<td class="align-right">
							{{$receipt_details->total_exempt}}
						</td>
					</tr>
					@endif

					<!-- Discount -->
					@if( !empty($receipt_details->discount) )
						<tr>
							<td style="width:60%; font-weight:bold">
								{!! $receipt_details->discount_label !!}
							</td>
							<td class="align-right">
								(-) {{$receipt_details->discount}}
							</td>
						</tr>
					@endif
					
					<!-- Shipping Charges -->
					@if(!empty($receipt_details->shipping_charges))
						<tr>
							<td style="width:60%; font-weight:bold">
								{!! $receipt_details->shipping_charges_label !!}
							</td>
							<td class="align-right">
								(+) {{$receipt_details->shipping_charges}}
							</td>
						</tr>
					@endif

					<!-- Packing Charges -->
					@if(!empty($receipt_details->packing_charge))
						<tr>
							<td style="width:60%; font-weight:bold">
								{!! $receipt_details->packing_charge_label !!}
							</td>
							<td class="align-right">
								(+) {{$receipt_details->packing_charge}}
							</td>
						</tr>
					@endif
					
					<!-- Expenses -->
					@if( !empty($receipt_details->additional_expenses) )
						@foreach($receipt_details->additional_expenses as $key => $val)
							<tr>
								<td style="width:60%; font-weight:bold">
									{{$key}}:
								</td>
								<td class="align-right">
									(+) {{$val}}
								</td>
							</tr>
						@endforeach
					@endif

					<!-- Reward point -->
					@if( !empty($receipt_details->reward_point_label) )
						<tr>
							<td style="width:60%; font-weight:bold">
								{!! $receipt_details->reward_point_label !!}
							</td>
							<td class="align-right">
								(-) {{$receipt_details->reward_point_amount}}
							</td>
						</tr>
					@endif

					<!-- Tax -->
					@if( !empty($receipt_details->tax) )
						<tr>
							<td style="width:60%; font-weight:bold">
								{!! $receipt_details->tax_label !!}
							</td>
							<td class="align-right">
								(+) {{$receipt_details->tax}}
							</td>
						</tr>
					@endif

					<!-- Round off -->
					@if( $receipt_details->round_off_amount > 0)
						<tr>
							<td style="width:60%; font-weight:bold">
								{!! $receipt_details->round_off_label !!}
							</td>
							<td class="align-right">
								{{$receipt_details->round_off}}
							</td>
						</tr>
					@endif

					<!-- Total -->
					<tr>
						<td style="width:60%; font-weight:bold">
							{!! $receipt_details->total_label !!}
						</td>
						<td class="align-right">
							{{$receipt_details->total}}
						</td>
					</tr>
					@if(!empty($receipt_details->total_in_words))
						<tr>
							<td colspan="2"><strong>Bằng chữ:</strong> {{ucfirst($receipt_details->total_in_words)}}</td>
						</tr>
					@endif

			<!-- tax -->
			@if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) && !empty($receipt_details->taxes))
				<tr>
	        		<th colspan="2" class="text-center"><br>{{$receipt_details->tax_summary_label}}</th>
	        	</tr>
	        	@foreach($receipt_details->taxes as $key => $val)
	        		<tr>
	        			<td style="width:60%"><strong>{{$key}}</strong></td>
	        			<td class="align-right">{{$val}}</td>
	        		</tr>
	        	@endforeach
			@endif
        </table>
    </div>

	@if(!empty($receipt_details->additional_notes))
	    <div class="col-md-12 col-sm-12 width-100">
	    	<p><strong>@lang('sale.sell_note'): </strong>{!! nl2br($receipt_details->additional_notes) !!}</p>
	    </div>
    @endif
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-md-6 col-sm-6 col-xs-6 width-50 f-left">
		<p class="text-center" style="text-align: center; color: #000000 !important"><strong>@lang('lang_v1.customers')</strong></p>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6 width-50 f-left">
		<p class="text-center" style="text-align: center; color: #000000 !important"><strong>AnToanHome</strong></p>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	@if(!empty($receipt_details->footer_text))
	<div class="@if($receipt_details->show_barcode || $receipt_details->show_qr_code) col-xs-8 @else col-xs-12 @endif">
		{!! $receipt_details->footer_text !!}
	</div>
	@endif
	@if($receipt_details->show_barcode || $receipt_details->show_qr_code)
		<div class="@if(!empty($receipt_details->footer_text)) col-xs-4 @else col-xs-12 @endif text-center">
			@if($receipt_details->show_barcode)
				{{-- Barcode --}}
				<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
			@endif
			
			@if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text))
				<img class="center-block mt-5" src="data:image/png;base64,{{DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54])}}">
			@endif
		</div>
	@endif
</div>