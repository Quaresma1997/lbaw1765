<div class="modal fade" id="addFriend{{$friend_request->id}}">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Friend</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <a href="{{ url('profile/' . $friend_request->sender_id)}}" class="text-white">
          <img src="/imgs/{{ $friend_request->sender->image_path }}" class="rounded mx-auto d-block userProfileImg" alt="User image">
        </a>
        <br>
        <br>
        <h3 class="text-center">
          <a href="{{ url('profile/' . $friend_request->sender_id)}}" class="text-white">{{$friend_request->sender->username}}</a> wants to be your friend.</h3>
          <br>
          <button type="button" class="btn btn-success btn-lg btn-block" id="btn_acceptFriend" data-sender-id="{{$friend_request->sender->id}}" data-receiver-id="{{$friend_request->receiver->id}}">
            <i class="fas fa-check fa-fw"></i> Accept </button>
            <button type="button" class="btn btn-outline-danger btn-lg btn-block" id="btn_declineFriend" data-sender-id="{{$friend_request->sender->id}}" data-receiver-id="{{$friend_request->receiver->id}}">
              <i class="fas fa-times fa-fw"></i> Decline </button>
            </div>
          </div>
        </div>
      </div>