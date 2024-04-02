import './bootstrap';
//we add globaly vue
/*
We import vue
Do not forget to compile all changes
*/

import {createApp} from 'vue'
//Import Departments component

import Departments from './components/Departments.vue';

//import v-form 
import Form from 'vform';
window.Form = Form;



const app = createApp({})

app.component('departments' , Departments);

window.url = '/'

app.mount('#app')
