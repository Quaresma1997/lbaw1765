function addEventListeners() {
  let itemCheckers = document.querySelectorAll('article.card li.item input[type=checkbox]');
  [].forEach.call(itemCheckers, function(checker) {
    checker.addEventListener('change', sendItemUpdateRequest);
  });

  let itemCreators = document.querySelectorAll('article.card form.new_item');
  [].forEach.call(itemCreators, function(creator) {
    creator.addEventListener('submit', sendCreateItemRequest);
  });

  let itemDeleters = document.querySelectorAll('article.card li a.delete');
  [].forEach.call(itemDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteItemRequest);
  });

  let cardDeleters = document.querySelectorAll('article.card header a.delete');
  [].forEach.call(cardDeleters, function(deleter) {
    deleter.addEventListener('click', sendDeleteCardRequest);
  });

  let cardCreator = document.querySelector('article.card form.new_card');
  if (cardCreator != null)
    cardCreator.addEventListener('submit', sendCreateCardRequest);

  let editProfile = document.querySelector('#btn_editprofile');
  if (editProfile != null)
  editProfile.addEventListener('click', createEditProfileForm);

  let deleteProfile = document.querySelector('#btn_deleteprofile');
  if (deleteProfile != null)
  deleteProfile.addEventListener('click', deleteProfileRequest);

  let editProfileConfirm = document.querySelector('form.edit_profile');
  if (editProfileConfirm != null)
  editProfileConfirm.addEventListener('submit', sendEditProfileRequest);

  let editProfileCancel = document.querySelector('form.edit_profile #btn_cancel_edit_profile');
  if (editProfileCancel != null)
  editProfileCancel.addEventListener('click', cancelEditProfile);

  let addEvent = document.querySelector('form.add_event');
  if (addEvent != null)
  addEvent.addEventListener('submit', sendAddEventRequest);

  let deleteEvent = document.querySelector('#btn_deleteEvent');
  if (deleteEvent != null)
  deleteEvent.addEventListener('click', deleteEventRequest);

  
}

let current_first_name, current_last_name, current_email, current_city, current_country;




$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});

function createEditProfileForm(event){
  let main_div =  document.querySelector("#user_info_container");

  let img = main_div.querySelector("#user_info_img");

  let name = main_div.querySelector("#user_info_l1").innerText;

  let first_name = name.substr(0, name.indexOf(' '));
  let last_name = name.substr(name.indexOf(' ') + 1, name.size);

  let email = main_div.querySelector("#user_info_l2").innerText;

  let location = main_div.querySelector("#user_info_l3").innerText;

  let city = location.substr(0, location.indexOf(','));
  let country = location.substr(location.indexOf(',') + 2, location.size);

  current_first_name = first_name;
  current_last_name = last_name;
  current_email = email;
  current_city = city;
  current_country = country;

  let btn_img =
    "<form action='myform.cgi'>" +
    "<input type='file' name='fileupload' value='Browse' id='fileupload' class='custom-file - input'>" +
    "<span class='custom-file-control form-control-file'></span>"+
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
    "<button type='submit' class='btn btn-success btn-block' id='btn_confirm_edit_profile'><span><i class='fas fa-check fa-fw'></i> Confirm</span> </button>" +

    "<button type='button' class='btn btn-outline-danger btn-block' id='btn_cancel_edit_profile'><span><i class='fas fa-times fa-fw'></i> Cancel</span> </button>" +
    "</div>"
    ;


  main_div.innerHTML =

    "<img src='{{url(/imgs/profile.jpg)}}' id='user_info_img' class='img img-fluid rounded mb-3'>" +
    btn_img +
    "<form class='edit_profile'>" + 
    div1 + div2 + div3 + btns
    + "</form>";

      addEventListeners();
  
}


//Quando faço cancel tem de ir para os valores antes de clicar em edit
//Ou seja, ao clicar em edit, guarda os valores nas variaveis que terao de ser globais
function cancelEditProfile(event){
  let main_div =  document.querySelector("#user_info_container");

  // let img = document.querySelector("form.edit_profile #user_info_img");

  // let first_name = document.querySelector("form.edit_profile #input_first_name").value;
  // let last_name = document.querySelector("form.edit_profile #input_last_name").value;

  // let email = document.querySelector("form.edit_profile #input_email").value;

  // let city = document.querySelector("form.edit_profile #input_city").value;
  // let country = document.querySelector("form.edit_profile #input_country").value;

  main_div.innerHTML = 
    "<img src='{{url(/imgs/profile.jpg)}}' id='user_info_img' class='img img-fluid rounded mb-3'>" +
    "<label id='user_info_l1'><i class='fas fa-user fa-fw'></i>" + current_first_name + " " + current_last_name + "</label>" +
    "<label id='user_info_l2'><i class='fas fa-envelope fa-fw'></i>" + current_email + "</label>" +
    "<label id='user_info_l3'><i class='fas fa-map-marker-alt fa-fw'></i>" + current_city + ", " + current_country + "</label>" +

    "<button type='button' class='btn btn-primary btn-lg btn-block mt-3' id='btn_editprofile'>" +
    "<i class='far fa-edit fa-fw'></i> Edit Profile </button>" +
    "<button type='button' class='btn btn-outline-danger btn-lg btn-block'>" +
    "<i class='far fa-trash-alt fa-fw'></i> Delete Profile </button>";

    addEventListeners();
}


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


