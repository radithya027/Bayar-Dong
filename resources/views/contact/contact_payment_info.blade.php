@if( $contact->type == 'supplier' || $contact->type == 'both')
    <strong>@lang('report.total_purchase')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_purchase }}</span>
    </p>
    <strong>@lang('contact.total_purchase_paid')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->purchase_paid }}</span>
    </p>
    <strong>@lang('contact.total_purchase_due')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_purchase - $contact->purchase_paid }}</span>
    </p>
	<strong>@lang('lang_v1.total_purchase_return')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_purchase_return }}</span>
    </p>
	<strong>@lang('lang_v1.total_purchase_return_paid')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->purchase_return_paid }}</span>
    </p>
    <strong>@lang('lang_v1.total_purchase_return_due')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_purchase_return -  $contact->purchase_return_paid }}</span>
    </p>
	<strong>@lang('lang_v1.ledger_discount') - @lang('lang_v1.purchase')</strong>
	<p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_ledger_discount_purchase }}</span>
	</p>
@endif
@if( $contact->type == 'customer' || $contact->type == 'both')
    <strong>@lang('report.total_sell')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_invoice }}</span>
    </p>
    <strong>@lang('contact.total_sale_paid')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->invoice_received }}</span>
    </p>
    <strong>@lang('contact.total_sale_due')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_invoice - $contact->invoice_received }}</span>
    </p>
    <strong>@lang('lang_v1.total_sell_return')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_sell_return }}</span>
    </p>
	<strong>@lang('lang_v1.total_sell_return_paid')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->sell_return_paid }}</span>
    </p>
    <strong>@lang('lang_v1.total_sell_return_due')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_sell_return -  $contact->sell_return_paid }}</span>
    </p>
	<strong>@lang('lang_v1.ledger_discount') - @lang('sale.sale')</strong>
	<p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_ledger_discount_sell }}</span>
	</p>
@endif
@if(!empty($contact->opening_balance) && $contact->opening_balance != '0.00')
    <strong>@lang('lang_v1.opening_balance')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->opening_balance }}</span>
    </p>
    <strong>@lang('lang_v1.opening_balance_due')</strong>
    <p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->opening_balance - $contact->opening_balance_paid }}</span>
    </p>
@endif
<strong>@lang('lang_v1.advance_balance')</strong>
<p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->balance }}</span>
</p>
<strong>@lang('lang_v1.balance')</strong>
<p class="text-muted">
    <span class="display_currency" data-currency_symbol="true">
    {{ $contact->total_purchase - $contact->purchase_paid - $contact->total_purchase_return +  $contact->purchase_return_paid + $contact->total_ledger_discount_sell - $contact->total_invoice + $contact->invoice_received + $contact->total_sell_return -  $contact->sell_return_paid - $contact->total_ledger_discount_purchase + $contact->opening_balance - $contact->opening_balance_paid + $contact->balance }}</span>
</p>