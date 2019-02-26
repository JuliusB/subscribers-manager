<template>
    <div class="card border-success">
        <div class="card-header">
            Edit
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
                <b-form-input id="email" v-model="subscriber.email" trim disabled />
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
            <button class="btn btn-warning" @click="updateSubscriber">Save</button>
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
    import {Subscriber, Field, FieldsListResponse} from "../store/modules/dataModels";

    @Component({
        components: {}
    })
    export default class SubscribersEdit extends Vue {

        id: string = '';

        showAllFields: boolean = false;

        showSuccess: boolean = false;

        fields: Field[] = [];

        subscriber: Subscriber = {
            name: '',
            email: '',
            state: '',
            fields: [],
            id: 0
        };

        created() {
            this.id = this.$route.params.id;
            this.getSubscriber();
        }

        getSubscriber() {
            SubscribersModule.getSubscriber(this.id).then((subscriber: Subscriber) => {
                this.subscriber = subscriber;

                this.getFields();
            })
        }

        getFields() {
            FieldsModule.getFields(1).then((response: FieldsListResponse) => {
                const fields = response.data;

                this.subscriber.fields.forEach((field: Field, index) => {
                    fields.forEach((value: Field, index) => {
                        if (field.id == value.id) {
                            if (field.type == 'boolean') {
                                if (field.value === '1') {
                                    value.value = true
                                } else {
                                    value.value = false
                                }
                            } else {
                                value.value = field.value
                            }
                        }
                    })
                });

                this.subscriber.fields = fields;
            })
        }

        updateSubscriber() {
            this.showSuccess = false;
            SubscribersModule.updateSubscriber(this.subscriber).then(() => {
                this.showSuccess = true;
            })
        }
    }
</script>
