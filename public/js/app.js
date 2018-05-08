function addEventListeners() {
  // if(countries == null)
  // getAddEventCitiesCountries();  
  let itemCheckers = document.querySelectorAll('article.card li.item input[type=checkbox]');
  [].forEach.call(itemCheckers, function (checker) {
    checker.addEventListener('change', sendItemUpdateRequest);
  });

  let itemCreators = document.querySelectorAll('article.card form.new_item');
  [].forEach.call(itemCreators, function (creator) {
    creator.addEventListener('submit', sendCreateItemRequest);
  });

  let itemDeleters = document.querySelectorAll('article.card li a.delete');
  [].forEach.call(itemDeleters, function (deleter) {
    deleter.addEventListener('click', sendDeleteItemRequest);
  });

  let cardDeleters = document.querySelectorAll('article.card header a.delete');
  [].forEach.call(cardDeleters, function (deleter) {
    deleter.addEventListener('click', sendDeleteCardRequest);
  });

  let cardCreator = document.querySelector('article.card form.new_card');
  if (cardCreator != null)
    cardCreator.addEventListener('submit', sendCreateCardRequest);

  let editProfile = document.querySelector('#btn_editprofile');
  if (editProfile != null) {
    if (cities == null) {
      getCurCountry();
      //   
      sendCitiesRequest(current_country);
    }
    editProfile.addEventListener('click', createEditProfileForm);
  }

  

  let deleteProfile = document.querySelector('#btn_deleteprofile');
  if (deleteProfile != null)
    deleteProfile.addEventListener('click', deleteProfileRequest);



  let editProfileConfirm = document.querySelector('form.edit_profile');
  if (editProfileConfirm != null) {

    editProfileConfirm.addEventListener('submit', sendEditProfileRequest);

  }

  let editProfileCancel = document.querySelector('form.edit_profile #btn_cancel_edit_profile');
  if (editProfileCancel != null)
    editProfileCancel.addEventListener('click', cancelEditProfile);


  let addEvent = document.querySelector('form.add_event');
  if (addEvent != null) {
    addEvent.addEventListener('submit', sendAddEventRequest);

  }

  let deleteEvent = document.querySelector('#btn_deleteEvent');
  if (deleteEvent != null)
    deleteEvent.addEventListener('click', deleteEventRequest);

  let editEvent = document.querySelector('#btn_editEvent');
  if (editEvent != null) {
     if (cities == null) {
      getCurCountryEvent();
      
      sendCitiesRequest(current_country);
     }
    editEvent.addEventListener('click', createEditEventForm);
  }

  let selectCity = document.querySelector('#select_city');
  if (selectCity != null)
    selectCity.addEventListener('change', createCityInput);

  let selectCountry = document.querySelector('#select_country');
  if (selectCountry != null) {
    selectCountry.addEventListener('change', createCountryInput);
  }

  let selectCityEvent = document.querySelector('#select_city_event');
  if (selectCityEvent != null)
    selectCityEvent.addEventListener('change', createCityInput);

  let selectCountryEvent = document.querySelector('#select_country_event');
  if (selectCountryEvent != null) {
    selectCountryEvent.addEventListener('change', createCountryInput);
  }

    let signUp = document.querySelector('#btn_signUp');
    if (signUp != null) {
      isSignUp = true;
      select = document.querySelector('#select_country');
      select.selectedIndex = 0;
      createCountryInput();
    }


  let editEventConfirm = document.querySelector('form.edit_event');
  if (editEventConfirm != null)
    editEventConfirm.addEventListener('submit', sendEditEventRequest);

  let editEventCancel = document.querySelector('form.edit_event #btn_cancel_edit_event');
  if (editEventCancel != null)
    editEventCancel.addEventListener('click', cancelEditEvent);



  let modalAddEvent = $('#add_event');
  if (modalAddEvent != null) {
    modalAddEvent.on('hide.bs.modal', function () {
      
      justRemoveOther = true;
      createCityInput();
      createCountryInput();
      
      

    });
    modalAddEvent.on('hidden.bs.modal', function () {
      isEvent = false;
      isDefault = true;
      justRemoveOther = false;
      putAddEventOptions();

    });
    modalAddEvent.on('show.bs.modal', function () {
      isEvent = true;
      if (editEventConfirm != null && isEditing)
        cancelEditEvent();
      if (editProfileConfirm != null && isEditing)
        cancelEditProfile();


    });
    modalAddEvent.on('shown.bs.modal', function () {
      putAddEventOptions();
      //  createCountryInput();
    });


  }
}

