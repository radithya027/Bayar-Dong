<a href="{{ action([\App\Http\Controllers\TransactionPaymentController::class, 'show'], [$id])}}" class="view_payment_modal payment-status-label tw-dw-btn tw-dw-btn-xs tw-dw-btn-outline @payment_status($payment_status)" data-orig-value="{{$payment_status}}" data-status-name="{{__('lang_v1.' . $payment_status)}}">
	{{__('lang_v1.' . $payment_status)}}
</a>