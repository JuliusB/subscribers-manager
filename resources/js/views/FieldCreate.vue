<template>
    <div class="card border-success">
        <div class="card-header">
            Create new field
        </div>
        <div class="card-body">
            <b-form-group
                label="Title"
                label-for="title"
            >
                <b-form-input id="title" v-model="field.title" trim />
            </b-form-group>

            <b-form-group
                label="Field type"
                label-for="type"
            >
                <b-form-select v-model="field.type" :options="options" />
            </b-form-group>
        </div>

        <div class="card-footer">
            <button class="btn btn-warning" @click="createField">Add field</button>
            <router-link :to="{ name: 'fields'}">
                or go back
            </router-link>
        </div>
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from 'vue-class-component'
    import FieldsModule from "../store/modules/fields";
    import {Field} from "../store/modules/dataModels";

    @Component({
        components: {}
    })
    export default class FieldCreate extends Vue {

        id: string = '';

        options = [
            { value: 'string', text: 'Text' },
            { value: 'number', text: 'Number' },
            { value: 'boolean', text: 'Boolean' },
            { value: 'date', text: 'Date'}
            ];

        field: Field = {
            tag: '',
            title: '',
            type: '',
            id: 0
        };

        createField() {
            FieldsModule.createField(this.field).then(() => {
                this.$router.push({'name': 'fields'});
            })
        }
    }
</script>
