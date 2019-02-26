<template>
    <div class="card border-success">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3>Fields</h3>
                </div>
                <div class="col-6">
                    <router-link :to="{ path: '/fields/create'}" class="btn btn-warning float-right">
                        Add field
                    </router-link>
                </div>
            </div>
        </div>
        <div class="card-body">
            <b-table striped hover :items="fields" :fields="tableFields">
                <template slot='tag' slot-scope="row">
                    {${{row.item.tag}}}
                </template>
                <template slot='actions' slot-scope="row">
                    <router-link :to="{ name: 'fields-edit', params: {id: row.item.id}}" class="btn btn-sm mr-1  btn-primary">
                        Edit
                    </router-link>
                    <b-button size="sm" @click="deleteField(row.item.id)" class="mr-1 btn-danger">
                        Delete
                    </b-button>
                </template>
            </b-table>
            <b-pagination v-if="pagination.total > 10" size="md" :total-rows="pagination.total" :per-page="pagination.per_page" @change="goToPage" />
        </div>
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from 'vue-class-component'
    import {FieldsListResponse, Field} from "../store/modules/dataModels";
    import FieldsModule from "../store/modules/fields";

    @Component({
        components: {}
    })
    export default class FieldsView extends Vue {

        fields: Field[] = [];

        tableFields =  [
            {
                key: 'id',
                label: 'ID',
                sortable: false
            },
            {
                key: 'title',
                label: 'Title',
                sortable: false
            },
            {
                key: 'type',
                label: 'Field type',
                sortable: false
            },
            {
                key: 'tag',
                label: 'Merge tag',
                sortable: false
            },
            {
                key: 'actions',
                label: 'Actions',
                sortable: false
            }
        ];


        pagination = {
            total: 0,
            per_page: 10,
            current_page: 1
        };

        created() {
            this.loadData()
        }

        loadData() {
            FieldsModule.getFields(this.pagination.current_page).then((response: FieldsListResponse) => {
                this.fields = FieldsModule.fields;
                this.pagination.total = response.meta.total;
                this.pagination.per_page = response.meta.per_page;
            })
        }

        deleteField(id: number) {
            FieldsModule.deleteField(id).then(() => {
                this.loadData()
            })
        }

        goToPage(page: number) {
            this.pagination.current_page = page;
            this.loadData()
        }
    }
</script>
