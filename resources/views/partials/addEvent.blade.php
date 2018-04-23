

<div class="modal fade" id="add_event">
   <div class="modal-dialog modal-dialog-centered modal-md">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">New Event</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body ">
            <form class="add_event" name="off">
               <label for="name">Name</label>
               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="name">
                     <i class="fas fa-pencil-alt fa-fw"></i>
                     </span>
                  </div>
                  <input id="name" type="text" name="name" placeholder="Event Name" required autofocus>
                  @if ($errors->has('name'))
                  <span class="error">
                  {{ $errors-> first('name') }}
                  </span>
                  @endif
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
                           <option value="Music">Music</option>
                           <option value="Sports">Sports</option>
                           <option value="Entertainment">Entertainment</option>
                           <option value="Educational">Educational</option>
                           <option value="Other" selected>Other</option>
                        </select>
                     </div>
                  </div>
               </div>
               <label for="date">Date</label>
               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <span class="input-group-text" id="date">
                     <i class="fas fa-calendar-alt fa-fw"></i>
                     </span>
                  </div>
                  <input id="date" type="datetime-local" name="name" placeholder="Enter Date" required autofocus>
                  @if ($errors->has('date'))
                  <span class="error">
                  {{ $errors-> first('date') }}
                  </span>
                  @endif
               </div>
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <label for="country">Country</label>
                     <div class="input-group mb-2 p-0 m-0">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="country">
                           <i class="fas fa-map-marker-alt fa-fw"></i>
                           </span>
                        </div>
                        <select class = 'custom-select' id = 'select_country_event' name = 'country'>
               
                </select>
                        @if ($errors->has('country'))
                        <span class="error">
                        {{ $errors-> first('country') }}
                        </span>
                        @endif  
                     </div>
                  </div>
                  <div class="col-12 col-sm-6">
                     <label for="city">City</label>
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="city">
                           <i class="fas fa-map-marker-alt fa-fw"></i>
                           </span>
                        </div>
                        <select class = 'custom-select' id = 'select_city_event' name = 'city'>
               
                </select>
                        @if ($errors->has('city'))
                        <span class="error">
                        {{ $errors-> first('city') }}
                        </span>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <label for="place">Place</label>
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="place">
                           <i class="fas fa-map-marker-alt fa-fw"></i>
                           </span>
                        </div>
                        <input id="place" type="text" name="place" placeholder="Enter place" required>
                        @if ($errors->has('place'))
                        <span class="error">
                        {{ $errors-> first('place') }}
                        </span>
                        @endif
                     </div>
                  </div>
                  <div class="col-12 col-sm-6">
                     <label for="address">Address</label>
                     <div class="input-group mb-2">
                        <div class="input-group-prepend">
                           <span class="input-group-text" id="address">
                           <i class="fas fa-map-marker-alt fa-fw"></i>
                           </span>
                        </div>
                        <input id="address" type="text" name="address" placeholder="Enter address" required>
                        @if ($errors->has('address'))
                        <span class="error">
                        {{ $errors-> first('address') }}
                        </span>
                        @endif
                     </div>
                  </div>
               </div>
               <label for="description">Description</label>
               <div class="input-group mb-2">
                  <textarea id="description" class="form-control" rows="4" cols="1" name="description" placeholder="Enter Description" required></textarea>
                  @if ($errors->has('description'))
                  <span class="error">
                  {{ $errors-> first('description') }}
                  </span>
                  @endif
               </div>
               <hr>
               <button type="submit" class="btn btn-block btn-success mb-1" name="off">Add Event</button>
            </form>
         </div>
      </div>
   </div>
</div>

