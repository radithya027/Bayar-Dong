@extends('layouts.app')

@section('title', __('sale.pos_sale'))

@section('content')
<section class="content no-print" style="font-family: 'Poppins', sans-serif;">
    <input type="hidden" id="amount_rounding_method" value="{{ $pos_settings['amount_rounding_method'] ?? '' }}">
    @if (!empty($pos_settings['allow_overselling']))
    <input type="hidden" id="is_overselling_allowed">
    @endif
    @if (session('business.enable_rp') == 1)
    <input type="hidden" id="reward_point_enabled">
    @endif
    @php
    $is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
    $is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
    @endphp
    {!! Form::open([
    'url' => action([\App\Http\Controllers\SellPosController::class, 'store']),
    'method' => 'post',
    'id' => 'add_pos_sell_form',
    ]) !!}
    <div class="row mb-12">
        <div class="col-md-12 tw-pt-0 tw-mb-14">
            <div class="row tw-flex lg:tw-flex-row md:tw-flex-col sm:tw-flex-col tw-flex-col tw-items-start md:tw-gap-4">
                @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
                <div class="md:tw-no-padding tw-w-full lg:tw-w-[50%]">
                    @include('sale_pos.partials.pos_sidebar')
                </div>
                @endif
                <div class="tw-px-3 tw-w-full lg:tw-px-0 lg:tw-pr-0 @if(empty($pos_settings['hide_product_suggestion'])) lg:tw-w-[50%]  @else lg:tw-w-[100%] @endif">
                    <div class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-rounded-2xl tw-bg-white tw-mb-2 md:tw-mb-8 tw-p-2">
                        <div class="box-body pb-0">
                            {!! Form::hidden('location_id', $default_location->id ?? null, [
                            'id' => 'location_id',
                            'data-receipt_printer_type' => !empty($default_location->receipt_printer_type)
                            ? $default_location->receipt_printer_type
                            : 'browser',
                            'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '',
                            ]) !!}
                            {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
                            <input type="hidden" id="item_addition_method" value="{{ $business_details->item_addition_method }}">
                            <input type="hidden" id="new_transaction_id" value="">
                            @include('sale_pos.partials.pos_form')
                            @include('sale_pos.partials.pos_form_totals')
                            @include('sale_pos.partials.payment_modal')
                            @if (empty($pos_settings['disable_suspend']))
                            @include('sale_pos.partials.suspend_note_modal')
                            @endif
                            @if (empty($pos_settings['disable_recurring_invoice']))
                            @include('sale_pos.partials.recurring_invoice_modal')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sale_pos.partials.pos_form_actions')
    {!! Form::close() !!}
</section>

<section class="invoice print_section" id="receipt_section" style="font-family: 'Poppins', sans-serif;">
</section>

<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    @include('contact.create', ['quick_add' => true])
</div>
@if (empty($pos_settings['hide_product_suggestion']) && isMobile())
@include('sale_pos.partials.mobile_product_suggestions')
@endif

<div class="modal fade register_details_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
<div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

@include('sale_pos.partials.configure_search_modal')
@include('sale_pos.partials.recent_transactions_modal')
@include('sale_pos.partials.weighing_scale_modal')

@stop

@section('css')
@if (!empty($pos_module_data))
@foreach ($pos_module_data as $key => $value)
@if (!empty($value['module_css_path']))
@includeIf($value['module_css_path'])
@endif
@endforeach
@endif
@stop

@section('javascript')
<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
@include('sale_pos.partials.keyboard_shortcuts')

@if (in_array('tables', $enabled_modules) ||
in_array('modifiers', $enabled_modules) ||
in_array('service_staff', $enabled_modules))
<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
@endif

@if (!empty($pos_module_data))
@foreach ($pos_module_data as $key => $value)
@if (!empty($value['module_js_path']))
@includeIf($value['module_js_path'], ['view_data' => $value['view_data']])
@endif
@endforeach
@endif
@endsection


{{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    let lastTransactionId = $('#latest_transaction_id').val() || localStorage.getItem('lastTransactionId');

// Handle klik tombol "View Last Transaction"
$('#viewLastTransaction').on('click', function() {
    let currentTransId = lastTransactionId || $('#new_transaction_id').val();
    
    if (!currentTransId || currentTransId === "undefined" || currentTransId === "0") {
        alert("Tidak ada transaksi terbaru. Silakan buat transaksi terlebih dahulu.");
    } else {
        window.location.href = `/snap-view/${currentTransId}`;
    }
});


    // Handle form submission
    $('#add_pos_sell_form').on('submit', function (e) {
        e.preventDefault(); // Prevent page reload

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            url: form.attr('action'), 
            type: form.attr('method'),
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function (response) {
                console.log("Transaction response:", response);
                
                // Periksa apakah transaksi berhasil dibuat
                if (response.success) {
                    let transactionId = response.transactionId;

                    if (transactionId && transactionId !== "undefined") {
                        // Store transaction ID in multiple places for redundancy
                        lastTransactionId = transactionId;
                        $('#new_transaction_id').val(transactionId);
                        localStorage.setItem('transactionId', transactionId);
                        
                        console.log("Stored transaction ID:", transactionId);
                        
                        // Call Midtrans payment process
                        processMidtransPayment(transactionId);
                    } else {
                        console.error("Invalid transaction ID:", transactionId);
                        alert("Transaksi berhasil dibuat, tetapi ID transaksi tidak valid.");
                    }
                } else {
                    // Jika transaksi gagal, tampilkan pesan error dari backend
                    console.error("Transaction failed:", response.msg);
                    alert(response.msg); // Tampilkan pesan error ke pengguna
                }
            },
            error: function (xhr) {
                console.error("Error creating transaction:", xhr);
                alert("Terjadi kesalahan saat membuat transaksi. Silakan coba lagi.");
            }
        });
    });

    // Function to process Midtrans payment
    function processMidtransPayment(transactionId) {
        console.log("Processing Midtrans payment for transaction:", transactionId);
        
        $.ajax({
            url: `/paymidtrans/${transactionId}`, // Call Midtrans API
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function (response) {
                console.log("Midtrans response:", response);
                
                if (response.success) {
                    let snapToken = response.data.snap_token;

                    snap.pay(snapToken, {
                        onSuccess: function (result) {
                            alert("Pembayaran berhasil!");
                            console.log(result);
                            window.location.href = "/snap-view/" + transactionId;
                        },
                        onPending: function (result) {
                            alert("Pembayaran tertunda.");
                            console.log(result);
                            window.location.href = "/snap-view/" + transactionId;
                        },
                        onError: function (result) {
                            alert("Pembayaran gagal.");
                            console.log(result);
                            window.location.href = "/snap-view/" + transactionId;
                        },
                        onClose: function () {
                            alert("Pembayaran ditutup oleh pengguna.");
                            window.location.href = "/snap-view/" + transactionId;
                        }
                    });
                } else {
                    alert("Gagal mendapatkan token pembayaran.");
                    window.location.href = "/snap-view/" + transactionId;
                }
            },
            error: function (xhr) {
                console.error("Error processing payment:", xhr);
                alert("Terjadi kesalahan saat memproses pembayaran.");
                window.location.href = "/snap-view/" + transactionId;
            }
        });
    }
    
    // Save transaction ID before leaving the page
    window.addEventListener('beforeunload', function(e) {
        let currentTransId = $('#new_transaction_id').val() || lastTransactionId;
        if (currentTransId && currentTransId !== "undefined" && currentTransId !== "0") {
            localStorage.setItem('lastTransactionId', currentTransId);
        }
    });
});
</script> --}}