let current_first_name, current_last_name, current_email;
let current_city, current_country, current_city_default, current_country_default, current_img, current_description, current_date, current_time;
let cities, cities_default, countries, isEvent, isDefault = true, isSignUp;
  isEditing = false;
let justRemoveOther;

// $(document).ready(function(){
//   $('[data-toggle="tooltip"]').tooltip();
// });

function getCurCountryEvent() {
  let main_div = document.querySelector("#event_data");
  let localization = main_div.querySelector("#event_localization").innerText;

  let index_first_comma = localization.indexOf(',');
  let index_second_comma = localization.indexOf(',', index_first_comma + 1);

  let country = localization.substr(index_second_comma + 2, localization.size);

  current_country = country;
}

function getCurCountry() {
  let main_div = document.querySelector("#user_info_container");
  let location = main_div.querySelector("#user_info_l3").innerText;

  let country = location.substr(location.indexOf(',') + 2, location.size);

  current_country = country;

  
}

function createCityInput() {
  let select;
  
  if (isEvent)
    select = document.querySelector('#select_city_event');
  else
    select = document.querySelector('#select_city');
  let city = select.selectedOptions[0].value;
  let input = document.createElement("input");
  input.type = "text";
  input.id = "input_city";
  input.classList.add("form-control");
  input.placeholder = "City";
  input.required = true;
  input.name = "city";

  if(justRemoveOther)
    city = "";

  if (city == "Other") {
    if (select.parentElement.querySelector("input[id=input_city") == null)
      select.parentElement.appendChild(input);
    select.name = "select_city";
  } else {
    let old_input = select.parentElement.querySelector("input[id=input_city");
    if (old_input != null) {
      select.parentElement.removeChild(old_input);
      select.name = "city";
    }

  }

}

function createCountryInput() {
  let select;
  if (isEvent)
    select = document.querySelector('#select_country_event');
  else
    select = document.querySelector('#select_country');

  let country = select.selectedOptions[0].value;
  let input = document.createElement("input");
  input.type = "text";
  input.id = "input_country";
  input.classList.add("form-control");
  input.placeholder = "Country";
  input.required = true;
  input.name = "country";

  if (justRemoveOther)
    country = current_country_default;

  

  if (country == "Other") {

    select.parentElement.appendChild(input);
    if (isEvent || isSignUp)
      cities_default = new Array();
    else
      cities = new Array();
    changeCityOptions();
    select.name = "select_country";
  } else {
    
    let old_input = select.parentElement.querySelector("input[id=input_country");
    if (old_input != null) {
      select.parentElement.removeChild(old_input);
      select.name = "country";
    }

    sendCitiesRequest(country);

  }




}

function changeCityOptions() {
  let main_div = document.querySelector("#user_info_container");
  let select_city;
  if (isEvent)
    select_city = document.querySelector('#select_city_event');
  else
    select_city = document.querySelector('#select_city');

  if (select_city == null)
    return;

  let use_cities;
  let thisCurCity;
  if (isEvent || isSignUp) {
    use_cities = cities_default;
    thisCurCity = use_cities[0];
  } else {
    use_cities = cities;
    thisCurCity = current_city;
  }

  
  
  
  let cities_options = "";
  let i;
  for (i = 0; i < use_cities.length; i++) {
    cities_options += "<option value = '" + use_cities[i];
    if (use_cities[i] == thisCurCity)
      cities_options += "' selected>" + use_cities[i] + "</option>";
    else
      cities_options += "'>" + use_cities[i] + "</option>";
  }
  cities_options += "<option value = 'Other'>Other</option>";

  select_city.innerHTML = cities_options;

  createCityInput();
}

function putAddEventOptions() {
  let select_country = document.querySelector("#select_country_event");
  let select_city = document.querySelector("#select_city_event");
  let i;
  let countries_options = "";
  for (i = 0; i < countries.length; i++) {
    countries_options += "<option value = '" + countries[i];
    if (countries[i] == current_country_default)
      countries_options += "' selected>" + countries[i] + "</option>";
    else
      countries_options += "'>" + countries[i] + "</option>";

  }
  countries_options += "<option value = 'Other'>Other</option>";
  select_country.innerHTML = countries_options;

  

  let cities_options = "";
  for (i = 0; i < cities_default.length; i++) {
    cities_options += "<option value = '" + cities_default[i];
    if (i == 0)
      cities_options += "' selected>" + cities_default[i] + "</option>";
    else
      cities_options += "'>" + cities_default[i] + "</option>";
  }
  cities_options += "<option value = 'Other'>Other</option>";
  select_city.innerHTML = cities_options;


}

