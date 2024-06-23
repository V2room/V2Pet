import {Config} from 'ziggy-js';
import {User} from "@/types/User/user";
import {ReactNode} from "react";

export type Container<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    title: string;
    ziggy?: Config & { location: string };
    children?: ReactNode | undefined;
};
