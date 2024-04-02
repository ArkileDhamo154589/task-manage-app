<!-- we declare our template tags , we have to do this in each vue component -->
<template>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header bg-dark">
               <h5 class="float-start text-light"> Departments List </h5>
               <button class="btn btn-success float-end" @click="createDepartment">  New Department</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Director</th>
                                    <th>Actions</th>
                                </tr>
                        </thead>
                            <tbody>
                                 <tr v-for="(department, index) in departments" :key="index">
                                    <td>{{index + 1}}</td>
                                    <td>{{department.name}}</td>
                                    <td>{{department.director_id}}</td>
                                    <td>
                                       <button class="btn btn-success mx-1" @click="editDepartment(department)"><i class="fa fa-edit"> </i></button>
                                    </td>
                                   <td>
                                        <button class="btn btn-danger mx-1" @click="deleteDepartment(department)"><i class="fa fa-trash"></i></button>
                                    </td>
                                   
                                 </tr>
                              </tbody>
                    </table>
                </div>

               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">{{!editMode ? 'Create Department' : 'Update Department'}}</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="name"> Name </label>
                                    <input type="text" class="form-control" name="name" v-model="departmentData.name">
                                    <p class="text-danger" v-if="departmentErrors.name">
                                       Name is Required 
                                    </p>
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
                                    <p class="text-danger" v-if="departmentErrors.direcotr_id">
                                       Director is Required 
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           <!-- We check here if the editMode is false then run the store function else run the update function -->
                           <button type="button" @click="!editMode ? storeDepartment() : updateDepartment()" class="btn btn-success">{{!editMode ? 'Store' : 'Update'}}</button>
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
            editMode : false, //i create this object , and i declare it in my function , after that i check if is true or false to change the text of my modal
            departments: {},
             departmentData : {
                id: '',
                name: '',
                director_id: '',
             },
             //validation 
             departmentErrors : {
                name: false,
                director_id: false,
             },

           }
       },
       methods: {
            getDepartments(){
                axios.get(`${window.url}api/getDepartments`).then((response) =>{
                    console.log(response.data)
                    this.departments = response.data
                })
            },
           createDepartment(){
            this.editMode = false
            this.departmentData.name = this.departmentData.direcotr_id = ''
              this.getDepartments()
              $('#exampleModal').modal('show')
           },
           editDepartment(department){
            this.editMode = true
            this.departmentData.id = department.id
            this.departmentData.name = department.name
            this.departmentData.direcotr_id = department.direcotr_id
              $('#exampleModal').modal('show')
           },
           
           storeDepartment(){
               // Check if the fields are empty
               this.departmentErrors.name = !this.departmentData.name
               this.departmentErrors.direcotr_id = !this.departmentData.direcotr_id
               
               if(!this.departmentErrors.name && !this.departmentErrors.direcotr_id){
                  axios.post(window.url + 'api/storeDepartment' , this.departmentData)
                        .then((response) => {
                           this.getDepartments()
                           $('#exampleModal').modal('hide')
                        });
               }
            },
           updateDepartment() {
            // we put / because after url need it for the id
            this.departmentErrors.name = !this.departmentData.name
               this.departmentErrors.direcotr_id = !this.departmentData.direcotr_id
               
               if(!this.departmentErrors.name && !this.departmentErrors.direcotr_id){
                     axios.post(window.url + 'api/updateDepartment/' + this.departmentData.id, this.departmentData)
                     .then((response) => {
                        //we call getDepartments function because we need to see the updated changes
                        this.getDepartments()
                        $('#exampleModal').modal('hide');
                     });
               }
         },
         deleteDepartment(department){
            if(confirm('Are you sure you want to delete department!!?')){
                  axios.post(window.url + 'api/deleteDepartment/' + department.id)
                  .then((response) => {
                     this.getDepartments()
                     $('#exampleModal').modal('hide');
                  });
            }
         },

       },
       mounted() {
        //we bring this every time that our page reload
          this.getDepartments()
       },
   }
</script>