function createEditProfileForm(event) {
  let main_div = document.querySelector("#user_info_container");

  let img = main_div.querySelector("#user_info_img").getAttribute('src');

  let name = main_div.querySelector("#user_info_l1").innerText;

  let first_name = name.substr(0, name.indexOf(' '));
  let last_name = name.substr(name.indexOf(' ') + 1, name.size);

  let email = main_div.querySelector("#user_info_l2").innerText;

  let location = main_div.querySelector("#user_info_l3").innerText;

  let city = location.substr(0, location.indexOf(','));
  let country = location.substr(location.indexOf(',') + 2, location.size);

  current_img = img;
  current_first_name = first_name;
  current_last_name = last_name;
  current_email = email;
  current_city = city;
  current_country = country;

  let btn_img =
    "<form action='myform.cgi' class='img_form'>" +
    "<input type='file' name='fileupload' value='Browse' id='fileupload' class='custom-file - input'>" +
    "<span class='custom-file-control form-control-file'></span>" +
    "</form>"

  ;

  let div1 =
    "<div class='row mb-1'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-user fa-fw '></i>" +
    "</div>" +
    "<div class='col-4 px-0'>" +
    "<input type='text' id='input_first_name' class='form-control' placeholder='First name' value='" + first_name + "' required>" +
    "</div>" +
    "<div class='col-6 pl-1'>" +
    "<input type='text' id='input_last_name' class='form-control' placeholder='Last name' value='" + last_name + "' required>" +
    "</div>" +
    "</div>";

  let div2 =
    "<div class='row mb-1'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-envelope fa-fw '></i>" +
    "</div>" +
    "<div class='col-10 pr-3 pl-0'>" +
    "<input type='email' id='input_email' class='form-control' placeholder='First name' value='" + email + "' required>" +
    "</div>" +

    "</div>";



  
  let cities_options = "";
  let i;
  for (i = 0; i < cities.length; i++) {
    cities_options += "<option value = '" + cities[i];
    if (cities[i] == city)
      cities_options += "' selected>" + cities[i] + "</option>";
    else
      cities_options += "'>" + cities[i] + "</option>";
  }
  cities_options += "<option value = 'Other'>Other</option>";

  let countries_options = "";
  for (i = 0; i < countries.length; i++) {
    countries_options += "<option value = '" + countries[i];
    if (countries[i] == country)
      countries_options += "' selected>" + countries[i] + "</option>";
    else
      countries_options += "'>" + countries[i] + "</option>";

  }
  countries_options += "<option value = 'Other'>Other</option>";


  let div3 =
    "<div class='row'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-map-marker-alt fa-fw '></i>" +
    "</div>" +
    "<div class='col-5 pl-0'>" +
    "<select class = 'custom-select' id = 'select_city' name = 'select_city'>" +
    cities_options +
    "</select>" +
    "</div>" +
    "<div class='col-5 pl-1'>" +
    "<select class = 'custom-select' id = 'select_country' name = 'select_country'>" +
    countries_options +
    "</select>" +
    "</div>" +
    "</div>";

  let btns =
    "<div class='mt-3'>" +
    "<button type='submit' class='btn btn-success btn-block' id='btn_confirm_edit_profile'><span><i class='fas fa-check fa-fw'></i> Confirm</span> </button>" +

    "<button type='button' class='btn btn-outline-danger btn-block' id='btn_cancel_edit_profile'><span><i class='fas fa-times fa-fw'></i> Cancel</span> </button>" +
    "</div>";




  main_div.innerHTML =

    "<img src='" + img + "' id='user_info_img' class='img img-fluid rounded mb-3'>" +
    btn_img +
    "<form class='edit_profile'>" +
    div1 + div2 + div3 + btns +
    "</form>";

  isEditing = true;

  addEventListeners();

}

