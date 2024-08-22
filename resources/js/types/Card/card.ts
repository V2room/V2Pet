import {BaseModel} from "@/types/base-model";
import {Comment} from "@/types/Card/comment";
import {User} from "@/types";

export interface Card extends BaseModel {
    image: string;
    message: string;
    user: User | null;
    comments: Array<Comment>
}
