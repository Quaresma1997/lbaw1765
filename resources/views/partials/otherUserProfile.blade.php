@if(Auth::user()->sentFriendRequestTo($user->id))
<button type="button" class="btn btn-success btn-lg btn-block mt-3" id="btn_addFriend" sender-id="{{ Auth::user()->id }}" receiver-id="{{ $user->id }}" disabled>
    <i class="fas fa-check fa-fw"></i> Friend request sent </button>
@elseif(Auth::user()->receivedFriendRequestFrom($user->id))
<button type="button" class="btn btn-success btn-lg btn-block" id="btn_acceptFriend" sender-id="{{$user->id}}" receiver-id="{{Auth::user()->id}}">
    <i class="fas fa-check fa-fw"></i> Accept </button>
<button type="button" class="btn btn-outline-danger btn-lg btn-block" id="btn_declineFriend" sender-id="{{$user->id}}" receiver-id="{{Auth::user()->id}}">
    <i class="fas fa-times fa-fw"></i> Decline </button>
@else
<button type="button" class="btn btn-success btn-lg btn-block mt-3" id="btn_addFriend" sender-id="{{ Auth::user()->id }}" receiver-id="{{ $user->id }}">
    <i class="fas fa-check fa-fw"></i> Add Friend </button>
@endif