function createEditEventForm(event) {
  let main_div = document.querySelector("#event_data");

  let name = main_div.querySelector("#event_name").innerText;

  let date_text = main_div.querySelector("#event_date").innerText;
  let index_at = date_text.indexOf('at');
  let date = date_text.substr(0, index_at - 1);
  let time = date_text.substr(index_at + 3, date_text.size);

  let localization = main_div.querySelector("#event_localization").innerText;

  let index_first_comma = localization.indexOf(',');
  let index_second_comma = localization.indexOf(',', index_first_comma + 1);

  
  let place = localization.substr(0, index_first_comma);
  let city = localization.substr(index_first_comma + 2, index_second_comma - index_first_comma - 2);
  let country = localization.substr(index_second_comma + 2, localization.size);

  let description = main_div.querySelector("#event_description").innerText;

  current_name = name;
  current_date = date;
  current_time = time;
  current_place = place;
  current_city = city;
  current_country = country;
  current_description = description;

  let form_name =
    "<label for='name'>Name</label>" +
    "<input type='text' id='input_name' class='form-control' placeholder='Event name' value='" + name + "' required>";
  let form_date =
    "<div class='row mt-3'>" +
    "<div class='col-1 pr-0'>" +
    "<i class='fas fa-clock fa-fw' ></i>" +
    "</div>" +
    "<div class='col-5'>" +
    "<label for='date'>Date</label>" +
    "<input type='date' id='input_date' class='form-control' value='" + date + "' required>" +
    "</div>" +
    "<div class='col-5'>" +
    "<label for='time'>Time</label>" +
    "<input type='time' id='input_time' class='form-control' value='" + time + "' required>" +
    "</div>" +
    "</div>";

  
  let cities_options = "";
  let i;
  for (i = 0; i < cities.length; i++) {
    cities_options += "<option value = '" + cities[i];
    if (cities[i] == city)
      cities_options += "' selected>" + cities[i] + "</option>";
    else
      cities_options += "'>" + cities[i] + "</option>";
  }
  cities_options += "<option value = 'Other'>Other</option>";

  let countries_options = "";
  for (i = 0; i < countries.length; i++) {
    countries_options += "<option value = '" + countries[i];
    if (countries[i] == country)
      countries_options += "' selected>" + countries[i] + "</option>";
    else
      countries_options += "'>" + countries[i] + "</option>";

  }
  countries_options += "<option value = 'Other'>Other</option>";

  let form_localization =
    "<div class='row mt-3'>" +
    "<div class='col-1 pr-0'>" +
    "<i class='fas fa-map-marker-alt fa-fw' ></i>" +
    "</div>" +
    "<div class='col-5'>" +
    "<label for='place'>Place</label>" +
    "<input type='text' id='input_place' class='form-control' placeholder='Event place' value='" + place + "' required>" +
    "</div>" +
    "<div class='col-3 px-0'>" +
    "<label for='country'>Country</label>" +
    "<select class = 'custom-select' id = 'select_country' name = 'select_country'>" +
    countries_options +
    "</select>" +
    "</div>" +
    "<div class='col-3 pl-1 pr-0'>" +
    "<label for='city'>City</label>" +
    "<select class = 'custom-select' id = 'select_city' name = 'select_city'>" +
    cities_options +
    "</select>" +
    "</div>" +
    "</div>";

  let form_description =
    "<label for='description'>Description</label>" +
    "<textarea id='input_description' class='form-control' rows='4' cols='1' placeholder='Event description'>" + description + "</textarea>";

  let btns =
    "<div class='row mt-5'>" +
    "<div class='col-4 offset-2'>" +
    "<button type='submit' class='btn btn-success btn-block' id='btn_confirm_edit_event'><span><i class='fas fa-check fa-fw'></i> Confirm</span> </button>" +
    "</div>" +
    "<div class='col-4'>" +
    "<button type='button' class='btn btn-danger btn-block' id='btn_cancel_edit_event'><span><i class='fas fa-times fa-fw'></i> Cancel</span> </button>" +
    "</div>" +
    "</div>";


  main_div.innerHTML =

    "<form class='edit_event'>" +
    "<div class='row'>" +
    "<div class='col-12 col-lg-6'>" +
    form_name + form_date + form_localization +
    "</div>" +
    "<div class='col-12 col-lg-6'>" +
    form_description +
    "</div>" +
    "</div>" +
    btns +
    "</form>";

  isEditing = true;

  addEventListeners();

}

//Quando faço cancel tem de ir para os valores antes de clicar em edit
//Ou seja, ao clicar em edit, guarda os valores nas variaveis que terao de ser globais
function cancelEditProfile(event) {
  let main_div = document.querySelector("#user_info_container");

  main_div.innerHTML =
    "<img src='/imgs/profile.jpg' id='user_info_img' class='img img-fluid rounded mb-3'> <br>" +
    "<label id='user_info_l1'><i class='fas fa-user fa-fw mr-1'></i>" + current_first_name + " " + current_last_name + "</label> <br>" +
    "<label id='user_info_l2'><i class='fas fa-envelope fa-fw mr-1'></i>" + current_email + "</label> <br>" +
    "<label id='user_info_l3'><i class='fas fa-map-marker-alt fa-fw mr-1'></i>" + current_city + ", " + current_country + "</label>" +

    "<button type='button' class='btn btn-primary btn-lg btn-block mt-3' id='btn_editprofile'>" +
    "<i class='far fa-edit fa-fw'></i> Edit Profile </button>" +
    "<button type='button' class='btn btn-outline-danger btn-lg btn-block'>" +
    "<i class='far fa-trash-alt fa-fw'></i> Delete Profile </button>";

  isEditing = false;

  addEventListeners();
}

