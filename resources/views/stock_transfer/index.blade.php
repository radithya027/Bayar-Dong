@extends('layouts.app')
@section('title', __('lang_v1.stock_transfers'))

@section('content')

<section class="content-header no-print">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black" style="font-family: 'Poppins', sans-serif;">
        @lang('lang_v1.stock_transfers')
    </h1>
</section>

<!-- Main content -->
<section class="content no-print">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.all_stock_transfers')])
        @slot('tool')
            <div class="box-tools">
                @if(auth()->user()->can('purchase.create'))
                  <a class="tw-dw-btn tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full pull-right hover:no-underline hover:tw-text-white" 
                    style="background-color: #1E2B32"
                    href="{{action([\App\Http\Controllers\StockTransferController::class, 'create'])}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg> @lang('messages.add')
                    </a>
                @endif
            </div>
        @endslot
        <div class="table-responsive" style="font-family: 'Poppins', sans-serif;">
            <table class="table table-bordered table-striped ajax_view" id="stock_transfer_table" style="font-family: 'Poppins', sans-serif;">
                <thead>
                    <tr>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('messages.date')</th>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('purchase.ref_no')</th>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('lang_v1.location_from')</th>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('lang_v1.location_to')</th>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('sale.status')</th>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('lang_v1.shipping_charges')</th>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('stock_adjustment.total_amount')</th>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('purchase.additional_notes')</th>
                        <th style="font-family: 'Poppins', sans-serif;">@lang('messages.action')</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endcomponent
</section>

@include('stock_transfer.partials.update_status_modal')

<section id="receipt_section" class="print_section"></section>

@stop
@section('javascript')
	<script src="{{ asset('js/stock_transfer.js?v=' . $asset_v) }}"></script>
@endsection

@cannot('view_purchase_price')
    <style>
        .show_price_with_permission {
            display: none !important;
        }
    </style>
@endcannot