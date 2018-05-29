function addEventListeners() {

  let editProfile = document.querySelector('#btn_editprofile');
  if (editProfile != null) {
    if (cities == null) {
      getCurCountry();

      sendCitiesRequest(current_country);
    }

    editProfile.addEventListener('click', createEditProfileForm);
  }



  let deleteProfile = document.querySelector('#btn_deleteprofile');
  if (deleteProfile != null)
    deleteProfile.addEventListener('click', deleteProfileRequest);

  let imageProfile = document.querySelector("#user_info_img");

  let imageProfileUpload = document.querySelector('#fileupload');
  if (imageProfileUpload != null)
    imageProfileUpload.addEventListener('change', function () {
      var reader = new FileReader();
      var name = imageProfileUpload.value;
      var img = document.createElement("img");
      img.classList.add('img');
      img.classList.add('img-fluid');
      img.classList.add('rounded');
      img.classList.add('mb-3');
      img.id = 'user_info_img';

      reader.onload = function (e) {
        img.src = e.target.result;
        imageProfile.parentNode.replaceChild(img, imageProfile);
      };
      reader.readAsDataURL(imageProfileUpload.files[0]);
      // imageProfile.src = imageProfileUpload.value;
      imageProfile = document.querySelector("#user_info_img")
    });

  let imagesUpload = document.querySelector('#images');
  if (imagesUpload != null)
    imagesUpload.addEventListener('change', function (e) {
      let total_file = document.getElementById("images").files.length;
      for (let i = 0; i < total_file; i++) {
        console.log(e);
        $('#image_preview').append("<div class='col-md-3 p-0 align-self-center justify-content-center'><img class='img-responsive images_uploaded' src='" + URL.createObjectURL(e.target.files[i]) + "'></div>");
      }
    });




  let imagePostUploads = document.querySelectorAll('#filePost');
  for (let i = 0; i < imagePostUploads.length; i++) {
    imagePostUploads[i].addEventListener('change', function () {
      let par = imagePostUploads[i].parentNode.parentNode;

      let imagePost = par.querySelector("#post_image");
      let imgPost = imagePost.querySelector("#img");
      console.log(imgPost);
      var reader = new FileReader();
      var name = imagePostUploads[i].value;
      var img = document.createElement("img");

      img.height = 200;
      img.width = 300;

      img.id = 'img';

      reader.onload = function (e) {
        img.src = e.target.result;
        img.setAttribute("img-name", e.target.result);
        imgPost.parentNode.replaceChild(img, imgPost);
        console.log(img);
      };
      reader.readAsDataURL(imagePostUploads[i].files[0]);
      // imageProfile.src = imageProfileUpload.value;

    });
  }


  let btn_addEventHelps = document.querySelectorAll("#btn_addEventHelp");
  for (let i = 0; i < btn_addEventHelps.length; i++) {
    btn_addEventHelps[i].addEventListener('click', function () {
      let help = btn_addEventHelps[i].querySelector("#help");
      help.classList.toggle('show');
    });
  }

  let editProfileConfirm = document.querySelector('#btn_confirm_edit_profile');


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
    if (cities == null && editEvent.disabled == false) {
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
    select.selectedIndex = 2;
    createCountryInput();
  }


  let editEventConfirm = document.querySelector('form.edit_event');
  // if (editEventConfirm != null) 
  // editEventConfirm.addEventListener('submit', sendEditEventRequest);



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
      setTimeout(putAddEventOptions, 1000);

    });
    modalAddEvent.on('show.bs.modal', function () {
      isEvent = true;
      if (editEventConfirm != null && isEditing)
        cancelEditEvent();
      if (editProfileConfirm != null && isEditing)
        cancelEditProfile();


    });
    modalAddEvent.on('shown.bs.modal', function () {
      console.log("AAA");
      setTimeout(putAddEventOptions, 1000);

      //  createCountryInput();
    });
  }
  btns_banUser = document.querySelectorAll('#btn_banUser');
  for (let i = 0; i < btns_banUser.length; i++) {
    btns_banUser[i].addEventListener('click', function () {
      currentUser = i;
      sendBanUserRequest();
    });
  }

  btns_remEvent = document.querySelectorAll('#btn_remEvent');
  for (let i = 0; i < btns_remEvent.length; i++) {
    btns_remEvent[i].addEventListener('click', function () {
      currentEvent = i;
      sendRemEventRequest();
    });
  }

  let cancelParticipation = document.querySelector('#btn_cancelParticipation');
  if (cancelParticipation != null) {
    cancelParticipation.addEventListener('click', sendCancelParticipationRequest);

  }

  btns_removeParticipant = document.querySelectorAll('#btn_removeParticipant');
  for (let i = 0; i < btns_removeParticipant.length; i++) {
    btns_removeParticipant[i].addEventListener('click', function () {
      currentParticipant = i;
      sendRemoveParticipantRequest();
    });
  }

  let addParticipation = document.querySelector('#btn_addParticipation');
  if (addParticipation != null) {
    addParticipation.addEventListener('click', sendAddParticipationRequest);

  }


  let addFriend = document.querySelector('#btn_addFriend');
  if (addFriend != null) {
    addFriend.addEventListener('click', sendAddFriendRequest);
  }

  let removeFriend = document.querySelector('#btn_removeFriend');
  if (removeFriend != null) {
    removeFriend.addEventListener('click', sendRemoveFriendRequest);
  }

  let acceptEventInvite = document.querySelectorAll('#btn_acceptEventInvite');
  for (let i = 0; i < acceptEventInvite.length; i++) {
    acceptEventInvite[i].addEventListener('click', sendAcceptEventInviteRequest);
  }

  let declineEventInvite = document.querySelectorAll('#btn_declineEventInvite');
  for (let i = 0; i < declineEventInvite.length; i++) {
    declineEventInvite[i].addEventListener('click', sendDeclineEventInviteRequest);
  }

  let acceptFriend = document.querySelectorAll('#btn_acceptFriend');
  for (let i = 0; i < acceptFriend.length; i++) {
    acceptFriend[i].addEventListener('click', sendAcceptFriendRequest);
  }

  let declineFriend = document.querySelectorAll('#btn_declineFriend');
  for (let i = 0; i < declineFriend.length; i++) {
    declineFriend[i].addEventListener('click', sendDeclineFriendRequest);
  }

  btns_makeInvite = document.querySelectorAll('#btn_inviteToEvent');
  for (let i = 0; i < btns_makeInvite.length; i++) {
    makeInvite.push(sendMakeInviteRequest.bind(sendMakeInviteRequest, i));
    btns_makeInvite[i].addEventListener('click', makeInvite[i]);
  }

  btns_cancelInvite = document.querySelectorAll('#btn_cancelInvite');
  for (let i = 0; i < btns_cancelInvite.length; i++) {
    cancelInvite.push(sendCancelInviteRequest.bind(sendCancelInviteRequest, i));
    btns_cancelInvite[i].addEventListener('click', cancelInvite[i]);
  }

  let rate = document.querySelector("#star_rating");


  let starRatings = document.querySelectorAll('input[name=rating');
  for (let i = 0; i < starRatings.length; i++) {
    starRatings[i].addEventListener('click', sendStarRateRequest);
    if (rate.getAttribute("data-id") != "null") {
      if (Math.round(rate.getAttribute("data-id")) == 5 - i)
        starRatings[i].checked = true;
    }
  }

  btns_markAsSeen_notDel = document.querySelectorAll('#btn_markAsSeen_notDel');
  for (let i = 0; i < btns_markAsSeen_notDel.length; i++) {
    markNotdelete.push(sendMarkNotDelAsSeenRequest.bind(sendMarkNotDelAsSeenRequest, i));
    btns_markAsSeen_notDel[i].addEventListener('click', markNotdelete[i]);
  }

  btns_markAsSeen_notUpd = document.querySelectorAll('#btn_markAsSeen_notUpd');
  for (let i = 0; i < btns_markAsSeen_notUpd.length; i++) {
    markNotupdate.push(sendMarkNotUpdAsSeenRequest.bind(sendMarkNotUpdAsSeenRequest, i));
    btns_markAsSeen_notUpd[i].addEventListener('click', markNotupdate[i]);
  }

  let btns_editPost = document.querySelectorAll('#btn_editPost');
  for (let i = 0; i < btns_editPost.length; i++) {
    btns_editPost[i].addEventListener('click', createEditPostForm);
  }

  let btn_addShortcut = document.querySelector("#btn_addShortcut");
  if (btn_addShortcut != null){
    btn_addShortcut.addEventListener('click', sendAddShortcutRequest);
    let sel_short = document.querySelector("#eventsShortcuts");
    if (sel_short.length == 0)
      btn_addShortcut.disabled = true;
  }

  btn_deleteShortcuts = document.querySelectorAll('#btn_deleteShortcut');
  for (let i = 0; i < btn_deleteShortcuts.length; i++) {
    console.log(i);
     deleteShortctus.push(sendDeleteShortcutRequest.bind(sendDeleteShortcutRequest, i));
     btn_deleteShortcuts[i].addEventListener('click', deleteShortctus[i]);
  }

}


