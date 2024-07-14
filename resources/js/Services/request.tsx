import NProgress from "nprogress";
import {router} from "@inertiajs/react";
import {Method} from "@inertiajs/core";
import {ResponseTemplate} from "@/types/response-template";
import {AxiosError, AxiosResponse} from "axios";
import {Dispatch} from "react";

export default class RequestService {
    private setErrors: any;

    constructor(setErrors: Dispatch<React.SetStateAction<null>>) {
        this.setErrors = setErrors;
    }

    callAxios<Data>(
        method: Method,
        url: string,
        data: any,
        callback: (response: ResponseTemplate<Data>) => void,
        errorCallback: ((response: ResponseTemplate<any>) => void) | null = null,
        header: {},
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
            callback({
                data: response.data.data,
                code: response.status,
                message: response.data.message,
                errors: response.data.errors,
            });
        }).catch((error: AxiosError<ResponseTemplate<any>>) => {
            console.log(error);
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

        if (this.setErrors !== null) {
            this.setErrors(error.errors);
        }
    }
}
