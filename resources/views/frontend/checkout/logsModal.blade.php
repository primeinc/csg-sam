<!-- Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <h4 class="modal-title" id="dynModalLabel">Checkout Edit Logs</h4>
</div>
<div class="modal-body" style="background-color: #ecf0f5;">
        <ul class="timeline">
            @foreach($logs as $log )
            <li>
                <i class="fa fa-edit bg-red"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{ $log->created_at->diffForHumans() }}</span>
                    <h3 class="timeline-header">
                        <a href="{!! route('samples.out.rep', $log->user->id) !!}">{{ $log->user->name }}</a>
                            edited this checkout
                    </h3>
                        {{--{!! dd($log->context) !!}--}}
                        <div class="timeline-body"><p class="no-margin">
                            @if(!empty($log->context->old->user_id))
                                <p><code>Previous Rep</code> {{ $log->context->old->user->name }}&nbsp;
                                <code>New Rep</code> {{ $log->context->new->user->name }}&nbsp;</p>
                            @endif
                            @if(!empty($log->context->old->dealer_id))
                                <p><code>Previous Dealer</code> {{ $log->context->old->dealer->name }}&nbsp;
                                <code>New Dealer</code> {{ $log->context->new->dealer->name }}&nbsp;</p>
                            @endif
                            @if(!empty($log->context->old->expected_return_date))
                                <p><code>Previous Return Date</code> {{ $log->context->old->expected_return_date->toFormattedDateString() }}&nbsp;
                                <code>New Return Date</code> {{ $log->context->new->expected_return_date->toFormattedDateString() }}&nbsp;</>
                            @endif
                            @if(!empty($log->context->old->project))
                                <p><code>Previous Project</code> {{ $log->context->old->project }}&nbsp;
                                <code>New Project</code> {{ $log->context->old->project }}&nbsp;</p>
                            @endif
                            @if(isset($log->context->old->permanent))
                                <p><code>Previous Permanent Status</code> {{ $log->context->old->permanent ? 'on' : 'off' }}&nbsp;
                                <code>New Permanent Status</code> {{ $log->context->new->permanent ? 'on' : 'off' }}&nbsp;</p>
                            @endif
                        </div>
                </div>
            </li>
            @endforeach
            <li>
                <i class="fa fa-clock-o bg-gray"></i>
            </li>
        </ul>
</div>
