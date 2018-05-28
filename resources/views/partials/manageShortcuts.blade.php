<div class="modal fade" id="manageShortcuts">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="manageShortcutsModal">Manage Shortcuts</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="jumbotron p-1 mb-1 mt-1">
          <div class="row" id="list_shortcuts">
            
           
            @foreach(Auth::user()->shortcuts as $shortcut)
            <div class="col-12 col-lg-6 mb-4">
              <div class="row">
                <div class="col-md-6 col-6">
                  <a href="{{ url('events/' . $shortcut->event->id)}}" class="text-white">
                    <span>{{$shortcut->event->name}}</span>
                  </a>
                </div>
                
                <div class="col-md-6 col-6 d-flex align-items-center">
                  <button type="button" class="btn btn-outline-danger btn-sm" title="Delete Shortcut" id="btn_deleteShortcut"
                  shortcut-id="{{$shortcut->id}}">
                  <i class="fas fa-times" ></i><span> Delete</span>
                </button>
              </div>
            </div>
          </div>
          @endforeach
          </div>
          <div class="row">
            <div class="col-md-6 col-6">
              <div class="form-group mb-2 p-0 m-0" id="div_select_event">
                <select class="custom-select" id="eventsShortcuts" name="event" user-id="{{Auth::user()->id}}">
                 @foreach(Auth::user()->eventsNotShortcuts() as $event)
                 <option value="{{ $event->name }}" data-id="{{$event->id}}">{{ $event->name }}</option>
                 @endforeach
                
               </select>
              </div>
            </div>
            <div class="col-md-6 col-6">
              <button type="button" class="btn btn-success btn-md"  data-placement="left" title="Add shortcut" id="btn_addShortcut">
                <i class="fas fa-plus" ></i><span> Add shortcut</span>
              </div>
          </div>
          </div>
        </div>
      
    </div>
  </div>
</div>