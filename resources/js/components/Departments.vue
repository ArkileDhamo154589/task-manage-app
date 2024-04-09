<!-- we declare our template tags , we have to do this in each vue component -->
<template>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header bg-dark">
               <h5 class="float-start text-light"> Departments List </h5>
               <button class="btn btn-success float-end" @click="createDepartment" >  New Department</button>
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
                                    <!-- comment custom validation message
                                        <p class="text-danger" v-if="departmentErrors.name">
                                       Name is Required 
                                    </p> -->
                                    <div  class="text-danger" v-if="departmentData.errors.has('name')" v-html="departmentData.errors.get('name')" > </div>
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
                                     <div  class="text-danger" v-if="departmentData.errors.has('director_id')" v-html="departmentData.errors.get('director_id')" > </div>
                                    <!-- <p class="text-danger" v-if="departmentErrors.direcotr_id">
                                       Director is Required 
                                    </p> -->
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
            
             departmentData: new Form ({
                id: '',
                name: '',
                director_id: '',
             }),
             //validation 
             departmentErrors : {
                name: false,
                director_id: false,
             },

           }
       },
       methods: {

           createDepartment(){
            this.editMode = false
            this.departmentData.name = this.departmentData.direcotr_id = ''
            //   this.getDepartments()
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
                 this.$store.dispatch('storeDepartment' , this.departmentData)
            },
           updateDepartment() {
               this.$store.dispatch('updateDepartment', this.departmentData)
            },
         deleteDepartment(department){
            this.$store.dispatch('deleteDepartment', department)
         },
         testAction(){
            this.$store.dispatch('testAction')
         }

       },
       mounted() {
         console.log(window.auth_roles)
         console.log(window.auth_permissions)
         this.$store.dispatch('getDepartments')
         this.$store.dispatch('getAuthRolesAndPermissions')
          
       },
       computed: {
         departments() {
            return this.$store.getters.departments
         },
         current_permissions() {
            return this.$store.getters.current_permissions
         },
         current_roles() {
            return this.$store.getters.current_roles
         }
       }
   }
</script>