function cancelEditEvent(event) {
  let main_div = document.querySelector("#event_data");
  main_div.innerHTML =
    "<h1 class='display-4' id='event_name'>" + current_name + "</h1><br>" +
    "<div class='row'>" +
    "<div class='col-12 col-lg-5'>" +
    "<h5 id='event_date'>" +
    "<i class='fas fa-clock fa-fw' ></i>" + current_date + " at " + current_time + "</h5>" +
    "<h5 id='event_localization'>" +
    "<i class='fas fa-map-marker-alt fa-fw'></i>" + current_place + ", " + current_city + ", " + current_country + "</h5><br>" +
    "</div>" +
    "<div class='col - 12 col - lg - 7'>" +
    "<h1>Description</h1><br>" +
    "<p id='event_description'>" + current_description + "</p>" +
    "</div>" +
    "</div>";

  addEventListeners();

  isEditing = false;
}


// $(document).on('change', "#fileupload", function (e) {
//   let img_path = $("#fileupload");
//   
//   $("#img_text").text(img_path);
// });


function initMap() {
  // Styles a map in night mode.
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 41.178990,
      lng: -8.597688
    },
    zoom: 16,
    styles: [{
        elementType: 'geometry',
        stylers: [{
          color: '#242f3e'
        }]
      },
      {
        elementType: 'labels.text.stroke',
        stylers: [{
          color: '#242f3e'
        }]
      },
      {
        elementType: 'labels.text.fill',
        stylers: [{
          color: '#746855'
        }]
      },
      {
        featureType: 'administrative.locality',
        elementType: 'labels.text.fill',
        stylers: [{
          color: '#d59563'
        }]
      },
      {
        featureType: 'poi',
        elementType: 'labels.text.fill',
        stylers: [{
          color: '#d59563'
        }]
      },
      {
        featureType: 'poi.park',
        elementType: 'geometry',
        stylers: [{
          color: '#263c3f'
        }]
      },
      {
        featureType: 'poi.park',
        elementType: 'labels.text.fill',
        stylers: [{
          color: '#6b9a76'
        }]
      },
      {
        featureType: 'road',
        elementType: 'geometry',
        stylers: [{
          color: '#38414e'
        }]
      },
      {
        featureType: 'road',
        elementType: 'geometry.stroke',
        stylers: [{
          color: '#212a37'
        }]
      },
      {
        featureType: 'road',
        elementType: 'labels.text.fill',
        stylers: [{
          color: '#9ca5b3'
        }]
      },
      {
        featureType: 'road.highway',
        elementType: 'geometry',
        stylers: [{
          color: '#746855'
        }]
      },
      {
        featureType: 'road.highway',
        elementType: 'geometry.stroke',
        stylers: [{
          color: '#1f2835'
        }]
      },
      {
        featureType: 'road.highway',
        elementType: 'labels.text.fill',
        stylers: [{
          color: '#f3d19c'
        }]
      },
      {
        featureType: 'transit',
        elementType: 'geometry',
        stylers: [{
          color: '#2f3948'
        }]
      },
      {
        featureType: 'transit.station',
        elementType: 'labels.text.fill',
        stylers: [{
          color: '#d59563'
        }]
      },
      {
        featureType: 'water',
        elementType: 'geometry',
        stylers: [{
          color: '#17263c'
        }]
      },
      {
        featureType: 'water',
        elementType: 'labels.text.fill',
        stylers: [{
          color: '#515c6d'
        }]
      },
      {
        featureType: 'water',
        elementType: 'labels.text.stroke',
        stylers: [{
          color: '#17263c'
        }]
      }
    ]
  });
}


function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function sendItemUpdateRequest() {
  let item = this.closest('li.item');
  let id = item.getAttribute('data-id');
  let checked = item.querySelector('input[type=checkbox]').checked;

  sendAjaxRequest('post', '/api/item/' + id, {
    done: checked
  }, itemUpdatedHandler);
}

function sendDeleteItemRequest() {
  let id = this.closest('li.item').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/item/' + id, null, itemDeletedHandler);
}

function sendCreateItemRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  let description = this.querySelector('input[name=description]').value;

  if (description != '')
    sendAjaxRequest('put', '/api/cards/' + id, {
      description: description
    }, itemAddedHandler);

  event.preventDefault();
}

