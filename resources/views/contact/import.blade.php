@extends('layouts.app')
@section('title', __('lang_v1.import_contacts'))

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    .modern-content-header {
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    .modern-widget {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        padding: 20px;
        margin-bottom: 24px;
    }
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden;
    }
    .modern-table th {
        background-color: #f8fafc;
        padding: 12px 16px;
        font-weight: 600;
    }
    .modern-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    .modern-btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .alert-modern {
        border-radius: 8px;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .form-control {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        padding: 8px 12px;
        font-family: 'Poppins', sans-serif;
    }
    .form-group label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #1e293b;
    }
</style>

<!-- Content Header -->
<section class="modern-content-header">
    <h1 class="tw-text-xl md:tw-text-3xl tw-font-bold tw-text-black" style="font-family: 'Poppins', sans-serif;">
        @lang('lang_v1.import_contacts')
    </h1>
</section>

<!-- Main content -->
<section class="content" style="font-family: 'Poppins', sans-serif;">
    
    @if (session('notification') || !empty($notification))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible alert-modern">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    @if(!empty($notification['msg']))
                        {{$notification['msg']}}
                    @elseif(session('notification.msg'))
                        {{ session('notification.msg') }}
                    @endif
                </div>
            </div>  
        </div>     
    @endif
    
    <div class="row">
        <div class="col-sm-12">
            @component('components.widget', ['class' => 'modern-widget'])
                {!! Form::open(['url' => action([\App\Http\Controllers\ContactController::class, 'postImportContacts']), 'method' => 'post', 'enctype' => 'multipart/form-data' ]) !!}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    {!! Form::label('name', __( 'product.file_to_import' ) . ':', ['style' => 'font-family: Poppins, sans-serif; font-weight: 500;']) !!}
                                    {!! Form::file('contacts_csv', ['accept'=> '.xls', 'required' => 'required', 'class' => 'form-control']); !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <br>
                                <button type="submit" class="modern-btn tw-dw-btn tw-dw-btn-primary tw-text-white">
                                    @lang('messages.submit')
                                </button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <a href="{{ asset('files/import_contacts_csv_template.xls') }}" class="modern-btn tw-dw-btn tw-dw-btn-success tw-text-white">
                            <i class="fa fa-download"></i> @lang('lang_v1.download_template_file')
                        </a>
                    </div>
                </div>
            @endcomponent
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            @component('components.widget', ['class' => 'modern-widget', 'title' => __('lang_v1.instructions')])
                <strong>@lang('lang_v1.instruction_line1')</strong><br>
                @lang('lang_v1.instruction_line2')
                <br><br>
                <div class="table-responsive">
                    <table class="table modern-table">
                        <thead>
                            <tr>
                                <th>@lang('lang_v1.col_no')</th>
                                <th>@lang('lang_v1.col_name')</th>
                                <th>@lang('lang_v1.instruction')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>@lang('contact.contact_type') <small class="text-muted">(@lang('lang_v1.required'))</small></td>
                                <td>{!! __('lang_v1.import_contact_type_ins') !!}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>@lang('business.prefix') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>@lang('business.first_name') <small class="text-muted">(@lang('lang_v1.required'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>@lang('lang_v1.middle_name') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>@lang('business.last_name') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>@lang('business.business_name') <br><small class="text-muted">(@lang('lang_v1.required_if_supplier'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>@lang('lang_v1.contact_id') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>@lang('lang_v1.contact_id_ins')</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>@lang('contact.tax_no') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>@lang('lang_v1.opening_balance') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>@lang('contact.pay_term') <br><small class="text-muted">(@lang('lang_v1.required_if_supplier'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>@lang('contact.pay_term_period') <br><small class="text-muted">(@lang('lang_v1.required_if_supplier'))</small></td>
                                <td><strong>@lang('lang_v1.pay_term_period_ins')</strong></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>@lang('lang_v1.credit_limit') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>@lang('business.email') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td>@lang('contact.mobile') <small class="text-muted">(@lang('lang_v1.required'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td>@lang('contact.alternate_contact_number') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td>@lang('contact.landline') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>17</td>
                                <td>@lang('business.city') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>18</td>
                                <td>@lang('business.state') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td>@lang('business.country') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>20</td>
                                <td>@lang('lang_v1.address_line_1') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>21</td>
                                <td>@lang('lang_v1.address_line_2') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>22</td>
                                <td>@lang('business.zip_code') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>23</td>
                                <td>@lang('lang_v1.dob') <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>@lang('lang_v1.dob_ins') ({{\Carbon::now()->format('Y-m-d')}})</td>
                            </tr>
                            @php
                                $custom_labels = json_decode(session('business.custom_labels'), true);
                            @endphp
                            <tr>
                                <td>24</td>
                                <td>{{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }} <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>25</td>
                                <td>{{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }} <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>26</td>
                                <td>{{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }} <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>27</td>
                                <td>{{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }} <small class="text-muted">(@lang('lang_v1.optional'))</small></td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endcomponent
        </div>
    </div>
</section>
@endsection