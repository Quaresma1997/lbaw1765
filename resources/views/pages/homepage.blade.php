@extends('layouts.app')

@section('navbar')
    @include('partials.navLoggedIn')
@endsection

@include('partials.addFriend');
@include('partials.joinEvent');
@include('partials.addEvent');

@section('content')
<div class="row">
      <div class="col-12 col-xl-3">
        <div class="container mx-auto sticky-top" >
          <div>
            <h2>Filter</h2>
            <div class="custom-control custom-radio mb-1">
              <input type="radio" id="all" name="customRadio" class="custom-control-input" checked="checked">
              <label class="custom-control-label" for="all">Show All</label>
            </div>
            <div class="custom-control custom-radio mb-1">
              <input type="radio" id="friend" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="friend">Friend Activity</label>
            </div>
            <div class="custom-control custom-radio mb-1">
              <input type="radio" id="recom" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="recom">Recommendations</label>
            </div>
          </div>
          <hr>
          <div>
            <h2>Shortcuts</h2>
            <a href="./eventPart.html" class="text-white">Apresentação LBAW</a>
            <br>
            <a href="./eventPart.html" class="text-white">Mini Teste PPIN</a>
            <br>
            <a href="./eventPart.html" class="text-white">Queima das Fitas</a>
            <br>
            <a href="./eventPart.html" class="text-white">Web Summit 2018</a>
            <br>
            <a href="./eventPart.html" class="text-white">Apresentação LBAW</a>
            <br>
            <a href="./eventPart.html" class="text-white">Mini Teste PPIN</a>
          </div>
          <hr>
          <div>
            <h2>LBAW1765</h2>
            <a href="./aboutLogged.html" class="text-white">About Us</a>
          </div>
        </div>
      </div>
      <div class="col-12 col-xl-9">
        <div class="container" >
          <div class="row">
            <div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="./eventMemb.html" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp1.jpg')}}">
                  <div class="content-details">
                    <h3>Apresentação LBAW</h3>
                    <p>28/03/2018
                      <br> Porto, Portugal</p>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="./eventMemb.html" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp2.jpg')}}">
                  <div class="content-details">
                    <h3>Mini Teste PPIN</h3>
                    <p>14/03/2018
                      <br> Porto, Portugal</p>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="jumbotron list content-lg p-0 mx-auto">
                <div class="row p-2">
                  <div class="col-2">
                    <a href="./quaresma.html" class="text-white">
                      <img src="./imgs/home.jpg" class="rounded-circle">
                    </a>
                  </div>
                  <div class="col-7">
                    <h5>
                      <a href="./quaresma.html" class="text-white">Quaresma1997</a> joined
                      <a href="./eventMemb.html" class="text-white">Apresentação LBAW</a>
                    </h5>
                  </div>
                  <div class="col-12">
                    <a href="./eventMemb.html" class="text-white">
                      <img src="./imgs/fa1.jpg" class="img-fluid rounded">
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron list content-lg p-0 mx-auto">
                <div class="row p-2">
                  <div class="col-2">
                    <a href="./quaresma.html" class="text-white">
                      <img src="./imgs/home.jpg" class="rounded-circle">
                    </a>
                  </div>
                  <div class="col-7">
                    <h5>
                      <a href="./quaresma.html" class="text-white">Quaresma1997</a> joined
                      <a href="./eventMemb.html" class="text-white">Mini Teste PPIN</a>
                    </h5>
                  </div>
                  <div class="col-12">
                    <a href="./eventMemb.html" class="text-white">
                      <img src="./imgs/fa2.jpg" class="img-fluid rounded">
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="./eventMemb.html" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp1.jpg')}}">
                  <div class="content-details">
                    <h3>Apresentação LBAW</h3>
                    <p>28/03/2018
                      <br> Porto, Portugal</p>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="./eventMemb.html" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp2.jpg')}}">
                  <div class="content-details">
                    <h3>Mini Teste PPIN</h3>
                    <p>14/03/2018
                      <br> Porto, Portugal</p>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="jumbotron list content-lg p-0 mx-auto">
                <div class="row p-2">
                  <div class="col-2">
                    <a href="./quaresma.html" class="text-white">
                      <img src="./imgs/home.jpg" class="rounded-circle">
                    </a>
                  </div>
                  <div class="col-7">
                    <h5>
                      <a href="./quaresma.html" class="text-white">Quaresma1997</a> joined
                      <a href="./eventMemb.html" class="text-white">Apresentação LBAW</a>
                    </h5>
                  </div>
                  <div class="col-12">
                    <a href="./eventMemb.html" class="text-white">
                      <img src="./imgs/fa1.jpg" class="img-fluid rounded">
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron list content-lg p-0 mx-auto">
                <div class="row p-2">
                  <div class="col-2">
                    <a href="./quaresma.html" class="text-white">
                      <img src="./imgs/home.jpg" class="rounded-circle">
                    </a>
                  </div>
                  <div class="col-7">
                    <h5>
                      <a href="./quaresma.html" class="text-white">Quaresma1997</a> joined
                      <a href="./eventMemb.html" class="text-white">Mini Teste PPIN</a>
                    </h5>
                  </div>
                  <div class="col-12">
                    <a href="./eventMemb.html" class="text-white">
                      <img src="./imgs/fa2.jpg" class="img-fluid rounded">
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="./eventMemb.html" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp1.jpg')}}">
                  <div class="content-details">
                    <h3>Apresentação LBAW</h3>
                    <p>28/03/2018
                      <br> Porto, Portugal</p>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="./eventMemb.html" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp2.jpg')}}">
                  <div class="content-details">
                    <h3>Mini Teste PPIN</h3>
                    <p>14/03/2018
                      <br> Porto, Portugal</p>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="jumbotron list content-lg p-0 mx-auto">
                <div class="row p-2">
                  <div class="col-2">
                    <a href="./quaresma.html" class="text-white">
                      <img src="./imgs/home.jpg" class="rounded-circle">
                    </a>
                  </div>
                  <div class="col-7">
                    <h5>
                      <a href="./quaresma.html" class="text-white">Quaresma1997</a> joined
                      <a href="./eventMemb.html" class="text-white">Apresentação LBAW</a>
                    </h5>
                  </div>
                  <div class="col-12">
                    <a href="./eventMemb.html" class="text-white">
                      <img src="./imgs/fa1.jpg" class="img-fluid rounded">
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron list content-lg p-0 mx-auto">
                <div class="row p-2">
                  <div class="col-2">
                    <a href="./quaresma.html" class="text-white">
                      <img src="./imgs/home.jpg" class="rounded-circle">
                    </a>
                  </div>
                  <div class="col-7">
                    <h5>
                      <a href="./quaresma.html" class="text-white">Quaresma1997</a> joined
                      <a href="./eventMemb.html" class="text-white">Mini Teste PPIN</a>
                    </h5>
                  </div>
                  <div class="col-12">
                    <a href="./eventMemb.html" class="text-white">
                      <img src="./imgs/fa2.jpg" class="img-fluid rounded">
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="./eventMemb.html" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp1.jpg')}}">
                  <div class="content-details">
                    <h3>Apresentação LBAW</h3>
                    <p>28/03/2018
                      <br> Porto, Portugal</p>
                  </div>
                </a>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron content-lg p-0 mx-auto">
                <a href="./eventMemb.html" class="text-white">
                  <div class="content-overlay"></div>
                  <img class="content-image rounded" src="{{url('/imgs/hp2.jpg')}}">
                  <div class="content-details">
                    <h3>Mini Teste PPIN</h3>
                    <p>14/03/2018
                      <br> Porto, Portugal</p>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-12 col-lg-6">
              <div class="jumbotron list content-lg p-0 mx-auto">
                <div class="row p-2">
                  <div class="col-2">
                    <a href="./quaresma.html" class="text-white">
                      <img src="./imgs/home.jpg" class="rounded-circle">
                    </a>
                  </div>
                  <div class="col-7">
                    <h5>
                      <a href="./quaresma.html" class="text-white">Quaresma1997</a> joined
                      <a href="./eventMemb.html" class="text-white">Apresentação LBAW</a>
                    </h5>
                  </div>
                  <div class="col-12">
                    <a href="./eventMemb.html" class="text-white">
                      <img src="./imgs/fa1.jpg" class="img-fluid rounded">
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
              <div class="jumbotron list content-lg p-0 mx-auto">
                <div class="row p-2">
                  <div class="col-2">
                    <a href="./quaresma.html" class="text-white">
                      <img src="./imgs/home.jpg" class="rounded-circle">
                    </a>
                  </div>
                  <div class="col-7">
                    <h5>
                      <a href="./quaresma.html" class="text-white">Quaresma1997</a> joined
                      <a href="./eventMemb.html" class="text-white">Mini Teste PPIN</a>
                    </h5>
                  </div>
                  <div class="col-12">
                    <a href="./eventMemb.html" class="text-white">
                      <img src="./imgs/fa2.jpg" class="img-fluid rounded">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
