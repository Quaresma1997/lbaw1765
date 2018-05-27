<div class="modal fade" id="joinEvent{{$event_invite->id}}">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Join Event</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <a href="{{ url('events/' . $event_invite->event_id)}}" class="text-white">
            <img src="{{url('/imgs/' . $event_invite->event->images->last()->path)}}" class="img-fluid rounded mx-auto d-block">
          </a>
          <br>
          <br>
          <h3 class="text-center">
            <a href="{{ url('profile/' . $event_invite->sender_id)}}" class="text-white">{{$event_invite->sender->username}}</a> invited you to
            <a href="{{ url('events/' . $event_invite->event_id)}}" class="text-white">{{$event_invite->event->name}}</a>.</h3>
          <br>
          <button type="button" class="btn btn-success btn-lg btn-block" id="btn_acceptEventInvite" event-id="{{$event_invite->event->id}}" receiver-id="{{$event_invite->receiver->id}}">
            <i class="fas fa-check fa-fw"></i> Accept </button>
          <button type="button" class="btn btn-outline-danger btn-lg btn-block" id="btn_declineEventInvite" event-id="{{$event_invite->event->id}}" receiver-id="{{$event_invite->receiver->id}}">
            <i class="fas fa-times fa-fw"></i> Decline </button>
        </div>
      </div>
    </div>
  </div>