import Vue from "vue"
import VueRouter from "vue-router"
import SubscribersView from "./views/Subscribers.vue"
import FieldsView from "./views/Fields.vue";
import SubscribersEdit from "./views/SubscriberEdit.vue"
import SubscribersCreate from "./views/SubscriberCreate.vue";
import FieldCreate from "./views/FieldCreate.vue";
import FieldEdit from "./views/FieldEdit.vue";

Vue.use(VueRouter);


export default new VueRouter({
    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'subscribers',
            component: SubscribersView
        },
        {
            path: '/subscribers/create',
            name: 'subscribers-create',
            component: SubscribersCreate
        },
        {
            path: '/subscribers/:id/edit',
            name: 'subscribers-edit',
            component: SubscribersEdit
        },
        {
            path: '/fields',
            name: 'fields',
            component: FieldsView
        },
        {
            path: '/fields/create',
            name: 'fields-create',
            component: FieldCreate
        },
        {
            path: '/fields/:id/edit',
            name: 'fields-edit',
            component: FieldEdit
        }
    ]
})
