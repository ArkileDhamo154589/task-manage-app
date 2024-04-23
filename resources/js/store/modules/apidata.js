import axios from 'axios';

export default {
    state: {
        filtered_departments: [],
        filtered_roles: [],
      
    },
    getters: {
        filtered_departments(state) {
            return state.filtered_departments;
        },
        filtered_roles(state) {
            return state.filtered_roles;
        },
       
    },
    mutations: {
        set_all_departments: (state, data) => {
            state.filtered_departments = [];
            data.forEach(department => state.filtered_departments.push({value: department.id, label: department.name}));
        },
        set_all_roles: (state, data) => {
            state.filtered_roles = [];
            data.forEach(role => state.filtered_roles.push({value: role.id, label: role.name}));
        },
        
    },
    actions: {
        getAllDepartments: (context) => {
            axios.get(`${window.url}api/getAllDepartments`).then((response) => {
                context.commit('set_all_departments', response.data)
            });
        },
        getAllRoles: (context) => {
            axios.get(`${window.url}api/getAllRoles`).then((response) => {
                context.commit('set_all_roles', response.data)
            });
        },
     
    },
}