let current_first_name, current_last_name, current_email;
let current_city, current_country, current_city_default, current_country_default, current_img, current_description, current_date, current_time;
let cities, cities_default, countries, isEvent, isDefault = true,
  isSignUp, isEditing = false;
let justRemoveOther;
let current_not, current_shortcut;


let current_category, current_category_id, current_public;
let btn_deleteShortcuts;
let btns_banUser, currentUser, currentEvent, currentInvite, currentParticipant;
let makeInvite = new Array(),
  cancelInvite = new Array(),
  markNotupdate = new Array(),
  markNotdelete = new Array(),
  deleteShortctus = new Array();



$(document).ready(function(){
  $("input[name='optionsRadiosType']").click(function (e) {
    let this_size = $(this).attr("id").length;
    var index = $(this).attr("id").substring(this_size - 1, this_size);
    $("div.tab-content[name='filter_sort']>div.tab-pane").removeClass("active");
    $("div.tab-content[name='filter_sort']>div.tab-pane").eq(index).addClass("active");

    $("div.tab-content[name='content']>div.tab-pane").removeClass("active");
    $("div.tab-content[name='content']>div.tab-pane").eq(index).addClass("active");
  });
});

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

function showPopup() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
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

  if (justRemoveOther)
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
    if (current_city == "City" || current_city == null)
      current_city = use_cities[0];
    else
      thisCurCity = current_city;
  }

  let cities_options = "";
  let i;
  cities_options += "<option value = 'Other'>Other</option>";
  if (use_cities.length != 0)
    cities_options += "<option disabled>────────────────────</option>";

  for (i = 0; i < use_cities.length; i++) {
    cities_options += "<option value = '" + use_cities[i];
    if (use_cities[i] == thisCurCity)
      cities_options += "' selected>" + use_cities[i] + "</option>";
    else
      cities_options += "'>" + use_cities[i] + "</option>";
  }
  //  cities_options += "<option value = 'Other'>Other</option>";

  select_city.innerHTML = cities_options;

  createCityInput();
}

function putAddEventOptions() {
  let select_country = document.querySelector("#select_country_event");
  let select_city = document.querySelector("#select_city_event");
  let i;
  let countries_options = "";

  countries_options += "<option value = 'Other'>Other</option>";
  if (countries.length != 0)
    countries_options += "<option disabled>────────────────────</option>";
  for (i = 0; i < countries.length; i++) {
    countries_options += "<option value = '" + countries[i];
    if (countries[i] == current_country_default)
      countries_options += "' selected>" + countries[i] + "</option>";
    else
      countries_options += "'>" + countries[i] + "</option>";

  }
  //countries_options += "<option value = 'Other'>Other</option>";
  select_country.innerHTML = countries_options;



  let cities_options = "";
  cities_options += "<option value = 'Other'>Other</option>";
  if (cities_default.length != 0)
    cities_options += "<option disabled>────────────────────</option>";
  for (i = 0; i < cities_default.length; i++) {
    cities_options += "<option value = '" + cities_default[i];
    if (i == 0)
      cities_options += "' selected>" + cities_default[i] + "</option>";
    else
      cities_options += "'>" + cities_default[i] + "</option>";
  }
  //cities_options += "<option value = 'Other'>Other</option>";
  select_city.innerHTML = cities_options;


}

