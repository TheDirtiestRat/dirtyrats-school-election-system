@if ($voter == null || empty($voter))
    {{-- No Voter with that ID exist. --}}

    <div id="liveToast" class="toast text-bg-warning" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Warning!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            No Voter with that ID exist.
        </div>
    </div>
@else
    {{-- show if the voter is signed or not --}}
    @if ($is_signed == true && $is_voted == false)
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small>{{ date('h:i:s') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Voter {{ $voter->voter_id }} <strong>{{ $voter->first_name }} {{ $voter->mid_name }}
                    {{ $voter->last_name }}</strong> is already signed in!
            </div>
        </div>
    @elseif ($is_signed == true && $is_voted == true)
        <div id="liveToast" class="toast text-bg-info" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Sign-out Voter</strong>
                <small>{{ date('h:i:s') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Voter {{ $voter->voter_id }} <strong>{{ $voter->first_name }} {{ $voter->mid_name }}
                    {{ $voter->last_name }}</strong> has voted and scanning out!
            </div>
        </div>
    @else
        <div id="liveToast" class="toast text-bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Signed Voter</strong>
                <small>{{ date('h:i:s') }}</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Voter {{ $voter->voter_id }} <strong>{{ $voter->first_name }} {{ $voter->mid_name }}
                    {{ $voter->last_name }}</strong> is scanned in and can vote!
            </div>
        </div>
    @endif

@endif
