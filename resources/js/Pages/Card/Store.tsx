import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, useForm} from '@inertiajs/react';
import {Container} from "@/types/container";
import React, {FormEventHandler} from "react";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import {Transition} from "@headlessui/react";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";

export default function Dashboard({auth, title}: Container) {
    const {data, setData, post, errors, processing, recentlySuccessful} = useForm({
        image: null,
        message: ''
    });
    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('card.store'));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{title}</h2>}
        >
            <Head title={title}/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">


                        <section className="max-w-xl">
                            <header>
                                <h2 className="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    사진 등록
                                </h2>
                            </header>

                            <form onSubmit={submit} className="mt-6 space-y-6">
                                <div>
                                    <InputLabel htmlFor="image" value="Image"/>

                                    <input
                                        type='file'
                                        className={
                                            'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm '
                                        }
                                        onChange={(e) => setData('image', e.target.files[0])}
                                    />

                                    <InputError message={errors.image} className="mt-2"/>
                                </div>

                                <div>
                                    <InputLabel htmlFor="message" value="Message"/>

                                    <TextInput
                                        id="message"
                                        value={data.message}
                                        onChange={(e) => setData('message', e.target.value)}
                                        className="mt-1 block w-full"
                                        autoComplete="new-password"
                                    />

                                    <InputError message={errors.message} className="mt-2"/>

                                </div>

                                <div className="flex items-center gap-4">
                                    <PrimaryButton disabled={processing}>Save</PrimaryButton>

                                    <Transition
                                        show={recentlySuccessful}
                                        enter="transition ease-in-out"
                                        enterFrom="opacity-0"
                                        leave="transition ease-in-out"
                                        leaveTo="opacity-0"
                                    >
                                        <p className="text-sm text-gray-600 dark:text-gray-400">등록</p>
                                    </Transition>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