function sendDeleteCardRequest(event) {
  let id = this.closest('article').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/cards/' + id, null, cardDeletedHandler);
}

function sendCreateCardRequest(event) {
  let name = this.querySelector('input[name=name]').value;

  if (name != '')
    sendAjaxRequest('put', '/api/cards/', {
      name: name
    }, cardAddedHandler);

  event.preventDefault();
}

function sendAddEventRequest(event) {
  let name = document.querySelector('input[id=name]').value;
  let type = document.querySelector('#select_type select').value;
  let category = this.querySelector('#select_category select').value;
  let date = this.querySelector('input[id=date]').value;
  let time = this.querySelector('input[id=time]').value;
  let city = this.querySelector('select[id=select_city_event]').selectedOptions[0].value;
  let country = this.querySelector('select[id=select_country_event]').selectedOptions[0].value;
  let place = this.querySelector('input[id=place]').value;
  let address = this.querySelector('input[id=address]').value;
  let description = this.querySelector('#description').value;

  if (city == "Other")
    city = this.querySelector('input[id=input_city]').value;

  if (country == "Other")
    country = this.querySelector('input[id=input_country]').value;


  if (name != '' && date != '' && city != '' && country != '' && place != '' && address != '' && description != '') {
    sendAjaxRequest('post', '/api/add_event', {
      name: name,
      type: type,
      category: category,
      date: date,
      time: time,
      city: city,
      country: country,
      place: place,
      address: address,
      description: description
    }, eventAddedHandler);
  }
  event.preventDefault();
}



function sendCountriesRequest() {
  sendAjaxRequest('get', '/countries', null, getCountriesHandler);
}

function sendCitiesRequest(country) {
  
  sendAjaxRequest('get', '/cities/' + country, null, getCitiesHandler);
}

function sendEditProfileRequest(event) {
  let id = this.closest('div').getAttribute('data-id');
  let first_name = this.querySelector('input[id=input_first_name]').value;
  let last_name = this.querySelector('input[id=input_last_name]').value;
  let email = this.querySelector('input[id=input_email]').value;
  let city = this.querySelector('select[id=select_city]').selectedOptions[0].value;
  let country = this.querySelector('select[id=select_country]').selectedOptions[0].value;
  let img_path = document.querySelector('input[id=fileupload').value;

  if (city == "Other")
    city = this.querySelector('input[id=input_city]').value;

  if (country == "Other")
    country = this.querySelector('input[id=input_country]').value;

  let index;
  if (img_path == "") {
    img_path = current_img;
    if (img_path.indexOf('http') == -1)
      index = img_path.indexOf('/', 2);
    else
      index = img_path.indexOf('/', 23);


  } else {
    index = img_path.indexOf('\\', 3);
  }

  let img_name = img_path.substr(index + 1, img_path.size);
  img = '/imgs/' + img_name;


  sendAjaxRequest('post', '/api/profile/' + id, {
    first_name: first_name,
    last_name: last_name,
    email: email,
    city: city,
    country: country,
    img: img
  }, profileEditedHandler);

  event.preventDefault();
}

function sendEditEventRequest(event) {
  let id = this.closest('div').getAttribute('data-id');
  let name = this.querySelector('input[id=input_name]').value;
  let date = this.querySelector('input[id=input_date]').value;
  let time = this.querySelector('input[id=input_time]').value;
  let place = this.querySelector('input[id=input_place]').value;
  let city = this.querySelector('select[id=select_city]').selectedOptions[0].value;
  let country = this.querySelector('select[id=select_country]').selectedOptions[0].value;
  let description = document.querySelector('textarea[id=input_description').value;

  if (city == "Other")
    city = this.querySelector('input[id=input_city]').value;

  if (country == "Other")
    country = this.querySelector('input[id=input_country]').value;


  sendAjaxRequest('post', '/api/event/' + id, {
    name: name,
    date: date,
    time: time,
    place: place,
    city: city,
    country: country,
    description: description
  }, eventEditedHandler);

  event.preventDefault();
}



function deleteProfileRequest(event) {
  let id = this.closest('div').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/profile/' + id, null, profileDeletedHandler);
}

function deleteEventRequest(event) {
  let id = document.querySelector("#event_data").getAttribute('data-id');

  sendAjaxRequest('delete', '/api/event/' + id, null, eventDeletedHandler);
}

