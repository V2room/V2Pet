import * as React from "react"
import {Label} from "@/Components/ui/label";
import InputError from "@/Components/InputError";

type FormDataType = object;

export interface InputProps<TForm extends FormDataType> extends React.InputHTMLAttributes<HTMLInputElement> {
    label: string
    errors: Partial<Record<keyof TForm, string>>
}

const Labels = React.forwardRef<HTMLInputElement, InputProps<any>>(
    ({id, label, errors, className, children, ...props}, ref) => {
        return (
            <div className={className}>
                <Label htmlFor={id}>{label}</Label>
                {children}
                {
                    id != undefined ?
                        <InputError message={errors[id]} className="mt-2"/>
                        :
                        <></>
                }
            </div>
        )
    }
)

export {Labels}
