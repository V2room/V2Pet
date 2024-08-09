import * as React from "react"
import {Label} from "@/Components/ui/label";
import InputError from "@/Components/InputError";

export interface InputProps
    extends React.InputHTMLAttributes<HTMLInputElement> {
}

const Labels = React.forwardRef<HTMLInputElement, InputProps>(
    ({id, label, errors, clasName, children, ...props}, ref) => {
        return (
            <div className={clasName}>
                <Label htmlFor={id}>{label}</Label>
                {children}
                <InputError message={errors[id]} className="mt-2"/>
            </div>
        )
    }
)

export {Labels}
