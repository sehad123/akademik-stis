
<div class="chat-header clearfix">
    @include('chat._header')
   
</div>
<div class="chat-history">
  @include('chat._chat')
</div>
<div class="chat-message clearfix">
    <form action="" class="mb-0" id="submit_message" method="post">
        <input type="hidden" value="{{ $getReceiver->id }}" name="receiver_id">
        {{ csrf_field() }}
    <div class="mb-0">
        <div style="display: block">
            <textarea name="message" class="form-control" id="clearMessage"></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 hidden-sm text-right">
                <div class="col-lg-6 hidden-sm text-left mt-2">
                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                </div>
            </div>
            <div class="col-md-6" style="text-align: right">
                <button style="margin-top: 10px;" class="btn btn-primary" type="submit" >send</button>
            </div>
        </div>
       </div>
    </form>
</div>