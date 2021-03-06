<div class="row mt-3">
  <div class="col-12 col-sm-6 offset-sm-3 col-lg-4 offset-lg-4" id="search_admin_users">
    
  
    <div class="form-group">
    <form action ="{{route('proc')}}" method="get" class="form-inline">
        <div class="input-group">
          <input type="text" class="form-control" name="query" placeholder="Search Users" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;">

          <span class="input-group-append"> 
            <button type="submit" class="btn btn-secondary" >
              <i class="fas fa-search fa-fw"></i>
            </button>
          </span>
        </div>
    </form>
    </div>
  </div>
</div>
<div class="row">
  <table class="table table-hover">
    <thead>
      <tr class="d-flex">
        <th class="col-4">Username</th>
        <th class="col-sm-6 col-5">Email</th>
        <th class="col-sm-2 col-3" style="text-align: center;">Ban</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr class="d-flex">
        <td class="col-4"><a href="/profile/{{$user->id}}" class="text-white" data-name="a_username">{{ $user->username }}</a></td>
        <td class="col-sm-6 col-5">{{ $user->email }}</td>
        <td class="col-sm-2 col-3" style="text-align: center">
          <button type="button" name="btn_banUser" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="left" title="Ban User">
            <i class="fas fa-ban fa-fw"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>