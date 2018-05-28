<div class="row mt-3">
  <div class="col-12 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4" id="search_admin_events">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Search Events" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;" >
      <span class="input-group-append">
        <button type="button" class="btn btn-secondary">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </span>
    </div>
  </div>
</div>
<div class="row">
  <table class="table table-hover">
    <thead>
      <tr class="d-flex">
        <th class="col-5">Name</th>
        <th class="col-sm-5 col-xs-4">Owner</th>
        <th class="col-sm-2 col-xs-3" style="text-align: center;">Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach($events as $event)
      <tr class="d-flex">
        <td class="col-5">
          <a href="/events/{{$event->id}}" class="text-white" event_id="{{ $event->id }}"><span id="span_event_name">{{ $event->name }}</span></a>
        </td>
        <td class="col-sm-5 col-xs-4">
          <a href="/profile/{{$event->owner->id}}" class="text-white">{{ $event->owner->username }}</a>
        </td>
        <td class="col-sm-2 col-xs-3" style="text-align: center">
          <button type="button" id="btn_remEvent" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Delete Event">
            <i class="fas fa-trash-alt fa-fw"></i>
          </button>
        </td>
      </tr>
      @endforeach
      
    </tbody>
  </table>
</div>