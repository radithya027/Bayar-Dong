<!-- Edit Order tax Modal -->
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('lang_v1.view_invoice_url') - @lang('sale.invoice_no'): {{$transaction->invoice_no}}</h4>
		</div>
		<div class="modal-body">
			<div class="form-group">
				<input type="text" class="form-control" value="{{$url}}" id="invoice_url" readonly>
				<p class="help-block">@lang('lang_v1.invoice_url_help')</p>
			</div>
		</div>
		<div class="modal-footer">
		    <button type="button" class="tw-dw-btn tw-dw-btn-success tw-text-white" onclick="copyInvoiceURL()">
		    	@lang('lang_v1.copy')
		    </button>
		    <a href="{{$url}}" id="view_invoice_url" class="tw-dw-btn tw-dw-btn-primary tw-text-white hover:tw-text-white">
				@lang('messages.view')
			</a>
		    <button type="button" class="tw-dw-btn tw-dw-btn-neutral tw-text-white" data-dismiss="modal">
		    	@lang('messages.close')
		    </button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
function copyInvoiceURL() {
  // Get the text field
  var copyText = document.getElementById("invoice_url");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  toastr.success(LANG.copied_to_clipboard);
}
</script>