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
                <b-form-select v-model="field.type" :options="options" disabled/>
            </b-form-group>

            <b-alert v-show="showSuccess" variant="success" show>Field saved !</b-alert>
        </div>

        <div class="card-footer">
            <button class="btn btn-warning" @click="updateField">Save field</button>
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

        showSuccess: boolean = false;

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

        created() {
            this.id = this.$route.params.id;
            this.getField()
        }

        getField() {
            FieldsModule.getField(this.id).then((field: Field) => {
                this.field = field;
            })
        }

        updateField() {
            this.showSuccess = false;
            FieldsModule.updateField(this.field).then(() => {
                this.showSuccess = true;
            })
        }
    }
</script>
