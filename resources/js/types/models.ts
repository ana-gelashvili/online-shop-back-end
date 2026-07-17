import type { User } from './auth';

export type Category = {
    id: number;
    name: string;
    slug: string;
    created_at: string;
    updated_at: string;
    products?: Product[];
};

export type Product = {
    id: number;
    category_id: number;
    name: string;
    description: string | null;
    price: string;
    stock: number;
    image_url: string | null;
    created_at: string;
    updated_at: string;
    category?: Category;
};

export type Cart = {
    id: number;
    user_id: number;
    product_id: number;
    quantity: number;
    created_at: string;
    updated_at: string;
    user?: User;
    product?: Product;
};

export type Order = {
    id: number;
    user_id: number;
    total: string;
    status: string;
    shipping_address: string;
    phone_number: string;
    created_at: string;
    updated_at: string;
    user?: User;
};
