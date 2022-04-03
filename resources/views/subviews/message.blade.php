@if(!empty($message))
    <div class="alert alert-{{ $message['alert'] }}">{{ $message['message'] }}</div>
@endif