export interface SubscribersListResponse {
    data: Subscriber[];
    meta: Meta;
    links: Links;
}

export interface SubscriberResponse {
    data: Subscriber;
}

export interface Subscriber {
    id: number;
    email: string;
    name: string;
    state: string;
    fields: Field[];
}

export interface SubscriberField {
    id: number,
    value: string
}

export interface FieldsListResponse {
    data: Field[];
    meta: Meta;
    links: Links;
}
export interface FieldResponse {
    data: Field;
}

export interface Field {
    id: number;
    title: string;
    type: string;
    tag: string;
    value?: any;
}

export interface Links {
    first: string;
    last: string;
    next: string;
    prev: string;
}

export interface Meta {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
}
