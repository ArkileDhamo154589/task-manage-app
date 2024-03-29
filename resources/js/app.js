import './bootstrap';
//we add globaly vue
/*
We import vue
Do not forget to compile all changes
*/

import {createApp} from 'vue'
//Import Departments component

import Departments from './components/Departments.vue';
const app = createApp({})
app.component('departments' , Departments);
app.mount('#app')
