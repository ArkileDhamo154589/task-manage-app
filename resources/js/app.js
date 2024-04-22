import './bootstrap';
//we add globaly vue
/*
We import vue
Do not forget to compile all changes
*/

import {createApp} from 'vue'
//Import Departments component
import { store } from './store/store';
import Departments from './components/Departments.vue';
import PermissionsCreate from './components/permissions/PermissionsCreate.vue';
//import v-form 
import Form from 'vform';
window.Form = Form;



const app = createApp({})

app.component('departments' , Departments);
app.component('permissions-create', PermissionsCreate);
window.url = '/'

app.use(store);
app.mount('#app')
