<!-- we declare our template tags , we have to do this in each vue component -->
<template>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header bg-dark">
               <h5 class="float-start text-light"> Departments List </h5>
               <button class="btn btn-success float-end" @click="createDepartment"> Create new Department</button>
            </div>
            <div class="card-body">
               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="name"> Name </label>
                                    <input type="text" class="form-control" name="name" v-model="departmentData.name">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="direcotr_id"> Director </label>
                                    <select name="director_id" class="form-control" v-model="departmentData.director_id">
                                       <option value=""> Select a person </option>
                                       <option value="1"> IT DIRECTOR </option>
                                       <option value="2"> HR DIRECTOR </option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <button type="button" @click="storeDepartment" class="btn btn-success">Store</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>
<script>
   export default {
       data() {
           return {
            //we put our data in object
             departmentData : {
                name: '',
                director_id: '',
             }
           }
       },
       methods: {
        //in methods we create our function
           createDepartment(){
            //here on click @click we show our modal
              $('#exampleModal').modal('show')
           },
           //here is the function to store data , for the momment we console log the data (working)
           storeDepartment(){
                console.log(this.departmentData)
           },
       },
       mounted() {
          
       },
   }
</script>