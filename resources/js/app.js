require('./bootstrap');

require('alpinejs');

import Vue from 'vue';

Vue.component(
    'bob-compo',
    require("./components/BobCompo.vue").default
);

const app = new Vue({
    el : "#app"
});