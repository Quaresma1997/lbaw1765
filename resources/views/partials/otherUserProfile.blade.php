@if(Auth::user()->sentFriendRequestTo($user->id))
<button type="button" class="btn btn-success btn-lg btn-block mt-3" id="btn_addFriend" data-sender-id="{{ Auth::user()->id }}" data-receiver-id="{{ $user->id }}" disabled>
    <i class="fas fa-check fa-fw"></i> Friend request sent </button>
@elseif(Auth::user()->receivedFriendRequestFrom($user->id))
<button type="button" class="btn btn-success btn-lg btn-block" name="btn_acceptFriend" data-sender-id="{{$user->id}}" data-receiver-id="{{Auth::user()->id}}">
    <i class="fas fa-check fa-fw"></i> Accept </button>
<button type="button" class="btn btn-outline-danger btn-lg btn-block" name="btn_declineFriend" data-sender-id="{{$user->id}}" data-receiver-id="{{Auth::user()->id}}">
    <i class="fas fa-times fa-fw"></i> Decline </button>
@else
<button type="button" class="btn btn-success btn-lg btn-block mt-3" id="btn_addFriend" data-sender-id="{{ Auth::user()->id }}" data-receiver-id="{{ $user->id }}">
    <i class="fas fa-check fa-fw"></i> Add Friend </button>
@endif