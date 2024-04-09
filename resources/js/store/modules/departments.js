import axios from "axios";

export default {
    state: {
        departments: {},
    },
    getters: {
        departments( state ){
            return state.departments
        }
    },
    mutations: {
        set_departments: (state, data) => {
            state.departments = data 
        }
    },
    actions:{
        getDepartments: (context) => { 
            axios.get(`${window.url}api/getDepartments`).then((response) =>{
                context.commit('set_departments', response.data)
            });
         },
        
    
        storeDepartment: (context , departmentData) =>
        {
            departmentData.post(window.url + 'api/storeDepartment')
            .then((response) => {
               //this.getDepartments()
               context.dispatch('getDepartments')
               $('#exampleModal').modal('hide')
            });
        },

        updateDepartment: (context , departmentData) =>
        {
          departmentData.post(window.url + 'api/updateDepartment/' + departmentData.id)
            .then((response) => {
               context.dispatch('getDepartments')
               $('#exampleModal').modal('hide');
            });
        },
        deleteDepartment: (context , departmentData) =>{
            if(confirm('Are you sure you want to delete department!!?')){
                axios.post(window.url + 'api/deleteDepartment/' + department.id)
                .then((response) => {
                   context.dispatch('getDepartments')
                   $('#exampleModal').modal('hide');
                });
          }
        }
    },
}