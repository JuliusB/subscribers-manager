import {VuexModule, Module, getModule, Mutation, Action} from 'vuex-module-decorators'
import store from '../index';
import {Field, FieldsListResponse} from './dataModels'
import {createField, deleteField, getFields, updateField, getField} from '../api';

@Module({
    namespaced: true,
    name: 'fields',
    store: store,
    dynamic: true
})
class FieldsModule extends VuexModule {
    fields: Field[] = [];

    @Mutation
    setFields(fields: FieldsListResponse) {
        this.fields = fields.data;
    }

    @Action({commit: 'setFields'})
    async getFields(page: number) {
        return await getFields(page);
    }

    @Action
    async deleteField(id: number) {
        return await deleteField(id);
    }

    @Action
    async createField(field: Field) {
        return await createField(field);
    }

    @Action
    async updateField(field: Field) {
        return await updateField(field);
    }

    @Action
    async getField(id: string) {
        return await getField(id);
    }
}


export default getModule(FieldsModule);
