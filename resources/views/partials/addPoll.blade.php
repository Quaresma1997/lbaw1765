<div class="modal fade" id="add_poll">
   <div class="modal-dialog modal-dialog-centered modal-md">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">New Poll</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body ">
            <form class="add_poll" id="form_add_poll" action ="{{route('polla', $event->id )}}" method="post">
               {{ csrf_field() }}
               <label for="question">Question</label>
               <div class="input-group mb-2">
                  <textarea id="question" class="form-control" rows="2" cols="1" name="question" placeholder="Enter Question" required></textarea>
                  
               </div>
               <label for="option1">Option1</label>
               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                     </span>
                  </div>
                  <input id="option1" type="text" name="option1" placeholder="Option" class="form-control" required autofocus>
                  
               </div>
               <label for="option2">Option2</label>

               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                     </span>
                  </div>
                  <input id="option2" type="text" name="option2" placeholder="Option" class="form-control" required autofocus>
                  
               </div>
               <label for="option1">Option3</label>

               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                     </span>
                  </div>
                  <input id="option3" type="text" name="option3" placeholder="Option" class="form-control"  >
                  
               </div>
               <label for="option1">Option4</label>

               <div class="input-group mb-2">
                  <div class="input-group-prepend">
                     <span class="input-group-text">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                     </span>
                  </div>
                  <input id="option4" type="text" name="option4" placeholder="Option" class="form-control"  >
                  
               </div>
               
               
               <hr>
               <button type="submit" class="btn btn-block btn-success mb-1" >Add Poll</button>
            </form>
         </div>
      </div>
   </div>
</div>

