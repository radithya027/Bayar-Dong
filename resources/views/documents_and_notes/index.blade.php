<div class="table-responsive">
    @if(in_array('create', $permissions))
        <div class="pull-right">
            <button type="button" class="tw-dw-btn tw-bg-gradient-to-r tw-from-indigo-600 tw-to-blue-500 tw-font-bold tw-text-white tw-border-none tw-rounded-full docs_and_notes_btn pull-right" data-href="{{action([\App\Http\Controllers\DocumentAndNoteController::class, 'create'], ['notable_id' => $notable_id, 'notable_type' => $notable_type])}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg> @lang('messages.add')
            </button>
        </div> <br><br><br>
    @endif
    <table class="table table-bordered table-striped" style="width: 100%;" id="documents_and_notes_table">
        <thead>
            <tr>
                <th>@lang('messages.action')</th>
                <th>@lang('lang_v1.heading')</th>
                <th>@lang('lang_v1.added_by')</th>
                <th>@lang('lang_v1.created_at')</th>
                <th>@lang('lang_v1.updated_at')</th>
            </tr>
        </thead>
    </table>
</div>
<div class="modal fade docus_note_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>