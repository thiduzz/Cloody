
require('./bootstrap');

var moment = require('vue-moment');
Vue.use(require('vue-moment'));

//OAuth Functionality

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

//General Functionality

Vue.component(
    'foodtruck-register',
    require('./components/FoodTruckRegistration.vue')
);
Vue.component(
    'tracking-tab',
    require('./components/TrackingTab.vue')
);

Vue.component(
    'breadcrumb-action',
    require('./components/BreadcrumbAction.vue')
);

//Admin Functionality

Vue.component(
    'foodtrucks-admin',
    require('./components/FoodTrucksAdmin.vue')
);

Vue.component(
    'foodtrucks-admin-edit',
    require('./components/FoodTrucksAdminEdit.vue')
);

Vue.component(
    'foodtrucks-admin-stats',
    require('./components/FoodTrucksAdminStats.vue')
);

Vue.component(
    'foodtrucks-admin-location',
    require('./components/FoodTrucksAdminLocation.vue')
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
    el: 'body',
    ready(){
        this.$on('breadcrumbSave', function (param) {
            this.$broadcast('breadcrumbSave', param);
        });

        this.$on('breadcrumbToggleProgress', function (param) {
            this.$broadcast('breadcrumbToggleProgress', param);
        });
    }
})
