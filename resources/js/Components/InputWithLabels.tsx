import * as React from "react"
import {Label} from "@/Components/ui/label";
import InputError from "@/Components/InputError";
import {Input} from "@/Components/ui/input";

type FormDataType = object;

export interface InputProps<TForm extends FormDataType> extends React.InputHTMLAttributes<HTMLInputElement> {
    label: string
    errors: Partial<Record<keyof TForm, string>>
    divClass: string
    inputClass: string
}

const InputWithLabels = React.forwardRef<HTMLInputElement, InputProps<any>>(
    ({id, label, errors, divClass, inputClass, type, children, ...props}, ref) => {
        return (
            <div className={divClass}>
                <Label htmlFor={id}>{label}</Label>
                <Input
                    id={id}
                    ref={ref}
                    type={type}
                    className={inputClass}
                    {...props}
                />
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
InputWithLabels.displayName = "Input"

export {InputWithLabels}