function createEditPostForm(event) {
  console.log(this.parentNode);
  let post_div = this.parentNode;

  // let ev_id = post_div.getAttribute("data-id");
  let route = post_div.getAttribute("data-route");

  let post_image = post_div.querySelector("#post_image");
  let post_name = post_div.querySelector("#post_name").innerText;
  let csrf = post_div.querySelector('input[name=_token');

  let textarea =
    "<textarea id='post' type='text'  class='form-control' rows='4' cols='1'" +
    "name='post' placeholder='Write something here...' required >" + post_name + "</textarea>";

  let file =
    "<label class='fileContainer mt-2'>" +
    "Upload Image" +
    "<input type='file' name='file' value='Browse' id='filePost' class='custom-file-input mt-2'>" +
    "<span class='custom-file-control form-control-file'></span>" +
    "</label>";

  let btn =
    "<button type='submit' class='btn btn-primary float-right'>" +
    "<i class='fas fa-comment fa-fw'></i> Post </button>";

  let img = "";

  if (post_image != null) {
    let image = post_image.querySelector("#img");
    img = "<div class='col-8 offset-1 mt-2' id='post_image'>" +
      "<img src='/post_images/" + image.getAttribute('img-name') + "' id='img' img-name='" + image.getAttribute('img-name') +
      "' height='200' width='300'>" +
      "</div>";
  }

  post_div.innerHTML =
    "<form action ='" + route + "' method='post' enctype='multipart/form-data'>" +
    csrf.outerHTML +
    textarea +
    img +
    file +
    btn +
    "</form>";

  addEventListeners();
}

function createEditProfileForm(event) {
  let main_div = document.querySelector("#user_info_container");

  let user_id = main_div.getAttribute("data-id");

  let img = main_div.querySelector("#user_info_img").getAttribute('src');

  let name = main_div.querySelector("#user_info_l1").innerText;

  let first_name = name.substr(0, name.indexOf(' '));
  let last_name = name.substr(name.indexOf(' ') + 1, name.size);

  let email = main_div.querySelector("#user_info_l2").innerText;

  let location = main_div.querySelector("#user_info_l3").innerText;

  let city = location.substr(0, location.indexOf(','));
  let country = location.substr(location.indexOf(',') + 2, location.size);

  let csrf = main_div.querySelector('input[name=_token');

  current_img = img;

  current_first_name = first_name;
  current_last_name = last_name;
  current_email = email;
  current_city = city;
  current_country = country; 

  

  let btn_img =

    "<label class='fileContainer'>" +
    "Upload" +
    "<input type='file' name='fileupload' value='Browse' id='fileupload' class='custom-file - input'>" +
    "<span class='custom-file-control form-control-file'></span>" +

    "</label>"

  ;

  let div1 =
    "<div class='row mb-1'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-user fa-fw '></i>" +
    "</div>" +
    "<div class='col-4 px-0 pr-3'>" +
    "<input type='text' id='input_first_name' class='form-control' name='first_name' placeholder='First name' value='" + first_name + "' required>" +
    "</div>" +
    "<div class='col-5 pl-1'>" +
    "<input type='text' id='input_last_name' class='form-control' name='last_name' placeholder='Last name' value='" + last_name + "' required>" +
    "</div>" +
    "</div>";

  let div2 =
    "<div class='row mb-1'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-envelope fa-fw '></i>" +
    "</div>" +
    "<div class='col-9 pr-3 pl-0'>" +
    "<input type='email' id='input_email' class='form-control' name='email' placeholder='Email' value='" + email + "' required>" +
    "</div>" +

    "</div>";


  let cities_options = "";
  if (cities == null)
    return;
  let i;
  cities_options += "<option value = 'Other'>Other</option>";
  if (cities.length != 0)
    cities_options += "<option disabled>────────────────────</option>";
  for (i = 0; i < cities.length; i++) {
    cities_options += "<option value = '" + cities[i];
    if (cities[i] == city)
      cities_options += "' selected>" + cities[i] + "</option>";
    else
      cities_options += "'>" + cities[i] + "</option>";
  }

  let countries_options = "";
  if (countries == null)
    return;
  countries_options += "<option value = 'Other'>Other</option>";
  if (countries.length != 0)
    countries_options += "<option disabled>────────────────────</option>";
  for (i = 0; i < countries.length; i++) {
    countries_options += "<option value = '" + countries[i];
    if (countries[i] == country)
      countries_options += "' selected>" + countries[i] + "</option>";
    else
      countries_options += "'>" + countries[i] + "</option>";

  }

  


  let div3 =
    "<div class='row'>" +
    "<div class='col-2 my-auto'>" +
    "<i class='fas fa-map-marker-alt fa-fw '></i>" +
    "</div>" +
    "<div class='col-4 pl-0'>" +
    "<select class = 'custom-select' id = 'select_city' name = 'city'>" +
    cities_options +
    "</select>" +
    "</div>" +
    "<div class='col-5 pl-1'>" +
    "<select class = 'custom-select' id = 'select_country' name = 'country'>" +
    countries_options +
    "</select>" +
    "</div>" +
    "</div>";

  let btns =
    "<div class='mt-3 row'>" +
    "<div class='col-6 d-flex justify-content-end'>" +
    "<button type='submit' class='btn btn-success btn-block' id='btn_confirm_edit_profile'><span><i class='fas fa-check fa-fw'></i> Confirm</span> </button>" +
    "</div>" +
    "<div class='col-6 d-flex justify-content-start'>" +
    "<button type='button' class='btn btn-outline-danger btn-block' id='btn_cancel_edit_profile'><span><i class='fas fa-times fa-fw'></i> Cancel</span> </button>" +
    "</div>" +
    "</div>";




  main_div.innerHTML =
    "<div style='text-align:center;'>" +
    "<img src='" + img + "' id='user_info_img' class='img img-fluid rounded mb-3'>" +
    "<form enctype='multipart/form-data' class='edit_profile' method='POST'>" +
    btn_img +

    csrf.outerHTML +
    div1 + div2 + div3 + btns +
    "</form>";

  isEditing = true;

  addEventListeners();

  createCountryInput();
  createCityInput();

}

