
require('./bootstrap');

var moment = require('vue-moment');
Vue.use(require('vue-moment'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component(
    'foodtruck-register',
    require('./components/FoodTruckRegistration.vue')
);
Vue.component(
    'tracking-tab',
    require('./components/TrackingTab.vue')
);

Vue.component(
    'foodtrucks-admin',
    require('./components/FoodTrucksAdmin.vue')
);

Vue.config.devtools = true;
Vue.config.debug = true;

Vue.use(require('vue-i18n'));
Vue.use(VueTables.server, {
    compileTemplates: true,
    //highlightMatches: true,
    //pagination: {
    // dropdown:true
    // chunk:5
    // },
    filterByColumn: true,
    texts: {
        filter: "Search:"
    },
    //datepickerOptions: {
    //    showDropdowns: false
    //}

    //skin:''
});

const app = new Vue({
    el: 'body'
})
