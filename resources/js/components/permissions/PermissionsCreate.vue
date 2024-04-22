<template>

<div class="row">
    <div class="col-md-12">
        <div class="form-check-inline">
            <input type="radio" id="inlineradio1" class="form-check-input" name="permission_type" v-model="permissionData.permission_type" value="basic">
            <label for="inlineradio1" class="form-check-inline">Basic</label>
        </div>
        <div class="form-check-inline">
            <input type="radio" id="inlineradio2" class="form-check-input" name="permission_type" v-model="permissionData.permission_type" value="crud">
            <label for="inlineradio2" class="form-check-inline">Crud</label>
        </div>
    </div>
</div>


</template>

<script>

export default {
    data(){
        return{
            permissionData:{
                pemrission_type: 'basic',
            }
        }
    }
}

</script>