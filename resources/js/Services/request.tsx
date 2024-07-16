import NProgress from "nprogress";
import {router} from "@inertiajs/react";
import {Method} from "@inertiajs/core";
import {ResponseTemplate} from "@/types/response-template";
import {AxiosError, AxiosResponse} from "axios";
import {InertiaFormProps} from "@inertiajs/react/types/useForm";

type FormDataType = object;

export default class RequestService<TForm extends FormDataType> {
    private form: InertiaFormProps<TForm>;

    constructor(form: InertiaFormProps<TForm>) {
        this.form = form;
    }

    callAxios<Data>(
        method: Method,
        url: string,
        data: any,
        header: {},
        callback: (response: ResponseTemplate<Data>) => void,
        errorCallback: ((response: ResponseTemplate<any>) => void) | null = null,
    ) {
        let promise = new Promise((resolve, reject) => {
            NProgress.start()
            window.axios({
                method: method,
                url: url,
                responseType: 'json',
                data: data,
                headers: header,
            })
                .then((data) => resolve(data))
                .catch((error) => reject(error))
                .finally(() => NProgress.done());
        });

        // @ts-ignore
        promise.then((response: AxiosResponse) => {
            this.form.clearErrors();
            callback({
                data: response.data.data,
                code: response.status,
                message: response.data.message,
                errors: response.data.errors,
            });
        }).catch((error: AxiosError<Respons | eTemplate<any>>) => {
            this.error({
                    data: null,
                    code: error.response?.status ?? 500,
                    message: error.response?.data.message ?? '',
                    errors: error.response?.data.errors ?? [],
                },
                errorCallback,
            )
        });
    }

    call<Data>(
        method: Method,
        url: string,
        data: any,
        callback: ((response: ResponseTemplate<Data>) => void) | null = null,
        errorCallback: ((response: ResponseTemplate<any>) => void) | null = null,
    ) {
        router.visit(url, {
            method: method,
            data: data,
            replace: false,
            preserveState: false,
            preserveScroll: false,
            only: [],
            headers: {},
            errorBag: 'default',
            forceFormData: false,
            onCancelToken: cancelToken => {
            },
            onCancel: () => {
            },
            onBefore: visit => {
            },
            onStart: visit => {
            },
            onProgress: progress => {
            },
            onSuccess: page => {
                if (callback !== null) {
                    console.log('page');
                    console.log(page);
                }
            },
            onError: errors => {
                return Promise.all([
                    function () {
                        console.log('errors');
                        console.log(errors);
                    }
                ])
                /*console.log('errors');
                console.log(errors);
                this.error({
                        data: null,
                        code: 422,
                        message: errors[Object.keys(errors)[0]],
                        errors: errors,
                    },
                    errorCallback,
                    setErrors
                )*/
            },
            onFinish: visit => {
            },
        });
    }

    error(
        error: ResponseTemplate<any>,
        errorCallback: ((response: ResponseTemplate<any>) => void) | null = null,
    ) {
        if (errorCallback !== null) {
            errorCallback(error)
        }

        if (this.form !== null) {
            this.form.setError(error.errors);
        }
    }
}
