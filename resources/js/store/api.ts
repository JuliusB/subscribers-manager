import axios from 'axios'
import {
    SubscribersListResponse,
    SubscriberResponse,
    Subscriber,
    FieldResponse,
    Field,
    FieldsListResponse
} from "./modules/dataModels";

export const Api = axios.create({
    baseURL: '/api'
});

export async function getSubscribers(page: number): Promise<SubscribersListResponse> {
        const response = await Api.get('/subscribers',{
            params: {
                page: page,
                per_page: 10
            }
        });
        return (response.data as SubscribersListResponse)
}

export async function deleteSubscriber(id: number): Promise<void> {
        await Api.delete('/subscribers/' + id);
}

export async function getSubscriber(id: string): Promise<Subscriber> {
        const response = await Api.get('/subscribers/' + id);
        return (response.data as SubscriberResponse).data
}

export async function updateSubscriber(subscriber: Subscriber): Promise<Subscriber> {
    const response = await Api.put('/subscribers/' + subscriber.id, {
        name: subscriber.name,
        state: subscriber.state,
        fields: subscriber.fields
    });
    return (response.data as SubscriberResponse).data
}
export async function createSubscriber(subscriber: Subscriber): Promise<Subscriber> {
    const response = await Api.post('/subscribers', {
        name: subscriber.name,
        email: subscriber.email,
        state: subscriber.state,
        fields: subscriber.fields
    });
    return (response.data as SubscriberResponse).data
}

export async function getFields(page: number): Promise<FieldsListResponse> {
    const response = await Api.get('/fields',{
        params: {
            page: page,
            per_page: 10
        }
    });
    return (response.data as FieldsListResponse)
}

export async function createField(field: Field): Promise<FieldResponse> {
    const response = await Api.post('/fields', {
        title: field.title,
        type: field.type
    });
    return response.data as FieldResponse
}

export async function updateField(field: Field): Promise<FieldResponse> {
    const response = await Api.put('/fields/' + field.id, {
        title: field.title,
    });
    return response.data as FieldResponse
}

export async function getField(id: string): Promise<Field> {
    const response = await Api.get('/fields/' + id);
    return (response.data as FieldResponse).data
}

export async function deleteField(id: number): Promise<void> {
    await Api.delete('/fields/' + id);
}