function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k){
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

  sendAjaxRequest('post', '/api/item/' + id, {done: checked}, itemUpdatedHandler);
}

function sendDeleteItemRequest() {
  let id = this.closest('li.item').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/item/' + id, null, itemDeletedHandler);
}

function sendCreateItemRequest(event) {
  let id = this.closest('article').getAttribute('data-id');
  let description = this.querySelector('input[name=description]').value;

  if (description != '')
    sendAjaxRequest('put', '/api/cards/' + id, {description: description}, itemAddedHandler);

  event.preventDefault();
}

function sendDeleteCardRequest(event) {
  let id = this.closest('article').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/cards/' + id, null, cardDeletedHandler);
}

function sendCreateCardRequest(event) {
  let name = this.querySelector('input[name=name]').value;

  if (name != '')
    sendAjaxRequest('put', '/api/cards/', {name: name}, cardAddedHandler);

  event.preventDefault();
}

function sendAddEventRequest(event){
  let name = document.querySelector('input[id=name').value;
  let type = document.querySelector('#select_type select').value;
  let category = this.querySelector('#select_category select').value;
  let date = this.querySelector('input[id=date').value;
  let city = this.querySelector('input[id=city]').value;
  let country = this.querySelector('input[id=country]').value;
  let place = this.querySelector('input[id=place]').value;
  let address = this.querySelector('input[id=address]').value;
  let description = this.querySelector('#description').value;
  

  if (name != '' && date != '' && city != '' && country != '' && place != '' && address != '' && description != '' ){
    sendAjaxRequest('post', '/api/add_event', {
      name: name,
      type: type,
      category: category,
      date: date,
      city: city,
      country: country,
      place: place,
      address: address,
      description: description
    }, eventAddedHandler);
    console.log("AAA");
  }
  event.preventDefault();
}

function sendEditProfileRequest(event) {
  let id = this.closest('div').getAttribute('data-id');
  let first_name = this.querySelector('input[id=input_first_name]').value;
  let last_name = this.querySelector('input[id=input_last_name]').value;
  let email = this.querySelector('input[id=input_email]').value;
  let city = this.querySelector('input[id=input_city]').value;
  let country = this.querySelector('input[id=input_country]').value;
  
  

  if (first_name != '' && last_name != '' && email != '' && city != '' && country != '')
    sendAjaxRequest('post', '/api/profile/' + id, 
      {first_name: first_name, 
        last_name: last_name, 
        email: email, 
        city: city, 
        country: country}, profileEditedHandler);

  event.preventDefault();
}

function deleteProfileRequest(event){
  let id = this.closest('div').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/profile/' + id, null, profileDeletedHandler);
}

function deleteEventRequest(event){
  let id = this.closest('div').getAttribute('data-id');

  sendAjaxRequest('delete', '/api/event/' + id, null, eventDeletedHandler(id));
}

function profileEditedHandler() {
  let message = JSON.parse(this.responseText)['message'];
  let profile;
  if(message == 'success'){
    profile = JSON.parse(this.responseText)['user'];
    city = JSON.parse(this.responseText)['city'];
    country = JSON.parse(this.responseText)['country'];
    updateProfile(profile, city, country);
  }

}

function profileDeletedHandler(){
  
  if (this.status != 200) window.location = '/';
}

function eventDeletedHandler(id){
  if (this.status != 200) window.location = '/events/' + id;
}

function updateProfile(profile, city, country){
  let main_div = document.querySelector("#user_info_container");

  let img = document.querySelector("#user_info_img");

  main_div.innerHTML =

    "<img src='{{url(/imgs/profile.jpg)}}' id='user_info_img' class='img img-fluid rounded mb-3'><br>" +
    "<label id='user_info_l1'><i class='fas fa-user fa-fw mr-1'></i>" + profile.first_name + " " + profile.last_name + "</label><br>" +
    "<label id='user_info_l2'><i class='fas fa-envelope fa-fw mr-1'></i>" + profile.email + "</label><br>" +
    "<label id='user_info_l3'><i class='fas fa-map-marker-alt fa-fw mr-1'></i>" + city + ", " + country + "</label>" +

    "<button type='button' class='btn btn-primary btn-lg btn-block mt-3' id='btn_editprofile'>" +
    "<i class='far fa-edit fa-fw'></i> Edit Profile </button>" +
    "<button type='button' class='btn btn-outline-danger btn-lg btn-block'>" +
    "<i class='far fa-trash-alt fa-fw'></i> Delete Profile </button>"
  ;

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
  form.querySelector('[type=text]').value="";
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
  let article = document.querySelector('article.card[data-id="'+ card.id + '"]');
  article.remove();
}

function cardAddedHandler() {
  if (this.status != 200) window.location = '/';
  let card = JSON.parse(this.responseText);

  // Create the new card
  let new_card = createCard(card);

  // Reset the new card input
  let form = document.querySelector('article.card form.new_card');
  form.querySelector('[type=text]').value="";

  // Insert the new card
  let article = form.parentElement;
  let section = article.parentElement;
  section.insertBefore(new_card, article);

  // Focus on adding an item to the new card
  new_card.querySelector('[type=text]').focus();
}

function eventAddedHandler(){
  if (this.status != 200) window.location = '/';
  let response = JSON.parse(this.responseText);
  if(response['message'] == 'success'){
    window.location = '/';
    console.log("AAAA");
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

addEventListeners();