function getCitiesHandler() {
  
  let cit = JSON.parse(this.responseText)['cities'];
  
  if (isDefault || isEvent || isSignUp) {
    cities_default = new Array();
    for (let i = 0; i < cit.length; i++) {
      cities_default.push(cit[i].name);
    }
    isDefault = false;
   
  } else {
    cities = new Array();
    for (let i = 0; i < cit.length; i++) {
      cities.push(cit[i].name);
    }
    
  }
  changeCityOptions();
  //changeCityOptions();
}

function getCountriesHandler() {
  
  let message = JSON.parse(this.responseText)['message'];
  if (message == "success") {
    let countr = JSON.parse(this.responseText)['countries'];
    countries = new Array();
    for (let i = 0; i < countr.length; i++) {
      countries.push(countr[i].name);
    }

    current_country_default = countr[0].name;
    sendCitiesRequest(current_country_default);
    
    addEventListeners();

  } else {
    alert("ERROR getting countries!");
  }
  //addEventListeners();
}

function profileEditedHandler() {
  let message = JSON.parse(this.responseText)['message'];
  let profile;
  if (message == 'success') {
    profile = JSON.parse(this.responseText)['user'];
    city = JSON.parse(this.responseText)['city'];
    country = JSON.parse(this.responseText)['country'];
    updateProfile(profile, city, country);
    getCurCountry();
    sendCountriesRequest();
  } else {
    let content = document.querySelector("#content");
    let errors;
    errors = content.querySelector("#errors");
    if (errors == null) {
      errors = document.createElement("div");
      errors.id = "errors";
      errors.classList.add("alert");
      errors.classList.add("alert-danger");
    }
    errors.innerHTML =
      "<ul>";
    message['message'].forEach(element => {
      errors.innerHTML += "<li>" + element + "</li>";
    });
    errors.innerHTML += "</ul>";
    content.insertBefore(errors, content.firstChild);

  }
  cities = null;
  addEventListeners();

}

function eventEditedHandler() {
  let message = JSON.parse(this.responseText)['message'];
  let event;
  if (message == 'success') {
    event = JSON.parse(this.responseText)['event'];
    city = JSON.parse(this.responseText)['city'];
    country = JSON.parse(this.responseText)['country'];
    localization = JSON.parse(this.responseText)['localization'];
    updateEvent(event, city, country, localization);
     
     getCurCountryEvent();
     sendCountriesRequest();
     
  } else {
    let content = document.querySelector("#content");
    let errors;
    errors = content.querySelector("#errors");
    if (errors == null) {
      errors = document.createElement("div");
      errors.id = "errors";
      errors.classList.add("alert");
      errors.classList.add("alert-danger");
    }
    errors.innerHTML =
      "<ul>";
    message['message'].forEach(element => {
      errors.innerHTML += "<li>" + element + "</li>";
    });
    errors.innerHTML += "</ul>";
    content.insertBefore(errors, content.firstChild);
  }
  cities = null;
  addEventListeners();

}

function profileDeletedHandler() {

  if (this.status != 200) window.location = '/';
}

function eventDeletedHandler() {
  if (this.status == 200) window.location = '/';
  let message = JSON.parse(this.responseText)['message'];
  if (message == "error") {
    let content = document.querySelector("#content");
    let errors;
    errors = content.querySelector("#errors");
    if (errors == null) {
      errors = document.createElement("div");
      errors.id = "errors";
      errors.classList.add("alert");
      errors.classList.add("alert-danger");
    }
    errors.innerHTML =
      "<ul>";
    message['message'].forEach(element => {
      errors.innerHTML += "<li>" + element + "</li>";
    });
    errors.innerHTML += "</ul>";
    content.insertBefore(errors, content.firstChild);
  }
}

function updateProfile(profile, city, country) {
  let main_div = document.querySelector("#user_info_container");

  let img = document.querySelector("#user_info_img");

  main_div.innerHTML =

    "<img src='" + profile.image_path + "' id='user_info_img' class='img img-fluid rounded mb-3'><br>" +
    "<label id='user_info_l1'><i class='fas fa-user fa-fw mr-1'></i>" + profile.first_name + " " + profile.last_name + "</label><br>" +
    "<label id='user_info_l2'><i class='fas fa-envelope fa-fw mr-1'></i>" + profile.email + "</label><br>" +
    "<label id='user_info_l3'><i class='fas fa-map-marker-alt fa-fw mr-1'></i>" + city + ", " + country + "</label>" +

    "<button type='button' class='btn btn-primary btn-lg btn-block mt-3' id='btn_editprofile'>" +
    "<i class='far fa-edit fa-fw'></i> Edit Profile </button>" +
    "<button type='button' class='btn btn-outline-danger btn-lg btn-block'>" +
    "<i class='far fa-trash-alt fa-fw'></i> Delete Profile </button>";

  isEditing = false;

  addEventListeners();
}

