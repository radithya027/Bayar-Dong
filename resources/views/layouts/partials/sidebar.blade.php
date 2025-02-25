<!-- Left side column. contains the logo and sidebar -->
<aside class="side-bar tw-relative tw-hidden tw-h-full tw-bg-white tw-w-64 xl:tw-w-64 lg:tw-flex lg:tw-flex-col tw-shrink-0 no-print tw-border-r tw-border-gray-300 [&::-webkit-scrollbar]:tw-w-2 [&::-webkit-scrollbar-track]:tw-bg-gray-100 [&::-webkit-scrollbar-thumb]:tw-bg-gray-300 [&::-webkit-scrollbar-thumb]:tw-rounded-full hover:[&::-webkit-scrollbar-thumb]:tw-bg-gray-400 tw-transition-all">

    <!-- Logo/Business Name Section with adjusted styling -->
    <div class="tw-transition-all tw-duration-5000 tw-border-b tw-shrink-0 lg:tw-h-15 no-print tw-flex tw-items-center tw-justify-center"
        style="background-color: #1E2B32; border-color: rgba(30, 43, 50, 0.3);">
        <a href="#" class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-w-full tw-h-full tw-px-6 tw-py-4" data-modal-target="logoModal">
            <div class="tw-flex tw-flex-col tw-items-center tw-text-lg tw-font-medium tw-text-white side-bar-heading tw-text-center tw-break-words tw-whitespace-normal tw-max-w-full">
                {{ Session::get('business.name') }}   
            </div>
        </a>
        
        <!-- Logo directly shown on mobile -->
        <div class="logo-mobile tw-block lg:tw-hidden">
            @if(!empty(Session::get('business.logo')))
                <img src="{{ asset('/uploads/business_logos/'.Session::get('business.logo')) }}" 
                    alt="{{ Session::get('business.name') }}" 
                    class="tw-max-w-[160px] tw-h-auto tw-max-h-20 tw-object-contain tw-rounded-lg tw-border tw-border-gray-400 tw-shadow-md">
            @else
                <div class="tw-text-xl tw-font-semibold tw-text-black tw-bg-gray-100 tw-rounded-lg tw-px-4 tw-py-2 tw-break-words tw-whitespace-normal">{{ Session::get('business.name') }}</div>
            @endif
        </div>
    </div>

    <!-- Sidebar Menu with Custom Scrollbar and adjusted padding -->
    <div class="tw-flex-1 tw-overflow-y-auto [&::-webkit-scrollbar]:tw-w-1.5 [&::-webkit-scrollbar-track]:tw-bg-transparent [&::-webkit-scrollbar-thumb]:tw-bg-gray-200 [&::-webkit-scrollbar-thumb]:tw-rounded-full hover:[&::-webkit-scrollbar-thumb]:tw-bg-gray-300 tw-transition-all tw-pt-2">
        {!! Menu::render('admin-sidebar-menu', 'adminltecustom') !!}
    </div>
</aside>

<!-- Modal -->
<div id="logoModal" class="tw-fixed tw-top-0 tw-left-0 tw-bg-black/50 tw-hidden tw-z-50 tw-opacity-0 tw-transform tw-translate-y-[-20px] tw-transition-all tw-duration-500">
    <div class="tw-bg-white tw-rounded-lg tw-shadow-lg tw-relative tw-p-4 tw-border tw-border-gray-300">
        <button class="tw-absolute tw-top-2 tw-right-2 tw-text-gray-500 hover:tw-text-gray-700 tw-text-2xl" onclick="closeModal('logoModal')">&times;</button>
        <div class="tw-p-4 tw-border tw-border-gray-300 tw-rounded-lg">
            @if(!empty(Session::get('business.logo')))
                <img src="{{ asset('/uploads/business_logos/'.Session::get('business.logo')) }}" 
                    alt="{{ Session::get('business.name') }}" 
                    class="tw-max-w-[160px] tw-h-auto tw-max-h-20 tw-object-contain tw-rounded-lg tw-border tw-border-gray-400 tw-shadow-md">
            @else
                <div class="tw-text-xl tw-font-semibold tw-text-black tw-bg-gray-100 tw-rounded-lg tw-px-4 tw-py-2 tw-break-words tw-whitespace-normal">{{ Session::get('business.name') }}</div>
            @endif
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('[data-modal-target]').forEach(el => {
        el.addEventListener('click', function () {
            const modal = document.getElementById(this.dataset.modalTarget);
            modal.classList.remove('tw-hidden');
            modal.classList.add('tw-opacity-100', 'tw-translate-y-0');
        });
    });

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('tw-opacity-100', 'tw-translate-y-0'); 
        modal.classList.add('tw-opacity-0', 'tw-translate-y-[-20px]'); 

        setTimeout(() => {
            modal.classList.add('tw-hidden');
        }, 500); 
    }
</script>

<style>
@media (max-width: 768px) {
        .logo-mobile {
            display: block;
        }
        
        [data-modal-target] {
            display: none;
        }
    }

    @media (min-width: 769px) {
        .logo-mobile {
            display: none;
        }
    }
    

    .side-bar {
        scrollbar-width: thin;
        scrollbar-color: #E5E7EB transparent;
    }
    
    .side-bar:hover {
        scrollbar-color: #D1D5DB transparent;
    }
    
    .side-bar::-webkit-scrollbar {
        width: 0;
    }
    
    .side-bar:hover::-webkit-scrollbar {
        width: 6px;
    }
    
    #side-bar::-webkit-scrollbar {
        width: 4px;
    }
    
    #side-bar::-webkit-scrollbar-track {
        background: transparent;
    }
    
    #side-bar::-webkit-scrollbar-thumb {
        background-color: #E5E7EB;
        border-radius: 20px;
        border: transparent;
    }
    
    #side-bar:hover::-webkit-scrollbar-thumb {
        background-color: #D1D5DB;
    }
</style>