function createEditEventForm(event) {
  let btn_edit = document.querySelector("#btn_editEvent");
  let deleteEvent = document.querySelector('#btn_deleteEvent');

  let main_div = document.querySelector("#event_data");

  let name = main_div.querySelector("#event_name").innerText;

  let date_text = main_div.querySelector("#event_date").innerText;
  let index_at = date_text.indexOf('at');
  let date = date_text.substr(0, index_at - 1);
  let time = date_text.substr(index_at + 3, date_text.size);

  let address = main_div.querySelector('#address').innerText;

  let localization = main_div.querySelector("#event_localization").innerText;

  let index_first_comma = localization.indexOf(',');
  let index_second_comma = localization.indexOf(',', index_first_comma + 1);

  let place = localization.substr(0, index_first_comma);
  let city = localization.substr(index_first_comma + 2, index_second_comma - index_first_comma - 2);
  let country = localization.substr(index_second_comma + 2, localization.size);

  let description = main_div.querySelector("#event_description").innerText;

  let category_sel = document.querySelector("#category");
  let event_category = document.querySelector("#event_category");
  let public_sel = document.querySelector("#type");
  let event_public = document.querySelector("#event_public");

  let csrf = main_div.querySelector('input[name=_token');

  current_name = name;
  current_category_id = event_category.getAttribute("data-id") - 1;
  current_category = category_sel.options[current_category_id].value;
  current_public = event_public.getAttribute("data-id");
  current_date = date;
  current_time = time;
  current_address = address;
  current_place = place;
  current_city = city;
  current_country = country;
  current_description = description; let form_name =
    "<label for='name'>Name</label>" +
    "<input type='text' id='input_name' class='form-control' name='name' placeholder='Event name' value='" + name + "' required>";

  let category_options = "";
  let i;

  for (i = 0; i < category_sel.options.length; i++) {
    category_options += "<option value = '" + category_sel.options[i].value;
    if (i == current_category_id)
      category_options += "' selected>" + category_sel.options[i].value + "</option>";
    else
      category_options += "'>" + category_sel.options[i].value + "</option>";
  }

  let event_public_options = "";

  for (i = 0; i < public_sel.options.length; i++) {
    event_public_options += "<option value = '" + public_sel.options[i].value;
    if ((current_public == "1" && i == 0) || (current_public != "1" && i == 1))
      event_public_options += "' selected>" + public_sel.options[i].value + "</option>";
    else
      event_public_options += "'>" + public_sel.options[i].value + "</option>";
  }

  let form_category_type =
    "<div class = 'row mt-3'>" +
    "<div class='col-12 col-sm-6'>" +
    "<div class='form-group mb-2 p-0 m-0' id='select_type'>" +
    "<label for='type'>Type</label>" +
    "<select class='custom-select' id='input_type' name='type'>" +
    event_public_options +
    "</select>" +
    "</div>" +
    "</div>" +
    "<div class='col-12 col-sm-6'>" +
    "<div class='form-group mb-2 p-0 m-0' id='select_category'>" +
    "<label for='category'>Category</label>" +
    "<select class='custom-select' id='input_category' name='category'>" +
    category_options +
    "</select>" +
    "</div>" +
    "</div>" +
    "</div>";

  let form_date =
    "<div class='row mt-3'>" +
    "<div class='col-6'>" +
    "<label for='date'>Date</label>" +
    "<input type='date' id='input_date' name='date' class='form-control' value='" + date + "' required>" +
    "</div>" +
    "<div class='col-6'>" +
    "<label for='time'>Time</label>" +
    "<input type='time' id='input_time' name='time' class='form-control' value='" + time + "' required>" +
    "</div>" +
    "</div>";


  let cities_options = "";

  if (cities == null) {
    return;
  }

  cities_options += "<option value = 'Other'>Other</option>";
  if (cities.length != 0)
    cities_options += "<option disabled>────────────────────</option>";
  for (i = 0; i < cities.length; i++) {
    cities_options += "<option value = '" + cities[i];
    if (cities[i] == city)
      cities_options += "' selected>" + cities[i] + "</option>";
    else
      cities_options += "'>" + cities[i] + "</option>";
  }
  //cities_options += "<option value = 'Other'>Other</option>";

  let countries_options = "";
  if (countries == null)
    return;
  countries_options += "<option value = 'Other'>Other</option>";
  if (countries.length != 0)
    countries_options += "<option disabled>────────────────────</option>";
  for (i = 0; i < countries.length; i++) {
    countries_options += "<option value = '" + countries[i];
    if (countries[i] == country)
      countries_options += "' selected>" + countries[i] + "</option>";
    else
      countries_options += "'>" + countries[i] + "</option>";

  }
  //countries_options += "<option value = 'Other'>Other</option>";


  let form_localization =
    "<div class='row mt-3'>" +
    "<div class='col-12 pb-3'>" +
    "<label for='address'>Address</label>" +
    "<input type='text' id='input_address' class='form-control' name='address' placeholder='Event address' value='" + address + "' required>" +
    "</div>" +
    "<div class='col-sm-6 col-12'>" +
    "<label for='place'>Place</label>" +
    "<input type='text' id='input_place' class='form-control' name='place' placeholder='Event place' value='" + place + "' required>" +
    "</div>" +
    "<div class='col-sm-3 col-6'>" +
    "<label for='country'>Country</label>" +
    "<select class = 'custom-select' id = 'select_country' name = 'country'>" +
    countries_options +
    "</select>" +
    "</div>" +
    "<div class='col-sm-3 col-6'>" +
    "<label for='city'>City</label>" +
    "<select class = 'custom-select' id = 'select_city' name = 'city'>" +
    cities_options +
    "</select>" +
    "</div>" +
    "</div>";

  let form_description =
    "<label for='description'>Description</label>" +
    "<textarea id='input_description' class='form-control' rows='4' cols='1' name='description' placeholder='Event description'>" + description + "</textarea>";

  let form_images =
    "<label class='imageContainer mt-3'>" +
    "Upload Images" +
    "<input type='file' name='images[]' value='Browse' id='images' multiple class='custom-file-input'>" +
    "<span class='custom-file-control form-control-file'></span>" +
    "</label>";

  let btns =
    "<div class='row mt-5'>" +
    "<div class='col-4 offset-2'>" +
    "<button type='submit' class='btn btn-success btn-block' id='btn_confirm_edit_event'><span><i class='fas fa-check fa-fw'></i> Confirm</span> </button>" +
    "</div>" +
    "<div class='col-4'>" +
    "<button type='button' class='btn btn-outline-danger btn-block' id='btn_cancel_edit_event'><span><i class='fas fa-times fa-fw'></i> Cancel</span> </button>" +
    "</div>" +
    "</div>";

  main_div.innerHTML =

    "<form enctype='multipart/form-data' class='edit_event' method='POST'>" +
    csrf.outerHTML +
    "<div class='row'>" +
    "<div class='col-12 col-lg-6'>" +
    form_name + form_category_type + form_date + form_localization +
    "</div>" +
    "<div class='col-12 col-lg-6'>" +
    form_description +
    "<div>" +
    form_images +
    "<div class='jumbotron jumbotron_image'>" +
    "<div class='row' id='image_preview'></div>" +
    "</div>" +
    "</div>" +
    "</div>" +
    "</div>" +
    btns +
    "</form>";

  isEditing = true;
  btn_edit.disabled = true;
  deleteEvent.disabled = true;

  addEventListeners();
}


