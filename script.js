$(document).ready(function () {
  $("input[name='optionsRadiosType']").click(function (e) {
    let this_size = $(this).attr("id").length;
    var index = $(this).attr("id").substring(this_size - 1, this_size);
    $("div.tab-content[name='filter_sort']>div.tab-pane").removeClass("active");
    $("div.tab-content[name='filter_sort']>div.tab-pane").eq(index).addClass("active");

    $("div.tab-content[name='content']>div.tab-pane").removeClass("active");
    $("div.tab-content[name='content']>div.tab-pane").eq(index).addClass("active");
  });
});

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click', "#btn_editprofile", function (e) {
  let main_div = $("#user_info_container");

  let img = $("#user_info_img");

  let name = $("#user_info_l1").text();

  let first_name = name.substr(0, name.indexOf(' '));
  let last_name = name.substr(name.indexOf(' ') + 1, name.size);

  let email = $("#user_info_l2").text();

  let location = $("#user_info_l3").text();

  let city = location.substr(0, location.indexOf(','));
  let country = location.substr(location.indexOf(',') + 2, location.size);

  let btn_img =
    "<form action='myform.cgi'>" +
    "<input type='file' name='fileupload' value='Browse' id='fileupload' class='custom-file - input'>" +
    "<span class='custom-file-control form-control-file'></span>"
  "</form>"

    ;

  let div1 =
    "<div class='row mb-1'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-user fa-fw '></i>" +
    "</div>" +
    "<div class='col-4 px-0'>" +
    "<input type='text' id='input_first_name' class='form-control' placeholder='First name' value='" + first_name + "'>" +
    "</div>" +
    "<div class='col-6 pl-1'>" +
    "<input type='text' id='input_last_name' class='form-control' placeholder='Last name' value='" + last_name + "'>" +
    "</div>" +
    "</div>"
    ;

  let div2 =
    "<div class='row mb-1'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-envelope fa-fw '></i>" +
    "</div>" +
    "<div class='col-10 pr-3 pl-0'>" +
    "<input type='text' id='input_email' class='form-control' placeholder='First name' value='" + email + "'>" +
    "</div>" +

    "</div>"
    ;


  let div3 =
    "<div class='row'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-map-marker-alt fa-fw '></i>" +
    "</div>" +
    "<div class='col-4 px-0'>" +
    "<input type='text' id='input_city' class='form-control' placeholder='City' value='" + city + "'>" +
    "</div>" +
    "<div class='col-6 pl-1'>" +
    "<input type='text' id='input_country' class='form-control' placeholder='Country' value='" + country + "'>" +
    "</div>" +
    "</div>"
    ;

  let btns =
    "<div class='mt-3'>" +
    "<button type='button' class='btn btn-success btn-block' id='btn_confirm_edit_profile'><span><i class='fas fa-check fa-fw'></i> Confirm</span> </button>" +

    "<button type='button' class='btn btn-outline-danger btn-block' id='btn_cancel_edit_profile'><span><i class='fas fa-times fa-fw'></i> Cancel</span> </button>" +
    "</div>"
    ;


  main_div.html(

    "<img src='./imgs/profile.jpg' id='user_info_img' class='img img-fluid rounded mb-3'>" +
    btn_img +
    div1 + div2 + div3 + btns
  );
});


$(document).on('click', "#btn_confirm_edit_profile", function (e) {
  let main_div = $("#user_info_container");

  let img = $("#user_info_img");

  let first_name = $("#input_first_name").val();
  let last_name = $("#input_last_name").val();



  let email = $("#input_email").val();

  let city = $("#input_city").val();
  let country = $("#input_country").val();

  if (first_name == "") {
    first_name = "First name";
  }
  if (last_name == "") {
    last_name = "Last name";
  }
  if (city == "") {
    city = "City";
  }
  if (country == "") {
    country = "Country";
  }
  if (email == "") {
    email = "Email";
  }

  main_div.html(

    "<img src='./imgs/profile.jpg' id='user_info_img' class='img img-fluid rounded mb-3'><br>" +
    "<label id='user_info_l1'><i class='fas fa-user fa-fw mr-1'></i>" + first_name + " " + last_name + "</label><br>" +
    "<label id='user_info_l2'><i class='fas fa-envelope fa-fw mr-1'></i>" + email + "</label><br>" +
    "<label id='user_info_l3'><i class='fas fa-map-marker-alt fa-fw mr-1'></i>" + city + ", " + country + "</label>" +

    "<button type='button' class='btn btn-primary btn-lg btn-block mt-3' id='btn_editprofile'>" +
    "<i class='far fa-edit fa-fw'></i> Edit Profile </button>" +
    "<button type='button' class='btn btn-outline-danger btn-lg btn-block'>" +
    "<i class='far fa-trash-alt fa-fw'></i> Delete Profile </button>"
  );

});

