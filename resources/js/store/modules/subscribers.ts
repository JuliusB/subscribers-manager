import {VuexModule, Module, getModule, Mutation, Action} from 'vuex-module-decorators'
import store from '../index';
import {Subscriber, SubscribersListResponse, Field} from './dataModels'
import {deleteSubscriber, getSubscribers, getSubscriber, updateSubscriber, createSubscriber} from '../api';

@Module({
    namespaced: true,
    name: 'subscribers',
    store: store,
    dynamic: true
})
class SubscribersModule extends VuexModule {
    subscribers: Subscriber[] = [];

    @Mutation
    setSubscribers(subscribers: SubscribersListResponse) {
        this.subscribers = subscribers.data;
    }

    @Action({commit: 'setSubscribers'})
    async getSubscribers(page: number) {
        return await getSubscribers(page);
    }

    @Action
    async deleteSubscriber(id: number) {
        return await deleteSubscriber(id);
    }

    @Action
    async getSubscriber(id: string) {
        return await getSubscriber(id);
    }

    @Action
    async updateSubscriber(subscriber: Subscriber) {
        subscriber.fields.forEach((field: Field, index) => {
            if ('value' in field && !field.value) {
                delete field.value;
            }
        });
        return await updateSubscriber(subscriber);
    }

    @Action
    async createSubscriber(subscriber: Subscriber) {
        subscriber.fields.forEach((field: Field, index) => {
            if ('value' in field && !field.value) {
                delete field.value;
            }
        });
        return await createSubscriber(subscriber);
    }
}


export default getModule(SubscribersModule);
