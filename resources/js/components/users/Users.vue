<!-- we declare our template tags , we have to do this in each vue component -->
<template>
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header bg-dark">
               <h5 class="float-start text-light">Users List </h5>
               <button class="btn btn-success float-end" @click="createUser" 
               v-if="current_permissions.has('users-update')">  New User</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- <table class="table table-hover text-center">
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th v-if="current_permissions.has('users-update') || current_permissions.has('users-delete')">Actions</th>
                                </tr>
                        </thead>
                            <tbody>
                                 <tr v-for="(department, index) in users" :key="index">
                                    <td>{{index + 1}}</td>
                                    <td>{{department.name}}</td>
                                    <td v-if="current_permissions.has('users-update') || current_permissions.has('users-delete')">
                                       <button class="btn btn-success mx-1" @click="editDepartment(department)"><i class="fa fa-edit"> </i></button>
                                    </td>
                                   <td v-if="current_permissions.has('users-update') || current_permissions.has('users-delete')">
                                        <button class="btn btn-danger mx-1" @click="deleteDepartment(department)"><i class="fa fa-trash"></i></button>
                                    </td>
                                   
                                 </tr>
                              </tbody>
                    </table> -->
                </div>

               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{!editMode ? 'Create User' : 'Update User'}}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" v-model="userData.name">
                                        <div class="text-danger" v-if="userData.errors.has('name')" v-html="userData.errors.get('name')"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" v-model="userData.email">
                                        <div class="text-danger" v-if="userData.errors.has('email')" v-html="userData.errors.get('email')"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" v-model="userData.password">
                                        <div class="text-danger" v-if="userData.errors.has('password')" v-html="userData.errors.get('password')"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="department_id">Department</label>
                                        <multi-select :options="filtered_departments" v-model="userData.department_id" :searchable="true"></multi-select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="selected_roles">Roles</label>
                                        <multi-select :options="filtered_roles" v-model="userData.selected_roles" :searchable="true" mode="tags"></multi-select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="permission_categories">Permission Categories</label>
                                        <multi-select :options="filtered_permission_categories" v-model="userData.selected_permission_categories" :searchable="true" mode="tags" @input="getFilteredPermissions"></multi-select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="filtered_permissions">Permissions</label>
                                        <multi-select :options="filtered_permissions" v-model="userData.selected_permissions" :searchable="true" mode="tags"></multi-select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" @click="!editMode ? storeUser() : updateUser()" class="btn btn-success">
                                {{!editMode ? 'Store' : 'Save Changes'}}
                            </button>
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
             userData: new Form ({
                id: '',
                department_id: '',
                name: '',
                email:'',
                password: '',
                selected_roles: [],
                selected_permissions_categories:[],
                selected_permissions:[],
             }),
          

           }
       },
       methods: {
            getFilteredPermissions(values){
                    this.$store.dispatch('getFilteredPermissions' ,{values: values}).then(() =>{
                        this.userData.selected_permissions = [];
                        this.filtered_permissions.forEach(item => {
                            if(item.label.includes('delete')){
                                this.userData.selected_permissions.push(item.value);
                            }
                        });
                    })
                },

           createUser(){
            this.editMode = false
            this.userData.name  = ''
            //   this.getusers()
              $('#exampleModal').modal('show')
           },
           editUser(department){
            this.editMode = true
            this.departmentData.id = department.id
            this.departmentData.name = department.name
              $('#exampleModal').modal('show')
           },
           
            storeUser(){
                  this.$store.dispatch('storeDepartment' , this.departmentData)
               },
            updateUser() {
                  this.$store.dispatch('updateDepartment', this.departmentData)
               },
            deleteUser(department){
                  this.$store.dispatch('deleteDepartment', department)
               },
            testAction(){
                  this.$store.dispatch('testAction')
               }

       },
       mounted() {
         this.$store.dispatch('getAllDepartments')
         this.$store.dispatch('getAllRoles')
         this.$store.dispatch('getAuthRolesAndPermissions')
         this.$store.dispatch('getAllPermissions')
          
       },
       computed: {
        filtered_permissions(){
            return this.$store.getters.filtered_permissions
        },
        filtered_permission_categories() {
            return this.$store.getters.filtered_permission_categories
        },
         filtered_roles() { 
            return this.$store.getters.filtered_roles;
        },
         filtered_departments() { 
            return this.$store.getters.filtered_departments;
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