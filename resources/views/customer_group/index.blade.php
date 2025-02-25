@extends('layouts.app')
@section('title', __('lang_v1.customer_groups'))

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body, h1, h2, h3, h4, h5, h6, p, span, div, table, th, td {
        font-family: 'Poppins', sans-serif !important;
    }
</style>

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black">@lang('lang_v1.customer_groups')</h1>
        <!-- <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        @component('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.all_your_customer_groups')])
        @can('customer.create')
        @slot('tool')
            <div class="box-tools" style="font-family: 'Poppins', sans-serif;">
                <a class="tw-dw-btn tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full pull-right hover:no-underline hover:tw-text-white" 
                    style="background-color: #1E2B32"
                    data-href="{{ action([\App\Http\Controllers\CustomerGroupController::class, 'create']) }}"
                    data-container=".customer_groups_modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg> <span style="font-family: 'Poppins', sans-serif;">@lang('messages.add')</span>
                </a>
            </div>
        @endslot
    @endcan
    @can('customer.view')
            <div class="table-responsive" style="font-family: 'Poppins', sans-serif;">
                <table class="table table-bordered table-striped" id="customer_groups_table" style="font-family: 'Poppins', sans-serif;">
                    <thead>
                        <tr style="font-family: 'Poppins', sans-serif;">
                            <th style="font-family: 'Poppins', sans-serif;">@lang('lang_v1.customer_group_name')</th>
                            <th style="font-family: 'Poppins', sans-serif;">@lang('lang_v1.calculation_percentage')</th>
                            <th style="font-family: 'Poppins', sans-serif;">@lang('lang_v1.selling_price_group')</th>
                            <th style="font-family: 'Poppins', sans-serif;">@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcan
        @endcomponent

        <div class="modal fade customer_groups_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        </div>

    </section>
    <!-- /.content -->
@stop
@section('javascript') 

    <script type="text/javascript">
        $(document).on('change', '#price_calculation_type', function() {
            var price_calculation_type = $(this).val();

            if (price_calculation_type == 'percentage') {
                $('.percentage-field').removeClass('hide');
                $('.selling_price_group-field').addClass('hide');
            } else {
                $('.percentage-field').addClass('hide');
                $('.selling_price_group-field').removeClass('hide');
            }
        })
    </script>
@endsection
