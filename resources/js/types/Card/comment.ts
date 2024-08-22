import {BaseModel} from "@/types/base-model";
import {User} from "@/types/User/user";
import {Card} from "@/types/Card/card";

export interface Comment extends BaseModel {
    message: string;
    card: Card;
    user: User;
}
