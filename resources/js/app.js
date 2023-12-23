require('./bootstrap');

import Vue from "vue"
//const Vue = require("vue");
//
//window.Vue = require('vue').default;

import FullcalenderComponent from "./components/FullCalendarComponent.vue"

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    components:{
        FullcalenderComponent
    }
});

export default app;


