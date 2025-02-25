<style>
    .package-card {
        height: 500px;
        position: relative;
        margin-bottom: 20px;
        background: #fff;
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .package-card .card-header {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #0040C1;
        border-radius: 6px 6px 0 0;
        padding: 10px;  
    }
    .package-card .card-header h2 {
        color: #fff;
        margin: 0;
        font-size: 20px;
    }
    .package-card .price-section {
        padding: 15px;
        text-align: center;
        background: #fff;
    }
    .package-card .price-amount {
        font-size: 24px;
        font-weight: bold;
        color: #2c3e50;
    }
    .package-card .price-period {
        font-size: 13px;
        color: #7f8c8d;
        margin-bottom: 10px;
    }
    .package-card .features-container {
        height: 240px;
        padding: 0 15px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #0040C1 #f0f0f0;
    }
    /* Webkit scrollbar styling */
    .package-card .features-container::-webkit-scrollbar {
        width: 8px;
    }
    .package-card .features-container::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 4px;
    }
    .package-card .features-container::-webkit-scrollbar-thumb {
        background: #0040C1;
        border-radius: 4px;
    }
    .package-card .features-container::-webkit-scrollbar-thumb:hover {
        background: #0040C1;
    }
    .package-card .feature-item {
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        font-size: 14px;
    }
    .package-card .feature-icon {
        color: #0040C1; /* Updated color to #0040C1 */
        margin-right: 8px;
        font-size: 14px;
    }
    .package-card .card-footer {
        height: 80px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 0 0 6px 6px;
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    .package-card .btn-subscribe {
        width: 100%;
        padding: 10px;
        background: #0040C1; /* Updated color */
        border: none;
        color: white;
        border-radius: 4px;
        font-size: 14px;
        transition: background 0.2s;
        display: inline-block;
        text-decoration: none;
        text-align: center;
    }
    
    .package-card .btn-subscribe:hover {
        background: #0036A0; /* Slightly darker blue for hover effect */
    }
    
    </style>
    
    @foreach ($packages as $package)
        @if($package->is_private == 1 && !auth()->user()->can('superadmin'))
            @php continue; @endphp
        @endif
        <div class="col-md-4">
            <div class="package-card">
                <div class="card-header">
                    <h2>{{$package->name}}</h2>
                </div>
                <div class="price-section">
                    @php
                        $interval_type = !empty($intervals[$package->interval]) ? $intervals[$package->interval] : __('lang_v1.' . $package->interval);
                    @endphp
                    <div class="price-amount">
                        @if($package->price != 0)
                            <span class="display_currency" data-currency_symbol="true">{{$package->price}}</span>
                        @else
                            Free
                        @endif
                    </div>
                    <div class="price-period">
                        @if($package->price != 0)
                            {{$package->interval_count}} {{$interval_type}}
                        @else
                            @lang('superadmin::lang.free_for_duration', ['duration' => $package->interval_count . ' ' . $interval_type])
                        @endif
                    </div>
                </div>
                <div class="features-container">
                    <div class="feature-item">
                        <i class="fa fa-check feature-icon"></i>
                        <span>
                            @if($package->location_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{$package->location_count}}
                            @endif
                            @lang('business.business_locations')
                        </span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check feature-icon"></i>
                        <span>
                            @if($package->user_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{$package->user_count}}
                            @endif
                            @lang('superadmin::lang.users')
                        </span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check feature-icon"></i>
                        <span>
                            @if($package->product_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{$package->product_count}}
                            @endif
                            @lang('superadmin::lang.products')
                        </span>
                    </div>
                    <div class="feature-item">
                        <i class="fa fa-check feature-icon"></i>
                        <span>
                            @if($package->invoice_count == 0)
                                @lang('superadmin::lang.unlimited')
                            @else
                                {{$package->invoice_count}}
                            @endif
                            @lang('superadmin::lang.invoices')
                        </span>
                    </div>
                    @if(!empty($package->custom_permissions))
                        @foreach($package->custom_permissions as $permission => $value)
                            @isset($permission_formatted[$permission])
                                <div class="feature-item">
                                    <i class="fa fa-check feature-icon"></i>
                                    <span>{{$permission_formatted[$permission]}}</span>
                                </div>
                            @endisset
                        @endforeach
                    @endif
                    @if($package->trial_days != 0)
                        <div class="feature-item">
                            <i class="fa fa-check feature-icon"></i>
                            <span>{{$package->trial_days}} @lang('superadmin::lang.trial_days')</span>
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    @if($package->enable_custom_link == 1)
                        <a href="{{$package->custom_link}}" class="btn-subscribe">
                            {{$package->custom_link_text}}
                        </a>
                    @else
                        @if(isset($action_type) && $action_type == 'register')
                            <a href="{{ route('business.getRegister') }}?package={{$package->id}}" class="btn-subscribe">
                                @if($package->price != 0)
                                    @lang('superadmin::lang.register_subscribe')
                                @else
                                    @lang('superadmin::lang.register_free')
                                @endif
                            </a>
                        @else
                            @if($package->price != 0)
                                <button class="btn-subscribe pay-with-midtrans" 
                                    data-package-id="{{ $package->id }}" 
                                    data-business-id="{{ auth()->user()->business_id }}">
                                    @lang('superadmin::lang.pay_and_subscribe')
                                </button>
                            @else
                                <a href="{{action([\Modules\Superadmin\Http\Controllers\SubscriptionController::class, 'pay'], [$package->id])}}" class="btn-subscribe">
                                    @lang('superadmin::lang.subscribe')
                                </a>
                            @endif
                        @endif
                    @endif
                </div>
                
            </div>
        </div>
        @if($loop->iteration%3 == 0)
            <div class="clearfix"></div>
        @endif
    @endforeach