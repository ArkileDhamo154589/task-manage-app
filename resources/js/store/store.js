import { createStore } from "vuex";

import departmentsModule from './modules/departments';
import apidatamodule from './modules/apidata';

export const store = createStore({
    strict: true,
    modules: {
        departmentsModule,
        apidatamodule,
      
    },
    state: {
        // test: 0,
        current_roles: new Set(),
        current_permissions: new Set(),
    },
    getters: {
        // test(state) {
        //     return state.test
        // }
        current_roles(state) {
            return state.current_roles
        },
        current_permissions(state) {
            return state.current_permissions
        }
    },
    mutations: {
        get_auth_roles_and_permission: (state) => {
            let roles = window.auth_roles;
            let permissions = window.auth_permissions;
    
            state.current_roles = new Set();
            state.current_permissions = new Set();
    
            roles.forEach(role => {
                state.current_roles.add(role.name);
            });
    
            permissions.forEach(permission => {
                state.current_permissions.add(permission.name);
            });
        }
    },
    
    actions: {
        getAuthRolesAndPermissions: (context) => {
            context.commit('get_auth_roles_and_permission')
        }
    }
});