<template>
    <div class="card border-success">
        <div class="card-header">
            Add new subscriber
        </div>
        <div class="card-body">
            <b-form-group
                label="Name"
                label-for="name"
            >
                <b-form-input id="name" v-model="subscriber.name" trim />
            </b-form-group>

            <b-form-group
                label="Email"
                label-for="email"
            >
                <b-form-input id="email" v-model="subscriber.email" trim />
            </b-form-group>

            <b-form-group
                label="State"
                label-for="type"
            >
                <b-form-select v-model="subscriber.state" :options="states" />
            </b-form-group>

        <div v-if="showAllFields">
            <b-form-group
                :label="field.title"
                :abel-for="field.title"
                v-for="field in subscriber.fields"
                :key="field.id"
            >
                <b-form-input v-if="field.type === 'string'" :id="field.id.toString()" v-model="field.value" type="text" />
                <b-form-input v-if="field.type === 'number'" :id="field.id.toString()" v-model="field.value" type="number" />
                <b-form-input v-if="field.type === 'date'" :id="field.id.toString()" v-model="field.value" type="date" />
                <b-form-checkbox v-if="field.type === 'boolean'" :id="field.id.toString()" switch v-model="field.value" name="check-button" />

            </b-form-group>

        </div>
            <a href="#" @click="showAllFields = !showAllFields" >
                <span v-show="!showAllFields">Show all fields</span><span v-show="showAllFields">Hide fields</span>
            </a>

            <b-alert v-show="showSuccess" variant="success" show>Subscriber saved !</b-alert>

        </div>
        <div class="card-footer">
            <button class="btn btn-warning" @click="createSubscriber">Add subscriber</button>
            <router-link :to="{ name: 'subscribers'}">
                or go back
            </router-link>
        </div>
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from 'vue-class-component'
    import SubscribersModule from "../store/modules/subscribers";
    import FieldsModule from "../store/modules/fields";
    import {Field, FieldsListResponse, Subscriber} from "../store/modules/dataModels";

    @Component({
        components: {}
    })
    export default class SubscribersCreate extends Vue {

        id: string = '';

        showAllFields: boolean = false;

        showSuccess: boolean = false;

        states = [
            { value: 'unconfirmed', text: 'Unconfirmed'},
            { value: 'active', text: 'Active' },
            { value: 'unsubscribe', text: 'Unsubscribed' },
            { value: 'junk', text: 'Junk' },
            { value: 'bounced', text: 'Bounced'},
        ];

        subscriber: Subscriber = {
            name: '',
            email: '',
            state: '',
            fields: [],
            id: 0
        };

        created() {
            this.getFields()
        }

        createSubscriber() {
            this.showSuccess = false;
            SubscribersModule.createSubscriber(this.subscriber).then((subscriber: Subscriber) => {
                this.$router.push({name: 'subscribers-edit', params: {id: subscriber.id.toString()}});
            })
        }

        getFields() {
            FieldsModule.getFields(1).then((response: FieldsListResponse) => {
                this.subscriber.fields = response.data;
            })
        }
    }
</script>
