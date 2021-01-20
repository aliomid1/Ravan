<div class="chat-body-header">
    <a href="#" class="btn btn-dark opacity-3 m-l-10 btn-chat-sidebar-open">
        <i class="ti-menu"></i>
    </a>
    <div>
        <h6 class="m-b-0 primary-font">{{ $support->title }}</h6>
    </div>

</div>
<div class="chat-body-messages" >
    <div class="message-items">
        @forelse ($messages as $message)
        @if ($message->user_id=='Admin')
        <div class="message-item outgoing-message">{{ $message->message }}
            <small
                class="message-item-date text-muted">{{ \Carbon\Carbon::parse($message->created_at)->format('h:i') }}</small>
        </div>
        @else
        <div class="message-item">{{ $message->message }}
            <small
                class="message-item-date text-muted">{{ \Carbon\Carbon::parse($message->created_at)->format('h:i') }}</small>
        </div>
        @endif

        @empty
        @endforelse
    </div>
</div>
<div class="chat-body-footer">
    <form class="d-flex align-items-center ">
        <input type="text" class="form-control text-messagesuppo" name="text" placeholder="پیام ...">
        <div class="d-flex">
            <a  class="mr-3 btn btn-primary btn-floating " id="sendmessageg"  data-id="{{ $support->id }}" data-url="{{route('SendMessageSupport')}}">
                <i class="fa fa-send text-white"></i>
            </a>

        </div>
    </form>
</div>
