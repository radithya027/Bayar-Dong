<style>
@media print {
  #scrollable-container {
    position: absolute;
  }
}
</style>

<div class="row" style="color: #000000 !important;">
	<!-- Logo -->
	@if(!empty($receipt_details->logo))
		<img style="max-height: 120px; width: auto;" src="{{$receipt_details->logo}}" class="img img-responsive center-block">
	@endif

	<!-- Header text -->
	@if(!empty($receipt_details->header_text))
		<div class="col-xs-12">
			{!! $receipt_details->header_text !!}
		</div>
	@endif

	<!-- business information here -->
	<div class="col-xs-12 text-center">
		<!-- Shop Name  -->
		@if(!empty($receipt_details->display_name))
			<h3 class="text-center" style="color: #000000 !important">
			{{$receipt_details->display_name}}
			</h3>
		@endif

		<!-- Title of receipt -->
		<h2 class="text-center" style="color: #000000 !important">
			@lang('lang_v1.packing_slip')
		</h2>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-6">
		<!-- Invoice  number  -->
		@if(!empty($receipt_details->invoice_no_prefix))
			<b>{!! $receipt_details->invoice_no_prefix !!} </b>
		@endif
		{{$receipt_details->invoice_no}}
	</div>
	<div class="col-xs-6">
		<!-- Date-->
		@if(!empty($receipt_details->date_label))
			<b>{{$receipt_details->date_label}} </b>
				{{$receipt_details->invoice_date}}
			</p>
		@endif
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-6">
		@if(!empty($receipt_details->customer_label))
			<b>{{ $receipt_details->customer_label }}</b> 
		@endif

		<!-- customer info -->
		@if(!empty($receipt_details->customer_info))
			{!! $receipt_details->customer_info !!}
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
	</div>
	<div class="col-xs-6">
		<strong>@lang('lang_v1.shipping_address'):</strong><br>
		{!! $receipt_details->shipping_address !!}
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
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-12">
		<br/>
		<table class="table table-bordered" style="border-color: #000000 !important">
			<thead>
				<tr style="background-color: #d2d6de !important; font-weight:bold" class="text-center">
					<td style="width: 5% !important; border-color: #000000 !important">TT</td>
					<td style="width: 20% !important; border-color: #000000 !important">@lang('product.sku')</td>
					<td style="width: 65% !important; border-color: #000000 !important">
						{{$receipt_details->table_product_label}}
					</td>
					<td style="width: 10% !important; border-color: #000000 !important">
						{{$receipt_details->table_qty_label}}
					</td>
				</tr>
			</thead>
			<tbody>
				@foreach($receipt_details->lines as $line)
					<tr>
						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-center">
							{{$loop->iteration}}
						</td>
						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-center">
                            @if(!empty($line['sub_sku'])){{$line['sub_sku']}}@endif
						</td>
						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" style="word-break: break-all;">
                            {{$line['name']}} {{$line['product_variation']}} {{$line['variation']}} 
							@if(!empty($line['brand'])), @lang('product.brand'): {{$line['brand']}} @endif
							@if(!empty($line['cat_code'])), {{$line['cat_code']}}@endif
                            @if(!empty($line['product_custom_fields'])), {{$line['product_custom_fields']}} @endif
							@if(!empty($line['product_description']))<br>@lang('lang_v1.description'): {{$line['product_description']}} @endif
                            @if(!empty($line['sell_line_note']))<br>@lang('brand.note'): {{$line['sell_line_note']}} @endif
                            @if(!empty($line['lot_number']))<br> {{$line['lot_number_label']}}: {{$line['lot_number']}} @endif 
                            @if(!empty($line['product_expiry'])), {{$line['product_expiry_label']}}: {{$line['product_expiry']}} @endif 
                        </td>
						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-center">
							{{$line['quantity']}} {{$line['units']}}
						</td>
					</tr>
					@if(!empty($line['modifiers']))
						@foreach($line['modifiers'] as $modifier)
							<tr>
								<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-center">
									&nbsp;
								</td>
								<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-center">
		                            @if(!empty($modifier['sub_sku'])){{$modifier['sub_sku']}}@endif 
								</td>
								<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important">
		                            {{$modifier['name']}} {{$modifier['variation']}} 
		                            @if(!empty($modifier['sell_line_note']))<br>@lang('brand.note'): {{$modifier['sell_line_note']}} @endif 
		                        </td>
								<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-center">
									{{$modifier['quantity']}} {{$modifier['units']}}
								</td>
							</tr>
						@endforeach
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-4">
		<p class="text-center"><b>Người nhận hàng</b></p>
	</div>
	<div class="col-xs-4">
		<p class="text-center"><b>Người giao hàng</b></p>
	</div>
	<div class="col-xs-4">
		<p class="text-center"><b>Người lập phiếu</b></p>
	</div>
</div>

{{-- Barcode --}}
@if($receipt_details->show_barcode)
<br>
<div class="row" style="color: #000000 !important;">
		<div class="col-xs-12">
			<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
		</div>
</div>
@endif

@if(!empty($receipt_details->footer_text))
	<div class="row" style="color: #000000 !important;">
		<div class="col-xs-12">
			{!! $receipt_details->footer_text !!}
		</div>
	</div>
@endif