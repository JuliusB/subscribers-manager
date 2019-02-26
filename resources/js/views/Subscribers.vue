<template>
    <div class="card border-success">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3>Subscribers</h3>
                </div>
                <div class="col-6">
                    <router-link :to="{ path: '/subscribers/create'}" class="btn btn-warning float-right">
                        Add subscriber
                    </router-link>
                </div>
            </div>
        </div>
        <div class="card-body">
            <b-table striped hover :items="subscribers" :fields="fields">
                <template slot='actions' slot-scope="row">
                    <router-link :to="{ path: '/subscribers/' + row.item.id + '/edit'}" class="btn btn-sm mr-1  btn-primary">
                        Edit
                    </router-link>
                    <b-button size="sm" @click="deleteSubscriber(row.item.id)" class="mr-1 btn-danger">
                        Delete
                    </b-button>
                </template>
            </b-table>
            <b-pagination size="md" :total-rows="pagination.total" :per-page="pagination.per_page" @change="goToPage" />
        </div>
    </div>
</template>

<script lang="ts">
    import Vue from 'vue'
    import Component from 'vue-class-component'
    import {Subscriber, SubscribersListResponse} from "../store/modules/dataModels";
    import SubscribersModule from "../store/modules/subscribers";

    @Component({
        components: {}
    })
    export default class SubscribersView extends Vue {

        subscribers: Subscriber[] = [];
        pagination = {
            total: 0,
            per_page: 10,
            current_page: 1
        };
        fields =  [
            {
                key: 'id',
                label: 'ID',
                sortable: false
            },
            {
                key: 'email',
                label: 'Email',
                sortable: false
            },
            {
                key: 'name',
                label: 'Name',
                sortable: false
            },
            {
                key: 'state',
                label: 'State',
                sortable: false
            },
            {
                key: 'created_at',
                label: 'Created at',
                sortable: false
            },
            {
                key: 'actions',
                label: 'Actions',
                sortable: false
            }
        ];

        created() {
            this.loadData();
        }

        loadData() {
            SubscribersModule.getSubscribers(this.pagination.current_page).then((response: SubscribersListResponse) => {
                this.subscribers = response.data;
                this.pagination.total = response.meta.total;
                this.pagination.per_page = response.meta.per_page;
            })
        }

        deleteSubscriber(id:number) {
            console.log(id);

            SubscribersModule.deleteSubscriber(id).then(() => {
                    this.loadData()
                }
            );
        }

        goToPage(page: number) {
            this.pagination.current_page = page;
            this.loadData()
        }
    }
</script>