function updateEvent(event, city, country, localization) {
  let main_div = document.querySelector("#event_data");
  let parent = main_div.parentElement;
  let btn_edit = parent.querySelector("#btn_editEvent");
  btn_edit.disabled = false;


  main_div.innerHTML =
    "<h1 class='display-4' id='event_name'>" + event.name + "</h1><br>" +
    "<div class='row'>" +
    "<div class='col-12 col-lg-5'>" +
    "<h5 id='event_date'>" +
    "<i class='fas fa-clock fa-fw' ></i>" + event.date + " at " + event.time + "</h5>" +
    "<h5 id='event_localization'>" +
    "<i class='fas fa-map-marker-alt fa-fw'></i>" + localization.name + ", " + city + ", " + country + "</h5><br>" +
    "</div>" +
    "<div class='col - 12 col - lg - 7'>" +
    "<h1>Description</h1><br>" +
    "<p id='event_description'>" + event.description + "</p>" +
    "</div>" +
    "</div>";

  isEditing = false;

  addEventListeners();
}

function itemUpdatedHandler() {
  let item = JSON.parse(this.responseText);
  let element = document.querySelector('li.item[data-id="' + item.id + '"]');
  let input = element.querySelector('input[type=checkbox]');
  element.checked = item.done == "true";
}

function itemAddedHandler() {
  if (this.status != 200) window.location = '/';
  let item = JSON.parse(this.responseText);

  // Create the new item
  let new_item = createItem(item);

  // Insert the new item
  let card = document.querySelector('article.card[data-id="' + item.card_id + '"]');
  let form = card.querySelector('form.new_item');
  form.previousElementSibling.append(new_item);

  // Reset the new item form
  form.querySelector('[type=text]').value = "";
}

function itemDeletedHandler() {
  if (this.status != 200) window.location = '/';
  let item = JSON.parse(this.responseText);
  let element = document.querySelector('li.item[data-id="' + item.id + '"]');
  element.remove();
}

function cardDeletedHandler() {
  if (this.status != 200) window.location = '/';
  let card = JSON.parse(this.responseText);
  let article = document.querySelector('article.card[data-id="' + card.id + '"]');
  article.remove();
}

function cardAddedHandler() {
  if (this.status != 200) window.location = '/';
  let card = JSON.parse(this.responseText);

  // Create the new card
  let new_card = createCard(card);

  // Reset the new card input
  let form = document.querySelector('article.card form.new_card');
  form.querySelector('[type=text]').value = "";

  // Insert the new card
  let article = form.parentElement;
  let section = article.parentElement;
  section.insertBefore(new_card, article);

  // Focus on adding an item to the new card
  new_card.querySelector('[type=text]').focus();
}

function eventAddedHandler() {
  
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let id = response['id'];
    window.location = '/events/' + id;
  } else {
    let form = document.querySelector("#form_add_event");
    let errors;
    errors = form.querySelector("#errors");
    if (errors == null) {
      errors = document.createElement("div");
      errors.id = "errors";
      errors.classList.add("alert");
      errors.classList.add("alert-danger");
    }
    errors.innerHTML =
      "<ul>";
    response['message'].forEach(element => {
      errors.innerHTML += "<li>" + element + "</li>";
    });
    errors.innerHTML += "</ul>";
    form.insertBefore(errors, form.firstChild);
  }
}

function createCard(card) {
  let new_card = document.createElement('article');
  new_card.classList.add('card');
  new_card.setAttribute('data-id', card.id);
  new_card.innerHTML = `

  <header>
    <h2><a href="cards/${card.id}">${card.name}</a></h2>
    <a href="#" class="delete">&#10761;</a>
  </header>
  <ul></ul>
  <form class="new_item">
    <input name="description" type="text">
  </form>`;

  let creator = new_card.querySelector('form.new_item');
  creator.addEventListener('submit', sendCreateItemRequest);

  let deleter = new_card.querySelector('header a.delete');
  deleter.addEventListener('click', sendDeleteCardRequest);

  return new_card;
}

function createItem(item) {
  let new_item = document.createElement('li');
  new_item.classList.add('item');
  new_item.setAttribute('data-id', item.id);
  new_item.innerHTML = `
  <label>
    <input type="checkbox"> <span>${item.description}</span><a href="#" class="delete">&#10761;</a>
  </label>
  `;

  new_item.querySelector('input').addEventListener('change', sendItemUpdateRequest);
  new_item.querySelector('a.delete').addEventListener('click', sendDeleteItemRequest);

  return new_item;
}

sendCountriesRequest();