//Quando faço cancel tem de ir para os valores antes de clicar em edit
//Ou seja, ao clicar em edit, guarda os valores nas variaveis que terao de ser globais
function cancelEditProfile(event) {
  let main_div = document.querySelector("#user_info_container");
  main_div.innerHTML =
    "<div style='text-align:center;'>" +
    "<img src='" + current_img + "' id='user_info_img' class='img img-fluid rounded mb-3'>" +
    document.querySelector('input[name=_token').outerHTML +
    "</div><br>" +
    "<label id='user_info_l1'><i class='fas fa-user fa-fw mr-1'></i>" + current_first_name + " " + current_last_name + "</label> <br>" +
    "<label id='user_info_l2'><i class='fas fa-envelope fa-fw mr-1'></i>" + current_email + "</label> <br>" +
    "<label id='user_info_l3'><i class='fas fa-map-marker-alt fa-fw mr-1'></i>" + current_city + ", " + current_country + "</label>" +

    "<div class='row mt-2'>" +
    "<div class='col-12 col-sm-6 col-lg-12' >" +
    "<button type='button' class='btn btn-primary btn-lg btn-block mt-3' id='btn_editprofile'>" +
    "<i class='far fa-edit fa-fw'></i> Edit Profile </button>" +
    "</div>" +
    "<div class='col-12 col-sm-6 col-lg-12 mt-2' >" +
    "<button type='button' class='btn btn-outline-danger btn-lg btn-block'>" +
    "<i class='far fa-trash-alt fa-fw'></i> Delete Profile </button>" +
    "</div>";

  isEditing = false;

  addEventListeners();
}

