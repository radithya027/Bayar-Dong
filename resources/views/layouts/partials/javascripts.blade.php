<script type="text/javascript">
    base_path = "{{ url('/') }}";
    //used for push notification
    APP = {};
    APP.PUSHER_APP_KEY = '{{ config('broadcasting.connections.pusher.key') }}';
    APP.PUSHER_APP_CLUSTER = '{{ config('broadcasting.connections.pusher.options.cluster') }}';
    APP.INVOICE_SCHEME_SEPARATOR = '{{ config('constants.invoice_scheme_separator') }}';
    //variable from app service provider
    APP.PUSHER_ENABLED = '{{ $__is_pusher_enabled }}';
    @auth
    @php
        $user = Auth::user();
    @endphp
    APP.USER_ID = "{{ $user->id }}";
    @else
        APP.USER_ID = '';
    @endauth
</script>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js?v=$asset_v"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js?v=$asset_v"></script>
<![endif]-->

<script src="{{ asset('js/vendor.js?v=' . $asset_v) }}"></script>

@if (file_exists(public_path('js/lang/' . session()->get('user.language', config('app.locale')) . '.js')))
    <script src="{{ asset('js/lang/' . session()->get('user.language', config('app.locale')) . '.js?v=' . $asset_v) }}">
    </script>
@else
    <script src="{{ asset('js/lang/en.js?v=' . $asset_v) }}"></script>
@endif

@if (file_exists(public_path('vendor/select2/lang/' . session()->get('user.language', config('app.locale')) . '.js')))
    <script src="{{ asset('vendor/select2/lang/' . session()->get('user.language', config('app.locale')) . '.js?v=' . $asset_v) }}">
    </script>
@endif
@php
    $validation_lang_file = 'messages_' . session()->get('user.language', config('app.locale')) . '.js';
@endphp
@if (file_exists(public_path() . '/vendor/jquery-validation-1.16.0/src/localization/' . $validation_lang_file))
    <script src="{{ asset('vendor/jquery-validation-1.16.0/src/localization/' . $validation_lang_file . '?v=' . $asset_v) }}">
    </script>
@endif

@php
    $business_date_format = session('business.date_format', config('constants.default_date_format'));
    $datepicker_date_format = str_replace('d', 'dd', $business_date_format);
    $datepicker_date_format = str_replace('m', 'mm', $datepicker_date_format);
    $datepicker_date_format = str_replace('Y', 'yyyy', $datepicker_date_format);

    $moment_date_format = str_replace('d', 'DD', $business_date_format);
    $moment_date_format = str_replace('m', 'MM', $moment_date_format);
    $moment_date_format = str_replace('Y', 'YYYY', $moment_date_format);

    $business_time_format = session('business.time_format');
    $moment_time_format = 'HH:mm';
    if ($business_time_format == 12) {
        $moment_time_format = 'hh:mm A';
    }

    $common_settings = !empty(session('business.common_settings')) ? session('business.common_settings') : [];

    $default_datatable_page_entries = !empty($common_settings['default_datatable_page_entries'])
        ? $common_settings['default_datatable_page_entries']
        : 25;
@endphp

<script>
    Dropzone.autoDiscover = false;
    moment.tz.setDefault('{{ Session::get('business.time_zone') }}');
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        @if (config('app.debug') == false)
            $.fn.dataTable.ext.errMode = 'throw';
        @endif
    });

    var financial_year = {
        start: moment('{{ Session::get('financial_year.start') }}'),
        end: moment('{{ Session::get('financial_year.end') }}'),
    }

    var datepicker_date_format = "{{ $datepicker_date_format }}";
    var moment_date_format = "{{ $moment_date_format }}";
    var moment_time_format = "{{ $moment_time_format }}";

    var app_locale = "{{ session()->get('user.language', config('app.locale')) }}";
	jQuery.extend($.fn.datetimepicker.defaults, {locale: app_locale});
    @if (file_exists(public_path('vendor/select2/lang/' . session()->get('user.language', config('app.locale')) . '.js')))
        //Default setting for select2
        $.fn.select2.defaults.set("language", app_locale);
    @endif

    var non_utf8_languages = [
        @foreach (config('constants.non_utf8_languages') as $const)
            "{{ $const }}",
        @endforeach
    ];

	var __decimal_separator = "{{ session('currency')['decimal_separator'] ?? '.'  }}";
	var __thousand_separator = "{{ session('currency')['thousand_separator'] ?? ','  }}";

    var __default_datatable_page_entries = "{{ $default_datatable_page_entries }}";

    var __new_notification_count_interval = "{{ config('constants.new_notification_count_interval', 60) }}000";
