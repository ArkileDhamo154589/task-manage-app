<!-- we declare our template tags , we have to do this in each vue component -->

<template>
    <h1> Departments list </h1>

         <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                 Create New Departments
            </button> -->
        <button class="btn btn-success" @click="createDepartment"> Create new Department</button>
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
                            <input type="text" class="form-control" name="name" v-model="name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direcotr_id"> Director </label>
                            <select name="director_id" class="form-control" v-model="director_id">
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
                <button type="button" class="btn btn-success">Save changes</button>
            </div>
            </div>
        </div>
        </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            director_id: '',
        }
    },
    methods: {
        createDepartment(){
            alert('working')
        }
    },
}
</script>
