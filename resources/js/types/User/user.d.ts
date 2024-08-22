import {BaseModel} from "@/types/base-model";

export interface User extends BaseModel {
    name: string;
    nickname: string;
    email: string;
    birth: string;
    contact: string;
    address: string;
    gender: string;
    email_verified_at: any;
}