</script>

<script src="{{ asset('js/functions.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/common.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/app.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/help-tour.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/documents_and_note.js?v=' . $asset_v) }}"></script>

@if (!empty($__system_settings['additional_js']))
    {!! $__system_settings['additional_js'] !!}
@endif
@yield('javascript')

@if (Module::has('Essentials'))
    @includeIf('essentials::layouts.partials.footer_part')
@endif

<script type="text/javascript">
    $(document).ready(function() {
        var locale = "{{ session()->get('user.language', config('app.locale')) }}";
        var isRTL =
            @if (in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')))
                true;
            @else
                false;
            @endif

        $('#calendar').fullCalendar('option', {
            locale: locale,
            isRTL: isRTL
        });
        // side bar toggle  
        $(".drop_down").click(function(event) {
            event.preventDefault();
            var $chiled = $(this).next(".chiled");
            var svgElement = $(this).find(".svg");
            $(".chiled").not($chiled).slideUp();
            $chiled.slideToggle(function() {
                $(".svg").each(function() {
                    var $currentSvgElement = $(this);
                    if ($currentSvgElement.closest(".drop_down").next(".chiled").is(
                            ":visible")) {
                        // If the corresponding menu is visible, set the arrow pointing upwards
                        $currentSvgElement.html(
                            '<path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M6 9l6 6l6 -6" />'
                        );
                    } else {
                        // Otherwise, set the arrow pointing downwards
                        $currentSvgElement.html(
                            '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" />'
                        );
                    }
                });
            });
        });

        $('.small-view-button').on('click', function() {
            $('.side-bar').addClass('small-view-side-active');
            $('.overlay').fadeIn('slow');
        });

        $('.overlay').on('click', function() {
            $('.overlay').fadeOut('slow');
            $('.side-bar').removeClass('small-view-side-active');
        });

        $(window).on('resize', function() {
            if ($(window).width() >= 992) {
                $('.overlay').fadeOut('slow');
                $('.side-bar').removeClass('small-view-side-active');
            }

            if($('.side-bar').hasClass('small-view-side-active')){
                $('.overlay').fadeIn('slow');
            }
        });

        $(document).on('click', function (e) {
            $('[data-toggle="popover"]').popover();

            $(document).on('click', function (e) {
                $('[data-toggle="popover"]').each(function () {
                    // Check if the clicked element is the popover button or inside the popover
                    if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                        $(this).popover('hide');
                    }
                });
            });
            
        });

        $('.side-bar-collapse').click(function() {
            $('.side-bar').toggle('slow');
        });

		// Format quantity
		$(document).on('blur', 'input#alert_quantity', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.quantity', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.product_quantity', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.pos_quantity', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.purchase_quantity', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.return_qty', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});

		// Format price
		$(document).on('blur', 'input#single_dpp', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.variable_dpp', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.variable_dpp_inc_tax', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#single_dsp', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.variable_dsp', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.purchase_unit_cost_without_discount', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.purchase_unit_cost', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.purchase_unit_cost_after_tax', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.default_sell_price', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.pos_unit_price', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.pos_line_total', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.payment-amount', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.payment_amount', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#shipping_charges', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#shipping_charges_modal', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input.product_unit_price', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#total_amount_recovered', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#final_total', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#expense_final_total', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#amount', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#opening_balance', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
		$(document).on('blur', 'input#credit_limit', function() {
			var number_f = __read_number($(this));
			__write_number($(this), number_f);
		});
    });
</script>


