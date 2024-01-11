@foreach ($getChat as $value)
@if ($value->sender_id == Auth::user()->id)
    
<li class="clearfix">
<div class="message-data text-right">
    <span class="message-data-time">
        {{-- Last seen {{ Carbon\Carbon::parse($value->created_date)->diffForHumans() }} --}}
        {{ date('h:i A',strtotime($value->created_at)) }}
    </span>
    <img src="{{ $value->getSender->getProfileDirect() }}" alt="avatar">
</div>
<div class="message other-message float-right"> {!! $value->message !!}
    @if (!empty($value->getFile()))
    <div>
        <a href="{{ $value->getFile() }}" download="" target="_blank"><i class="fa fa-download"></i></a>
    </div>
    @endif
</div>
</li>
@else
<li class="clearfix">
<div class="message-data">
    <img src="{{ $value->getSender->getProfileDirect() }}" alt="avatar">
    <span class="message-data-time">
        {{-- Last seen {{ Carbon\Carbon::parse($value->created_at)->diffForHumans() }} --}}
        {{ date('h:i A',strtotime($value->created_at)) }}
    </span>
</div>
<div class="message my-message">{!! $value->message !!}
    @if (!empty($value->getFile()))
    <div>
        <a href="{{ $value->getFile() }}" download="" target="_blank"><i class="fa fa-download"></i></a>
    </div>
    @endif
</div>
</li>
@endif

@endforeach
