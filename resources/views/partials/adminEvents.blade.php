<div class="row mt-3">
          <div class="col-12 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Search Events">
              <span class="input-group-append">
                <button type="button" class="btn btn-secondary">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </span>
            </div>
          </div>
        </div>

        <table class="table table-hover">
          <thead>
            <tr class="d-flex">
              <th class="col-5">Name</th>
              <th class="col-6">Owner</th>
              <th class="col-1">Delete</th>
            </tr>
          </thead>
          <tbody>
          @foreach($events as $event)
            <tr class="d-flex">
              <td class="col-5">
                <a href="./event.html" class="text-white">{{ $event->name }}</a>
              </td>
              <td class="col-6">
                <a href="./tiagoc.html" class="text-white">{{ $event->owner->username }}</a>
              </td>
              <td class="col-1">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Delete Event">
                  <i class="fas fa-trash-alt fa-fw"></i>
                </button>
              </td>
            </tr>
            @endforeach
           
          </tbody>
        </table>