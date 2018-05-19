<div class="col-12 col-lg-6 px-1">
                    <div class="jumbotron jumbotron-fluid p-1 my-1 list">
                      <a href="{{ url('profile/' . $friend->id)}}" class="text-white">
                      <div class="row">
                        <div class="col-12 col-sm-4 col-lg-12 col-xl-4">
                          <img class="img-fluid rounded" src="/imgs/{{ $friend->image_path }}">
                        </div>
                        <div class="col-12 col-sm-8 col-lg-12 col-xl-8">
                          <div>
                            <h3 class="my-4">{{$friend->username}}</h3>
                          </div>
                        </div>
                      </div>
                      </a>
                    </div>
                  </div>