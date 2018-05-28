

<div class="modal fade" id="add_event">
 <div class="modal-dialog modal-dialog-centered modal-md">
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">New Event</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
  </div>
  <div class="modal-body ">
    <form class="add_event" id="form_add_event">
     <label for="name">Name</label>
     <div class="input-group mb-2">
      <div class="input-group-prepend">
       <span class="input-group-text">
         <i class="fas fa-pencil-alt fa-fw"></i>
       </span>
     </div>
     <input id="name" type="text" name="name" placeholder="Event Name" class="form-control" required autofocus>
     <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
      <div class="popup">
        <span class="popuptext" id="help">Insert an event name with 1 to 30 chars</span>
      </div>
      <i class="fas fa-info-circle fa-lg"></i>
    </button>
    
    
  </div>
  
  <div class="row">
    <div class="col-12 col-sm-6">
     <div class="form-group mb-2 p-0 m-0" id="select_type">
      <label for="type">Type</label>
      <select class="custom-select" id="type" name="select_type">
       <option value="Public" selected>Public</option>
       <option value="Private">Private</option>
     </select>
     <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
      <div class="popup">
        <span class="popuptext" id="help">Select the type of event</span>
      </div>
      <i class="fas fa-info-circle fa-lg"></i>
    </button>
  </div>
</div>
<div class="col-12 col-sm-6">
 <div class="form-group mb-2 p-0 m-0" id="select_category">
  <label for="category">Category</label>
  <select class="custom-select" id="category" name="select_category">
   @foreach($categories as $cat)
   <option value="{{ $cat->name }}">{{ $cat->name }}</option>
   @endforeach
 </select>
 <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
  <div class="popup">
    <span class="popuptext" id="help">Select the type of category</span>
  </div>
  <i class="fas fa-info-circle fa-lg"></i>
</button>
</div>
</div>
</div>
<div class="row">
  <div class="col-12 col-sm-6">
    <label for="date">Date</label>
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="fas fa-calendar-alt fa-fw"></i>
        </span>
      </div>
      <input class="form-control" id="date" type="date" name="date" required>
      <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
        <div class="popup">
          <span class="popuptext" id="help">Insert a date greater than today</span>
        </div>
        <i class="fas fa-info-circle fa-lg"></i>
      </button>
    </div>
  </div>
  <div class="col-12 col-sm-6">
    <label for="date">Time</label>
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="fas fa-calendar-alt fa-fw"></i>
        </span>
      </div>
      <input class="form-control" id="time" type="time" name="time" required>
      <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
        <div class="popup">
          <span class="popuptext" id="help">Insert a date</span>
        </div>
        <i class="fas fa-info-circle fa-lg"></i>
      </button>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-sm-6">
   <label for="country">Country</label>
   <div class="input-group mb-2 p-0 m-0">
    <div class="input-group-prepend">
     <span class="input-group-text">
       <i class="fas fa-map-marker-alt fa-fw"></i>
     </span>
   </div>
   <select class = 'custom-select' id = 'select_country_event' name = 'country'></select>
   <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
    <div class="popup">
      <span class="popuptext" id="help">Select a country. If other was chosen input a new country</span>
    </div>
    <i class="fas fa-info-circle fa-lg"></i>
  </button>
  
</div>

</div>
<div class="col-12 col-sm-6">
 <label for="city">City</label>
 <div class="input-group mb-2">
  <div class="input-group-prepend">
   <span class="input-group-text">
     <i class="fas fa-map-marker-alt fa-fw"></i>
   </span>
 </div>
 <select class = 'custom-select' id = 'select_city_event' name = 'city'></select>
 <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
  <div class="popup">
    <span class="popuptext" id="help">Select a city. If other was chosen input a new city</span>
  </div>
  <i class="fas fa-info-circle fa-lg"></i>
</button>
</div>


</div>
</div>
<div class="row">
  <div class="col-12">
   <label for="place">Place</label>
   <div class="input-group mb-2">
    <div class="input-group-prepend">
     <span class="input-group-text">
       <i class="fas fa-map-marker-alt fa-fw"></i>
     </span>
   </div>
   <input class="form-control" id="place" type="text" name="place" placeholder="Enter place" required>
   <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
    <div class="popup">
      <span class="popuptext" id="help">Insert a place with 1 to 30 chars</span>
    </div>
    <i class="fas fa-info-circle fa-lg"></i>
  </button>
</div>
</div>
<div class="col-12">
 <label for="address">Address</label>
 <div class="input-group mb-2">
  <div class="input-group-prepend">
   <span class="input-group-text">
     <i class="fas fa-map-marker-alt fa-fw"></i>
   </span>
 </div>
 <input class="form-control" id="address" type="text" name="address" placeholder="Enter address" required>
 <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
  <div class="popup">
    <span class="popuptext" id="help">Insert an address with 1 to 50 chars</span>
  </div>
  <i class="fas fa-info-circle fa-lg"></i>
</button>
</div>
</div>
</div>
<label for="description">Description</label>
<div class="input-group mb-2">
  <textarea id="description" class="form-control" rows="4" cols="1" name="description" placeholder="Enter Description" required></textarea>
  <button type="button" id="btn_addEventHelp" class="btn btn-secondary" title="Help">
    <div class="popup">
      <span class="popuptext" id="help">Insert a description</span>
    </div>
    <i class="fas fa-info-circle fa-lg"></i>
  </button>
</div>
<hr>
<button type="submit" class="btn btn-block btn-success mb-1" >Add Event</button>
</form>
</div>
</div>
</div>
</div>

