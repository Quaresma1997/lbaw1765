

<div class="modal fade" id="add_event">
 <div class="modal-dialog modal-dialog-centered modal-md">
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">New Event</h4>
    <div class="popup" onclick="showPopup()">
    <i class="fas fa-info-circle"></i>
      <span class="popuptext" id="myPopup">
      Name: Length between 1 and 30
      <br>
      Type: Public (anyone can join) or Private (invite needed to join)
      <br>
      Category: Helps people finding the event
      <br>
      Date: Must be a future date
      <br>
      Time: When the event starts
      <br>
      Country: Select "Other" if your option isn't in the list
      <br>
      City: Select "Other" if your option isn't in the list
      <br>
      Place: Length between 1 and 50
      <br>
      Address: Length between 1 and 50
      <br>
      Description: Informs people about the details of the event
      </span>
    </div>
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
     <input id="name" type="text" name="name" placeholder="Event Name" class="form-control" value="{{ old('name') }}" required autofocus>
     
    
    
  </div>
  
  <div class="row">
    <div class="col-12 col-sm-6">
     <div class="form-group mb-2 p-0 m-0" id="select_type">
      <label for="type">Type</label>
      <select class="custom-select" id="type" name="select_type">
       <option value="Public" selected>Public</option>
       <option value="Private">Private</option>
     </select>
  
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
  
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12 col-sm-6">
   <label for="select_country_event">Country</label>
   <div class="input-group mb-2 p-0 m-0">
    <div class="input-group-prepend">
     <span class="input-group-text">
       <i class="fas fa-map-marker-alt fa-fw"></i>
     </span>
   </div>
   <select class = 'custom-select' id = 'select_country_event' name = 'country'></select>

  
</div>

</div>
<div class="col-12 col-sm-6">
 <label for="select_city_event">City</label>
 <div class="input-group mb-2">
  <div class="input-group-prepend">
   <span class="input-group-text">
     <i class="fas fa-map-marker-alt fa-fw"></i>
   </span>
 </div>
 <select class = 'custom-select' id = 'select_city_event' name = 'city'></select>
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
   <input class="form-control" id="place" type="text" name="place" placeholder="Enter place" value="{{ old('place') }}" required>

</div>
</div>
<div class="col-12">
 <label for="address_inp">Address</label>
 <div class="input-group mb-2">
  <div class="input-group-prepend">
   <span class="input-group-text">
     <i class="fas fa-map-marker-alt fa-fw"></i>
   </span>
 </div>
 <input class="form-control" id="address_inp" type="text" name="address" placeholder="Enter address" value="{{ old('address') }}" required>
</div>
</div>
</div>
<label for="description">Description</label>
<div class="input-group mb-2">
  <textarea id="description" class="form-control" rows="4" cols="1" name="description" placeholder="Enter Description" value="{{ old('description') }}" required></textarea>
</div>
<hr>
<button type="submit" class="btn btn-block btn-success mb-1" >Add Event</button>
</form>
</div>
</div>
</div>
</div>