//Quando faço cancel tem de ir para os valores antes de clicar em edit
//Ou seja, ao clicar em edit, guarda os valores nas variaveis que terao de ser globais

$(document).on('click', "#btn_cancel_edit_profile", function (e) {
  let main_div = $("#user_info_container");

  let img = $("#user_info_img");

  let first_name = $("#input_first_name").val();
  let last_name = $("#input_last_name").val();

  let email = $("#input_email").val();

  let city = $("#input_city").val();
  let country = $("#input_country").val();

  main_div.html(
    "<img src='./imgs/profile.jpg' id='user_info_img' class='img img-fluid rounded mb-3'>" +
    "<label id='user_info_l1'><i class='fas fa-user fa-fw'></i>Tiago Carvalho</label>" +
    "<label id='user_info_l2'><i class='fas fa-envelope fa-fw'></i>tiago79c@gmail.com</label>" +
    "<label id='user_info_l3'><i class='fas fa-map-marker-alt fa-fw'></i>Porto, Portugal</label>" +

    "<button type='button' class='btn btn-primary btn-lg btn-block mt-3' id='btn_editprofile'>" +
    "<i class='far fa-edit fa-fw'></i> Edit Profile </button>" +
    "<button type='button' class='btn btn-outline-danger btn-lg btn-block'>" +
    "<i class='far fa-trash-alt fa-fw'></i> Delete Profile </button>"
  );

});

// $(document).on('change', "#fileupload", function (e) {
//   let img_path = $("#fileupload");
//   console.log(img_path);
//   $("#img_text").text(img_path);
// });


function initMap() {
  // Styles a map in night mode.
  var map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 41.178990, lng: -8.597688 },
    zoom: 16,
    styles: [
      { elementType: 'geometry', stylers: [{ color: '#242f3e' }] },
      { elementType: 'labels.text.stroke', stylers: [{ color: '#242f3e' }] },
      { elementType: 'labels.text.fill', stylers: [{ color: '#746855' }] },
      {
        featureType: 'administrative.locality',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#d59563' }]
      },
      {
        featureType: 'poi',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#d59563' }]
      },
      {
        featureType: 'poi.park',
        elementType: 'geometry',
        stylers: [{ color: '#263c3f' }]
      },
      {
        featureType: 'poi.park',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#6b9a76' }]
      },
      {
        featureType: 'road',
        elementType: 'geometry',
        stylers: [{ color: '#38414e' }]
      },
      {
        featureType: 'road',
        elementType: 'geometry.stroke',
        stylers: [{ color: '#212a37' }]
      },
      {
        featureType: 'road',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#9ca5b3' }]
      },
      {
        featureType: 'road.highway',
        elementType: 'geometry',
        stylers: [{ color: '#746855' }]
      },
      {
        featureType: 'road.highway',
        elementType: 'geometry.stroke',
        stylers: [{ color: '#1f2835' }]
      },
      {
        featureType: 'road.highway',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#f3d19c' }]
      },
      {
        featureType: 'transit',
        elementType: 'geometry',
        stylers: [{ color: '#2f3948' }]
      },
      {
        featureType: 'transit.station',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#d59563' }]
      },
      {
        featureType: 'water',
        elementType: 'geometry',
        stylers: [{ color: '#17263c' }]
      },
      {
        featureType: 'water',
        elementType: 'labels.text.fill',
        stylers: [{ color: '#515c6d' }]
      },
      {
        featureType: 'water',
        elementType: 'labels.text.stroke',
        stylers: [{ color: '#17263c' }]
      }
    ]
  });
}