function cancelEditEvent(event) {
  let main_div = document.querySelector("#event_data");
  let cat = current_category_id + 1;
  main_div.innerHTML =
    document.querySelector('input[name=_token').outerHTML +
    "<span class='display-4' id='event_name'>" + current_name + "</span>" +
    "<span id='event_public' data-id=" + current_public + ">" + (current_public == "1" ? "(Public)" : "(Private)") + "</span" +
    "<br>" +
    "<div class='row mt-5'>" +
    "<div class='col-12 col-lg-5'>" +
    "<h5 id='event_date'>" +
    "<i class='fas fa-clock fa-fw' ></i>" + current_date + " at " + current_time + "</h5>" +
    "<h5 id='event_localization'>" +
    "<i class='fas fa-map-marker-alt fa-fw'></i>" + current_place + ", " + current_city + ", " + current_country + "</h5>" +
    "<h5 id='address'>" +
    current_address + "</h5>" +
    "<h5 id='event_category' data-id=" + cat + ">" +
    "Category: " + current_category + "</h5>" +
    "<br>" +
    "</div>" +
    "<div class='col - 12 col - lg - 7'>" +
    "<h1>Description</h1><br>" +
    "<p id='event_description'>" + current_description + "</p>" +
    "</div>" +
    "</div>";

  addEventListeners();

  isEditing = false;
  let btn_edit = document.querySelector("#btn_editEvent");
  btn_edit.disabled = false;
  let deleteEvent = document.querySelector('#btn_deleteEvent');
  deleteEvent.disabled = false;
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

function sendBanUserRequest() {
  let username = btns_banUser[currentUser].parentNode.parentNode.querySelector("#span_username").innerText;

  sendAjaxRequest('delete', '/api/admin/' + username, null, userBanedHandler);

}

function sendRemEventRequest() {
  let event = btns_remEvent[currentEvent].parentNode.parentNode.querySelector("#span_event_name").parentNode;

  sendAjaxRequest('delete', '/api/event/' + event.getAttribute('event_id'), null, eventRemHandler);

}

function sendAddShortcutRequest(event){
  let select_events = document.querySelector('#eventsShortcuts');
  let event_short = select_events[select_events.selectedIndex];
  let ev_id = event_short.getAttribute('data-id');
  let user_id = select_events.getAttribute('user-id');

  sendAjaxRequest('put', '/api/shortcut/', {
    event_id: ev_id,
    user_id: user_id
  }, shortcutAddedHandler);
}

function sendDeleteShortcutRequest(i) {
  console.log(i);
  console.log(btn_deleteShortcuts[i].parentNode);
  let id = btn_deleteShortcuts[i].getAttribute('shortcut-id');
  current_shortcut = i;

  sendAjaxRequest('delete', '/api/shortcut/' + id, {

    current_shortcut: current_shortcut
  }, shortcutDeletedHandler);
}


function sendAddEventRequest(event) {
  let name = document.querySelector('input[id=name]').value;
  let type = document.querySelector('#select_type select').value;
  let category = this.querySelector('#select_category select').selectedIndex + 1;
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

  let is_public;
  if (type == "Public")
    is_public = true;
  else
    is_public = false;



  if (name != '' && date != '' && city != '' && country != '' && place != '' && address != '' && description != '') {
    sendAjaxRequest('post', '/api/add_event', {
      name: name,
      is_public: is_public,
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
  if(country == "Country")
    country = "Other";

  sendAjaxRequest('get', '/cities/' + country, null, getCitiesHandler);
}

function sendEditEventRequest(event) {
  let id = this.closest('div').getAttribute('data-id');
  let name = this.querySelector('input[id=input_name]').value;
  let type = document.querySelector('#input_type').options[document.querySelector('#input_type').selectedIndex].value;
  let category = document.querySelector('#input_category').selectedIndex + 1;
  let date = this.querySelector('input[id=input_date]').value;
  let time = this.querySelector('input[id=input_time]').value;
  let place = this.querySelector('input[id=input_place]').value;
  let address = this.querySelector('input[id=input_address').value;
  let city = this.querySelector('select[id=select_city]').selectedOptions[0].value;
  let country = this.querySelector('select[id=select_country]').selectedOptions[0].value;
  let description = document.querySelector('textarea[id=input_description').value;

  console.log(type);



  if (city == "Other")
    city = this.querySelector('input[id=input_city]').value;

  if (country == "Other")
    country = this.querySelector('input[id=input_country]').value;

  let is_public;
  if (type == "Public")
    is_public = true;
  else
    is_public = false;

  console.log(is_public);



  sendAjaxRequest('post', '/api/event/' + id, {
    name: name,
    is_public: is_public,
    category: category,
    date: date,
    time: time,
    place: place,
    address: address,
    city: city,
    country: country,
    description: description
  }, eventEditedHandler);

  event.preventDefault();
}



function deleteProfileRequest(event) {
  let id = this.closest('div').parentNode.parentNode.getAttribute('data-id');
  console.log(id);

  sendAjaxRequest('delete', '/api/profile/' + id, null, profileDeletedHandler);
  event.preventDefault();
}

function deleteEventRequest(event) {
  let id = document.querySelector("#event_data").getAttribute('data-id');

  sendAjaxRequest('delete', '/api/event/' + id, null, eventDeletedHandler);
  event.preventDefault();
}

function sendCancelParticipationRequest(event) {
  let event_id = this.getAttribute('event-id');
  let user_id = this.getAttribute('user-id');

  sendAjaxRequest('delete', '/api/participant/', {
    event_id: event_id,
    user_id: user_id
  }, participationHandler);

  event.preventDefault();

}

function sendAddParticipationRequest(event) {
  let event_id = this.getAttribute('event-id');
  let user_id = this.getAttribute('user-id');

  sendAjaxRequest('post', '/api/participant/', {
    event_id: event_id,
    user_id: user_id
  }, participationHandler);

  event.preventDefault();
}

function sendAddFriendRequest(event) {
  let sender = this.getAttribute('sender-id');
  let receiver = this.getAttribute('receiver-id');

  sendAjaxRequest('put', '/api/friend_request/', {
    sender: sender,
    receiver: receiver
  }, friendRequestedHandler);

  event.preventDefault();
}

function sendRemoveFriendRequest(event) {
  let user1 = this.getAttribute('user-id-1');
  let user2 = this.getAttribute('user-id-2');

  sendAjaxRequest('delete', '/api/friendship/', {
    user1: user1,
    user2: user2
  }, friendRemovedHandler);

  event.preventDefault();
}

function sendAcceptEventInviteRequest(event) {
  let event_id = this.getAttribute('event-id');
  let receiver = this.getAttribute('receiver-id');

  let answer = true;



  sendAjaxRequest('post', '/api/invite/', {
    event_id: event_id,
    receiver: receiver,
    answer: answer
  }, acceptedInviteHandler);
}

function sendDeclineEventInviteRequest(event) {
  let event_id = this.getAttribute('event-id');
  let receiver = this.getAttribute('receiver-id');

  let answer = false;

  sendAjaxRequest('post', '/api/invite/', {
    event_id: event_id,
    receiver: receiver,
    answer: answer
  }, declinedInviteHandler);
}

function sendAcceptFriendRequest(event) {
  let sender = this.getAttribute('sender-id');
  let receiver = this.getAttribute('receiver-id');

  let answer = true;



  sendAjaxRequest('post', '/api/friend_request/', {
    sender: sender,
    receiver: receiver,
    answer: answer
  }, acceptedFriendHandler);
}

function sendDeclineFriendRequest(event) {
  let sender = this.getAttribute('sender-id');
  let receiver = this.getAttribute('receiver-id');

  let answer = false;

  sendAjaxRequest('post', '/api/friend_request/', {
    sender: sender,
    receiver: receiver,
    answer: answer
  }, declinedFriendHandler);
}

function sendStarRateRequest(event) {
  let event_id = this.parentNode.getAttribute('event-id');
  let user = this.parentNode.getAttribute('user-id');
  let value = this.parentNode.getAttribute('data-id');
  let new_value = this.getAttribute('value');


  if (value == "null") {
    sendAjaxRequest('put', '/api/rating/', {
      event_id: event_id,
      user_id: user,
      new_value: new_value
    }, starRatedHandler);
  } else {
    sendAjaxRequest('post', '/api/rating/', {
      event_id: event_id,
      user_id: user,
      new_value: new_value
    }, starRatedHandler);
  }

}

function sendMarkNotUpdAsSeenRequest(i) {
  let id = btns_markAsSeen_notUpd[i].parentNode.getAttribute('data-id');
  current_not = i;

  sendAjaxRequest('delete', '/api/event_update_warning/' + id, {
    current_not: current_not
  }, notificationEventUpdateDeleted);
}

function sendMarkNotDelAsSeenRequest(i) {
  let id = btns_markAsSeen_notDel[i].parentNode.getAttribute('data-id');
  current_not = i;

  sendAjaxRequest('delete', '/api/event_delete_warning/' + id, {
    current_not: current_not
  }, notificationEventDeleteDeleted);
}

function sendRemoveParticipantRequest() {

  let event_id = btns_removeParticipant[currentParticipant].getAttribute('event-id');
  let user_id = btns_removeParticipant[currentParticipant].getAttribute('user-id');

  sendAjaxRequest('delete', '/api/participant/', {
    event_id: event_id,
    user_id: user_id
  }, participationHandler);

}


function sendMakeInviteRequest(i) {
  let event_id = btns_makeInvite[i].getAttribute('event-id');
  let sender = btns_makeInvite[i].getAttribute('sender-id');
  let receiver = btns_makeInvite[i].getAttribute('receiver-id');

  currentInvite = i;

  sendAjaxRequest('put', '/api/invite/', {
    event_id: event_id,
    receiver: receiver,
    sender: sender,
    currentInvite: currentInvite
  }, madeInviteHandler);

}

function sendCancelInviteRequest(i) {
  let event_id = btns_cancelInvite[i].getAttribute('event-id');
  let sender = btns_cancelInvite[i].getAttribute('sender-id');
  let receiver = btns_cancelInvite[i].getAttribute('receiver-id');

  currentInvite = i;

  sendAjaxRequest('delete', '/api/invite/', {
    event_id: event_id,
    receiver: receiver,
    sender: sender,
    currentInvite: currentInvite
  }, canceledInviteHandler);

}

function shortcutAddedHandler(){
  console.log(this.responseText);
  let response = JSON.parse(this.responseText);
  let message = response['message'];
  if (message == "success") {
    for (let i = 0; i < btn_deleteShortcuts.length; i++) {
      btn_deleteShortcuts[i].removeEventListener('click', deleteShortctus[i]);
    }
    let event_name = response['event_name'];
    let event_id = response['event_id'];
    let shortcut_id = response['id'];
    let row = document.querySelector("#list_shortcuts");
    let div = document.createElement("div");
    let select_events = document.querySelector('#eventsShortcuts');
    select_events.remove(select_events.selectedIndex);
    div.classList.add("col-12");
    div.classList.add("col-lg-6");
    div.classList.add("mb-4");

    div.innerHTML =
      "<div class='row'>"+
                "<div class='col-md-6 col-6'>"+
                  "<a href='/events/'" + event_id + "' class='text-white'>" +
                    "<span>" + event_name + "</span>"+
                  "</a>"+
                "</div>"+
                
                "<div class='col-md-6 col-6 d-flex align-items-center'>"+
                  "<button type='button' class='btn btn-outline-danger btn-sm' title='Delete Shortcut' id='btn_deleteShortcut'" +
                  "shortcut-id='" + shortcut_id + "'>"+
                  "<i class='fas fa-times' ></i><span> Delete</span>"+
                "</button>"+
              "</div>";
    row.appendChild(div);

    let list_shortcuts = document.querySelector("#homepage_list_shortcuts");
    let a = document.createElement("a");
    a.innerHTML = 
      "<a href='/events/'" + event_id + "' class='text-white mb-2' data-id='" + shortcut_id +"'>" + event_name + "</a>";

    list_shortcuts.appendChild(a);

    btn_deleteShortcuts = document.querySelectorAll('#btn_deleteShortcut');
    deleteShortctus = new Array();
    for (let i = 0; i < btn_deleteShortcuts.length; i++) {
      deleteShortctus.push(sendDeleteShortcutRequest.bind(sendDeleteShortcutRequest, i));
      btn_deleteShortcuts[i].addEventListener('click', deleteShortctus[i]);
    }

    let no_short = list_shortcuts.parentNode.querySelector("#no_shortcuts");

    if (no_short != null)
      no_short.remove();
        
  }else{
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
    message.forEach(element => {
      errors.innerHTML += "<li>" + element + "</li>";
    });
    errors.innerHTML += "</ul>";
    content.insertBefore(errors, content.firstChild);
  }

}

function shortcutDeletedHandler(){
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    for (let i = 0; i < btn_deleteShortcuts.length; i++) {
      btn_deleteShortcuts[i].removeEventListener('click', deleteShortctus[i]);
    }
    let cur = response['current_shortcut'];
    btn_deleteShortcuts[cur].parentNode.parentNode.parentNode.remove();
    let event_name = response['event_name'];
    let event_id = response['event_id'];
    let shortcut_id = response['id'];
   let select_events = document.querySelector('#eventsShortcuts');
   let option = document.createElement("option");
   option.value = event_name;
   option.setAttribute('data-id', event_id);
   option.innerHTML = event_name;
   select_events.appendChild(option);
    btn_deleteShortcuts = document.querySelectorAll('#btn_deleteShortcut');
    deleteShortctus = new Array();
    for (let i = 0; i < btn_deleteShortcuts.length; i++) {
      deleteShortctus.push(sendDeleteShortcutRequest.bind(sendDeleteShortcutRequest, i));
      btn_deleteShortcuts[i].addEventListener('click', deleteShortctus[i]);
    }

    let list_shortcuts = document.querySelector("#homepage_list_shortcuts");
    
    let a = list_shortcuts.querySelector('a[data-id="'+shortcut_id+'"]');
    a.remove();

   
    if (btn_deleteShortcuts.length == 0){
       let span = document.createElement("span");
       span.id = "no_shortcuts";
       span.innerHTML = "No shortcuts";
       list_shortcuts.parentNode.insertBefore(span, list_shortcuts.parentNode.firstChild);
    }

    
  }

}



function getCitiesHandler() {
  console.log(this.responseText);
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
}

function getCountriesHandler() {
  console.log(this.responseText);
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

function userBanedHandler() {
  let message = JSON.parse(this.responseText)['message'];
  if (message == "success") {
    btns_banUser[currentUser].parentNode.parentNode.remove();
  }
}

function eventRemHandler() {
  let message = JSON.parse(this.responseText)['message'];
  if (message == "success") {
    btns_remEvent[currentEvent].parentNode.parentNode.remove();
  }
}

function starRatedHandler() {
  console.log(this.responseText);
  let message = JSON.parse(this.responseText)['message'];
  if (message == "success") {
    let avg = JSON.parse(this.responseText)['avg'];
    let vote = JSON.parse(this.responseText)['vote'];
    document.querySelector("#avg_rating").innerText = "Avg rating is " + avg + " / 5 ";
    document.querySelector("#star_rating").setAttribute("data-id", avg);
  }
}




function notificationEventUpdateDeleted() {
  let message = JSON.parse(this.responseText)['message'];
  if (message == 'success') {
    let cur = JSON.parse(this.responseText)['current_not']
    let par = btns_markAsSeen_notUpd[cur].parentNode.parentNode;
    btns_markAsSeen_notUpd[cur].parentNode.remove();

    if (btns_markAsSeen_notUpd.length == 1) {
      let span = document.createElement("span");

      span.classList.add("dropdown-item");
      span.innerHTML = "No notifications";
      par.appendChild(span);
    }
  }

  addEventListeners();
}

function notificationEventDeleteDeleted() {
  let message = JSON.parse(this.responseText)['message'];
  if (message == 'success') {
    let cur = JSON.parse(this.responseText)['current_not']
    let par = btns_markAsSeen_notDel[cur].parentNode.parentNode;
    btns_markAsSeen_notDel[cur].parentNode.remove();

    if (btns_markAsSeen_notDel.length == 1) {
      let span = document.createElement("span");

      span.classList.add("dropdown-item");
      span.innerHTML = "No notifications";
      par.appendChild(span);
    }
  }

  addEventListeners();
}


function eventEditedHandler() {
  console.log(this.responseText);
  let message = JSON.parse(this.responseText)['message'];
  let event;
  if (message == 'success') {
    event = JSON.parse(this.responseText)['event'];
    city = JSON.parse(this.responseText)['city'];
    country = JSON.parse(this.responseText)['country'];
    localization = JSON.parse(this.responseText)['localization'];
    category = JSON.parse(this.responseText)['category'];
    updateEvent(event, city, country, localization, category);

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
    message.forEach(element => {
      errors.innerHTML += "<li>" + element + "</li>";
    });
    errors.innerHTML += "</ul>";
    content.insertBefore(errors, content.firstChild);
  }
  cities = null;
  addEventListeners();

}

function profileDeletedHandler() {
  console.log(this.responseText);
  if (this.status == 200) window.location = '/';
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

function participationHandler() {
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let id = response['id'];
    window.location = '/events/' + id;
  }

}

function acceptedInviteHandler() {
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let id = response['id'];
    window.location = '/events/' + id;
  }

}

function declinedInviteHandler() {
  console.log(this.responseText);
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let id = response['id'];
    window.location = '/events/' + id;
  }

}

function acceptedFriendHandler() {
  console.log(this.responseText);
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let id = response['id'];
    window.location = '/profile/' + id;
  }

}

function declinedFriendHandler() {
  console.log(this.responseText);
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let id = response['id'];
    window.location = '/profile/' + id;
  }

}


