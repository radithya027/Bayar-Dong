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
		@if(!empty($receipt_details->invoice_heading))
			<h2 class="text-center" style="color: #000000 !important">
			{!! $receipt_details->invoice_heading !!}
			</h2>
		@endif
	</div>
	<div class="col-xs-6">
		<p>
			@if(!empty($receipt_details->invoice_no_prefix))
				<b>{!! $receipt_details->invoice_no_prefix !!} </b>
			@endif
			{{$receipt_details->invoice_no}}
			<br/>
			@if(!empty($receipt_details->parent_invoice_no_prefix))
				<b>Của hóa đơn bán lẻ số: </b>
			@endif
			{{$receipt_details->parent_invoice_no}}
		</p>
		<!-- Table information-->
        @if(!empty($receipt_details->table_label) || !empty($receipt_details->table))
        	<p>
				@if(!empty($receipt_details->table_label))
					{!! $receipt_details->table_label !!}
				@endif
				{{$receipt_details->table}}
			</p>
        @endif

		<!-- Waiter info -->
		@if(!empty($receipt_details->waiter_label) || !empty($receipt_details->waiter))
        	<p>
				@if(!empty($receipt_details->waiter_label))
					{!! $receipt_details->waiter_label !!}
				@endif
				{{$receipt_details->waiter}}
			</p>
        @endif
	</div>

	<div class="col-xs-6">
		<!-- Date-->
		@if(!empty($receipt_details->date_label))
			<p style="width: 100% !important" class="word-wrap">
				<span class="pull-right text-left">
					<b>{{$receipt_details->date_label}}</b> {{$receipt_details->invoice_date}}
				</span>
			</p>
		@endif

		{{--
			<table class="table table-condensed">

				@if(!empty($receipt_details->payments))
					@foreach($receipt_details->payments as $payment)
						<tr>
							<td>{{$payment['method']}}</td>
							<td>{{$payment['amount']}}</td>
						</tr>
					@endforeach
				@endif
			</table>
		--}}

		<!-- Total Due-->
		@if(!empty($receipt_details->total_due))
			<p class="bg-light-blue-active text-right padding-5">
				<span class="pull-left bg-light-blue-active">
					{!! $receipt_details->total_due_label !!}
				</span>

				{{$receipt_details->total_due}}
			</p>
		@endif
		
		<!-- Total Paid-->
		@if(!empty($receipt_details->total_paid))
			<p class="text-right">
				<span class="pull-left">{!! $receipt_details->total_paid_label !!}</span>
				{{$receipt_details->total_paid}}
			</p>
		@endif
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-6">
		<b>{{ $receipt_details->customer_label ?? '' }}</b><br/>

		<!-- customer info -->
		@if(!empty($receipt_details->customer_info))
			{!! $receipt_details->customer_info !!}
		@endif
		@if(!empty($receipt_details->client_id_label))
			<br/>
			{{ $receipt_details->client_id_label }} {{ $receipt_details->client_id }}
		@endif
		@if(!empty($receipt_details->customer_tax_label))
			<br/>
			{{ $receipt_details->customer_tax_label }} {{ $receipt_details->customer_tax_number }}
		@endif
		@if(!empty($receipt_details->customer_custom_fields))
			<br/>{!! $receipt_details->customer_custom_fields !!}
		@endif
	</div>
	
	<div class="col-xs-6">
		<p>
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
	
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-12">
		<br/>
		<table class="table table-bordered">
			<thead>
				<tr style="background-color: #d2d6de !important; font-weight:bold" class="text-center">
					<td style="width: 5% !important; border-color: #000000 !important">TT</td>
					
					@php
						$p_width = 35;
					@endphp
					@if($receipt_details->show_cat_code != 1)
						@php
							$p_width = 45;
						@endphp
					@endif
					<td style="width: {{$p_width}}% !important; border-color: #000000 !important">
						{{$receipt_details->table_product_label}}
					</td>

					@if($receipt_details->show_cat_code == 1)
						<td style="width: 10% !important; border-color: #000000 !important">{{$receipt_details->cat_code_label}}</td>
					@endif
					
					<td style="width: 15% !important; border-color: #000000 !important">
						{{$receipt_details->table_qty_label}}
					</td>
					<td style="width: 15% !important; border-color: #000000 !important">
						{{$receipt_details->table_unit_price_label}}
					</td>
					<td style="width: 20% !important; border-color: #000000 !important">
						{{$receipt_details->table_subtotal_label}}
					</td>
				</tr>
			</thead>
			<tbody>
				@foreach($receipt_details->lines as $line)
					<tr>
						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-center">
							{{$loop->iteration}}
						</td>
						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important">
                            {{$line['name']}} {{$line['variation']}} 
                            @if(!empty($line['sub_sku']))<br>@lang('product.sku'): {{$line['sub_sku']}} @endif
							@if(!empty($line['brand'])), @lang('product.brand'): {{$line['brand']}} @endif
                            @if(!empty($line['sell_line_note']))({{$line['sell_line_note']}}) @endif 
                        </td>

						@if($receipt_details->show_cat_code == 1)
	                        <td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important">
	                        	@if(!empty($line['cat_code']))
	                        		{{$line['cat_code']}}
	                        	@endif
	                        </td>
	                    @endif

						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-right">
							{{$line['quantity']}} {{$line['units']}}
						</td>
						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-right">
							{{$line['unit_price_exc_tax']}}
						</td>
						<td style="background-color: #ffffff !important; color: #000000 !important; border-color: #000000 !important" class="text-right">
							{{$line['line_total']}}
						</td>
					</tr>
				@endforeach

				@php
					$lines = count($receipt_details->lines);
				@endphp

				@for ($i = $lines; $i < 1; $i++)
    				<tr>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					@if($receipt_details->show_cat_code == 1)
							<td>&nbsp;</td>
						@endif
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    					<td>&nbsp;</td>
    				</tr>
				@endfor

			</tbody>
		</table>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-6">
	</div>

	<div class="col-xs-6">
		<table class="table table-slim">
			<tbody>
				<!-- Subtotal -->
				<tr>
					<th style="width:60%; background-color: #ffffff !important; color: #000000 !important">
						{!! $receipt_details->subtotal_label !!}
					</th>
					<td style="background-color: #ffffff !important; color: #000000 !important" class="text-right">
						{{$receipt_details->subtotal}}
					</td>
				</tr>

				<!-- Tax -->
				@if(!empty($receipt_details->taxes))
					@foreach($receipt_details->taxes as $k => $v)
						<tr>
							<th style="width:60%; background-color: #ffffff !important; color: #000000 !important">{{$k}}</th>
							<td style="background-color: #ffffff !important; color: #000000 !important" class="text-right">{{$v}}</td>
						</tr>
					@endforeach
				@endif

				<!-- Discount -->
				@if( !empty($receipt_details->discount) )
					<tr>
						<th style="width:60%; background-color: #ffffff !important; color: #000000 !important">
							{!! $receipt_details->discount_label !!}
						</th>
						<td style="background-color: #ffffff !important; color: #000000 !important" class="text-right">
							(-) {{$receipt_details->discount}}
						</td>
					</tr>
				@endif

				<!-- Group tax -->
				@if(!empty($receipt_details->group_tax_details))
					@foreach($receipt_details->group_tax_details as $key => $value)
						<tr>
							<th style="width:60%; background-color: #ffffff !important; color: #000000 !important">
								{!! $key !!}
							</th>
							<td style="background-color: #ffffff !important; color: #000000 !important" class="text-right">
								(+) {{$value}}
							</td>
						</tr>
					@endforeach
				@else
					@if( !empty($receipt_details->tax) )
						<tr>
							<th style="width:60%; background-color: #ffffff !important; color: #000000 !important">
								{!! $receipt_details->tax_label !!}
							</th>
							<td style="background-color: #ffffff !important; color: #000000 !important" class="text-right">
								(+) {{$receipt_details->tax}}
							</td>
						</tr>
					@endif
				@endif
				
				<!-- Total -->
				<tr>
					<th style="width:60%; background-color: #ffffff !important; color: #000000 !important">
						{!! $receipt_details->total_label !!}
					</th>
					<td style="background-color: #ffffff !important; color: #000000 !important" class="text-right">
						{{$receipt_details->total}}
					</td>
				</tr>
			</tbody>
        </table>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-6">
		<p class="text-center"><b>@lang('lang_v1.customers')</b></p>
	</div>
	<div class="col-xs-6">
		<p class="text-center"><b>{{ Session::get('business.name') }}</b></p>
	</div>
</div>

<div class="row" style="color: #000000 !important;">
	<div class="col-xs-6">
		{{$receipt_details->additional_notes}}
	</div>

	{{-- Barcode --}}
	@if($receipt_details->show_barcode)
		<div class="col-xs-6">
			<img class="center-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true)}}">
		</div>
	@endif
</div>

@if(!empty($receipt_details->footer_text))
	<div class="row" style="color: #000000 !important;">
		<div class="col-xs-12">
			{!! $receipt_details->footer_text !!}
		</div>
	</div>
@endif