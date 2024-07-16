import * as React from "react"
import {Label} from "@/Components/ui/label";
import InputError from "@/Components/InputError";
import {Input} from "@/Components/ui/input";

export interface InputProps
    extends React.InputHTMLAttributes<HTMLInputElement> {
}

const InputWithLabels = React.forwardRef<HTMLInputElement, InputProps>(
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
                <InputError message={errors[id]} className="mt-2"/>
            </div>
        )
    }
)
InputWithLabels.displayName = "Input"

export {InputWithLabels}