function friendRequestedHandler() {
  console.log(this.responseText);
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let id = response['id'];
    window.location = '/profile/' + id;
  }

}

function friendRemovedHandler() {
  console.log(this.responseText);
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let id = response['id'];
    window.location = '/profile/' + id;
  }
}

function madeInviteHandler() {
  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let curIn = response['currentInvite'];
    for (let i = 0; i < btns_cancelInvite.length; i++) {
      btns_cancelInvite[i].removeEventListener('click', cancelInvite[i]);
    }
    let clone = btns_makeInvite[curIn].cloneNode(true);
    btns_makeInvite[curIn].parentNode.appendChild(clone);
    btns_makeInvite[curIn].remove();
    while (clone.firstChild) {
      clone.removeChild(clone.firstChild);
    }
    let span = document.createElement('span');
    let label = document.createElement('i');
    label.classList.add("fas");
    label.classList.add("fa-times");
    span.textContent = " Cancel";
    clone.appendChild(label);
    clone.appendChild(span);

    clone.classList.remove("btn-success");
    clone.classList.add("btn-outline-danger");

    clone.id = "btn_cancelInvite";

    btns_cancelInvite = document.querySelectorAll('#btn_cancelInvite');
    cancelInvite = new Array();
    for (let i = 0; i < btns_cancelInvite.length; i++) {
      cancelInvite.push(sendCancelInviteRequest.bind(sendCancelInviteRequest, i));
      btns_cancelInvite[i].addEventListener('click', cancelInvite[i]);
    }


  }
}

