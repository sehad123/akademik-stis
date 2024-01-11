@foreach ($getChatUser as $user)
{{-- <a href="{{ url('chat?receiver_id='.base64_encode($user['user_id'])) }}">
</a> --}}
<li class="clearfix getChatWindows @if(!empty($receiver_id)) @if($receiver_id == $user['user_id']) active  @endif @endif " id="{{ $user['user_id'] }}">
    <img src="{{ $user['profile_pic'] }}" alt="avatar">
        <div class="about">
            <div class="name">{{ $user['name'] }} @if (!empty($user['messagecount']))
                <span id="ClearMessage{{ $user['user_id'] }}" style="background: red;color:#fff; border-radius:25px; padding:1px 7px;"> {{ $user['messagecount'] }}</span></div>
            @endif
            <div class="status"> <i class="fa fa-circle offline"></i> 
                Last seen {{ Carbon\Carbon::parse($user['created_date'])->diffForHumans() }}
            
            </div>                                            
        </div>
</li>
@endforeach
