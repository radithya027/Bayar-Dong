@extends('layouts.app')

@section('title', __('sale.pos_sale'))

@section('content')
<section class="content no-print">

    <div>
        <p>asdsjijasijdsai7777</p>
        @if(session('snap_token'))
        <div class="alert alert-success">
            {!! session('snap_token') !!}
        </div>
        @endif
    </div>


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
            <div
                class="row tw-flex lg:tw-flex-row md:tw-flex-col sm:tw-flex-col tw-flex-col tw-items-start md:tw-gap-4">
                @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
                <div class="md:tw-no-padding tw-w-full lg:tw-w-[50%]">
                    @include('sale_pos.partials.pos_sidebar')
                </div>
                @endif
                <div
                    class="tw-px-3 tw-w-full  lg:tw-px-0 lg:tw-pr-0 @if(empty($pos_settings['hide_product_suggestion'])) lg:tw-w-[50%]  @else lg:tw-w-[100%] @endif">

                    <div
                        class="tw-shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] tw-rounded-2xl tw-bg-white tw-mb-2 md:tw-mb-8 tw-p-2">


                        {{-- <div class="box box-solid mb-12 @if (!isMobile()) mb-40 @endif"> --}}
                            <div class="box-body pb-0">
                                {!! Form::hidden('location_id', $default_location->id ?? null, [
                                'id' => 'location_id',
                                'data-receipt_printer_type' => !empty($default_location->receipt_printer_type)
                                ? $default_location->receipt_printer_type
                                : 'browser',
                                'data-default_payment_accounts' => $default_location->default_payment_accounts ??
                                '',
                                ]) !!}
                                <!-- sub_type -->
                                {!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
                                <input type="hidden" id="item_addition_method"
                                    value="{{ $business_details->item_addition_method }}">
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
                            {{--
                        </div> --}}
                    </div>
                </div>
                {{-- @if (empty($pos_settings['hide_product_suggestion']) && !isMobile())
                <div class="md:tw-no-padding tw-w-full lg:tw-w-[40%] tw-px-5">
                    @include('sale_pos.partials.pos_sidebar')
                </div>
                @endif --}}
            </div>
        </div>
    </div>
    @include('sale_pos.partials.pos_form_actions')
    {!! Form::close() !!}
</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    @include('contact.create', ['quick_add' => true])
</div>
@if (empty($pos_settings['hide_product_suggestion']) && isMobile())
@include('sale_pos.partials.mobile_product_suggestions')
@endif
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

<div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

@include('sale_pos.partials.configure_search_modal')

@include('sale_pos.partials.recent_transactions_modal')
 
@include('sale_pos.partials.weighing_scale_modal')

@stop
@section('css')
<!-- include module css -->
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

<!-- Call restaurant module if defined -->
@if (in_array('tables', $enabled_modules) ||
in_array('modifiers', $enabled_modules) ||
in_array('service_staff', $enabled_modules))
<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
@endif
<!-- include module js -->
@if (!empty($pos_module_data))
@foreach ($pos_module_data as $key => $value)
@if (!empty($value['module_js_path']))
@includeIf($value['module_js_path'], ['view_data' => $value['view_data']])
@endif
@endforeach
@endif
@endsection



{{-- <script>
    window.onbeforeunload = null;
    window.removeEventListener('beforeunload');

    
</script> --}}

<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('add_pos_sell_form');

    form.addEventListener('submit', async function(e) {
        e.preventDefault(); // Mencegah form submit biasa

        try {
            // Ambil data form dan CSRF token
            const formData = new FormData(this);
            const formDataObj = Object.fromEntries(formData.entries());
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            console.log('Mengirim transaksi ke /pos/store...');
            
            // Step 1: Simpan transaksi terlebih dahulu
            const transaction = await saveTransaction(formDataObj, csrfToken);

            console.log('Response transaksi:', transaction);

            if (!transaction || !transaction.id) {
                throw new Error('Transaction ID tidak ditemukan dalam response');
            }

            // Step 2: Proses pembayaran Midtrans
            console.log('Menginisialisasi pembayaran dengan Midtrans...');
            await processMidtransPayment(transaction.id, csrfToken);

        } catch (error) {
            console.error('Error:', error);
            alert('Error: ' + error.message);
        }
    });

    // Fungsi menyimpan transaksi ke database
    async function saveTransaction(formDataObj, csrfToken) {
        const response = await fetch('/pos/store', {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(formDataObj)
        });

        $is_direct_sale = $request->has('is_direct_sale') ? $request->input('is_direct_sale') : false;


        const data = await response.json();
        console.log('Response dari /pos/store:', data);

        if (!response.ok || !data.success) {
            throw new Error(data.message || 'Gagal menyimpan transaksi');
        }

        return data.transaction;
    }

    // Fungsi memproses pembayaran dengan Midtrans
    async function processMidtransPayment(transactionId, csrfToken) {
    console.log("Mengirim request ke /paymidtrans/" + transactionId);

    const response = await fetch(`/paymidtrans/${transactionId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });

    const data = await response.json();
    console.log('Response dari /paymidtrans:', data);

    if (!response.ok || !data.success) {
        throw new Error(data.message || 'Gagal memproses pembayaran');
    }

    if (!data.data || !data.data.snap_token) {
        throw new Error('Snap token tidak ditemukan dalam response');
    }

    console.log('Snap token didapatkan:', data.data.snap_token);
    openSnapPayment(data.data.snap_token, transactionId);
}

function openSnapPayment(snapToken, transactionId) {
    console.log("Memanggil snap.pay dengan token:", snapToken);

    if (typeof snap === 'undefined') {
        alert('Error: Midtrans Snap library tidak tersedia');
        return;
    }

    snap.pay(snapToken, {
        onSuccess: function(result) {
            console.log('Pembayaran sukses:', result);
            alert('Pembayaran berhasil!');
            window.location.href = '/snap-view/' + transactionId;
        },
        onPending: function(result) {
            console.log('Pembayaran pending:', result);
            alert('Menunggu pembayaran...');
        },
        onError: function(result) {
            console.error('Pembayaran gagal:', result);
            alert('Pembayaran gagal!');
        },
        onClose: function() {
            console.log('User menutup halaman pembayaran');
        }
    });
}

});
</script>