function canceledInviteHandler() {

  let response = JSON.parse(this.responseText);
  if (response['message'] == 'success') {
    let curIn = response['currentInvite'];
    for (let i = 0; i < btns_makeInvite.length; i++) {
      btns_makeInvite[i].removeEventListener('click', makeInvite[i]);
    }
    let clone = btns_cancelInvite[curIn].cloneNode(true);
    btns_cancelInvite[curIn].parentNode.appendChild(clone);
    btns_cancelInvite[curIn].remove();
    while (clone.firstChild) {
      clone.removeChild(clone.firstChild);
    }
    let span = document.createElement('span');
    let label = document.createElement('i');
    label.classList.add("fas");
    label.classList.add("fa-plus");
    span.textContent = " Invite";
    clone.appendChild(label);
    clone.appendChild(span);

    clone.classList.remove("btn-outline-danger");
    clone.classList.add("btn-success");

    clone.id = "btn_inviteToEvent";
    btns_makeInvite = document.querySelectorAll('#btn_inviteToEvent');
    makeInvite = new Array();
    for (let i = 0; i < btns_makeInvite.length; i++) {
      makeInvite.push(sendMakeInviteRequest.bind(sendMakeInviteRequest, i));
      btns_makeInvite[i].addEventListener('click', makeInvite[i]);
    }


  }

}


// function updateProfile(profile, city, country) {
//   let main_div = document.querySelector("#user_info_container");

//   let img = document.querySelector("#img_nav_profile");

//   img.src = "/imgs/" + profile.image_path;

//   main_div.innerHTML =
//     "<div style='text-align:center;'>"+
//     "<img src='/imgs/" + profile.image_path + "' id='user_info_img' class='img img-fluid rounded mb-3'>"+
//     "</div><br>" +
//     "<label id='user_info_l1'><i class='fas fa-user fa-fw mr-1'></i>" + profile.first_name + " " + profile.last_name + "</label><br>" +
//     "<label id='user_info_l2'><i class='fas fa-envelope fa-fw mr-1'></i>" + profile.email + "</label><br>" +
//     "<label id='user_info_l3'><i class='fas fa-map-marker-alt fa-fw mr-1'></i>" + city + ", " + country + "</label>" +

//     "<div class='row mt-2'>"+
//     "<div class='col-12 col-sm-6 col-lg-12' >"+
//     "<button type='button' class='btn btn-primary btn-lg btn-block mt-3' id='btn_editprofile'>" +
//     "<i class='far fa-edit fa-fw'></i> Edit Profile </button>" +
//     "</div>"+
//     "<div class='col-12 col-sm-6 col-lg-12 mt-2' >" +
//     "<button type='button' class='btn btn-outline-danger btn-lg btn-block'>" +
//     "<i class='far fa-trash-alt fa-fw'></i> Delete Profile </button>"+
//     "</div>";

//   isEditing = false;

//   addEventListeners();
// }

function updateEvent(event, city, country, localization, category) {
  let main_div = document.querySelector("#event_data");
  let parent = main_div.parentElement;
  let btn_edit = parent.querySelector("#btn_editEvent");
  btn_edit.disabled = false;
  let deleteEvent = document.querySelector('#btn_deleteEvent');
  deleteEvent.disabled = false;

  console.log(event.is_public);

  main_div.innerHTML =
    "<span class='display-4' id='event_name'>" + event.name + "</span>" +
    "<span id='event_public' data-id=" + event.is_public + ">" + (event.is_public == "true" ? "(Public)" : "(Private)") + "</span" +
    "<br>" +
    "<div class='row mt-5'>" +
    "<div class='col-12 col-lg-5'>" +
    "<h5 id='event_date'>" +
    "<i class='fas fa-clock fa-fw' ></i>" + event.date + " at " + event.time + "</h5>" +
    "<h5 id='event_localization'>" +
    "<i class='fas fa-map-marker-alt fa-fw'></i>" + localization.name + ", " + city + ", " + country + "</h5>" +
    "<h5 id='address'>" +
    localization.address + "</h5>" +
    "<h5 id='event_category' data-id=" + event.category_id + ">" +
    "Category: " + category + "</h5>" +
    "<br>" +
    "</div>" +
    "<div class='col-12 col-lg-7'>" +
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