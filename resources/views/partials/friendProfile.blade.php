<button type="button" class="btn btn-success btn-lg btn-block mt-3" disabled>
              <i class="fas fa-check fa-fw"></i> Friend </button>
            <button type="button" class="btn btn-outline-danger btn-lg btn-block" id="btn_removeFriend" user-id-1="{{ Auth::user()->id }}" user-id-2="{{ $user->id }}">
              <i class="fas fa-trash-alt fa-fw"></i> Remove Friend </button>