import {BaseModel} from "@/types/base-model";
import {Comment} from "@/types/Card/comment";

export interface Card extends BaseModel {
    image: string;
    message: string;
    user_id: number | null;
    comments: Array<Comment>
}
