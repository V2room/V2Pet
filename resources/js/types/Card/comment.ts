import {BaseModel} from "@/types/base-model";

export interface Comment extends BaseModel {
    content: string;
    card_id: number;
    user_id: number;
}
