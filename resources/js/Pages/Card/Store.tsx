import {Head, useForm} from '@inertiajs/react';
import {Container} from "@/types/container";
import React, {FormEventHandler, useState} from "react";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import {Transition} from "@headlessui/react";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";
import WebLayout from "@/Layouts/WebLayout";
import {Preset} from "@/types/AI/preset";
import RequestService from "@/Services/request";

export default function Dashboard({auth, title, presets}: Container<{
    presets: Preset[];
}>) {
    const [imageUrl, setImageUrl] = useState(null);
    const {data, setData, post, errors, processing, recentlySuccessful} = useForm({
        image: null,
        message: '',
        preset: null,
    });

    const [formError, setFormError] = useState(null);
    const requestService = new RequestService(setFormError);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('card.store'));
    };

    const handleFileInputChange = (file) => {
        const reader = new FileReader();

        reader.onload = function (e) {
            const previewImage = document.getElementById('previewImage');
            const imagePreview = document.getElementById('imagePreview');

            if (previewImage && imagePreview) {
                previewImage.setAttribute('src', e.target.result.toString());
                imagePreview.classList.remove('hidden');
            }
        }

        reader.readAsDataURL(file);

        setData('image', file);
    }

    const generatePreset = (preset) => {
        data.preset = preset;

        requestService.callAxios(
            'post',
            route('card.ai.preset.generate'),
            {
                preset: preset,
                image: data.image,
            },
            response => {
                setImageUrl(response.data.url)
            },
            null,
            {
                'Content-Type': 'multipart/form-data'
            }
        );
    }

    return (
        <WebLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{title}</h2>}
            auth={auth}
            title={title}>
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
                                        onChange={(e) => handleFileInputChange(e.target.files[0])}
                                    />

                                    <InputError message={errors.image} className="mt-2"/>

                                    <div id="imagePreview" className="mt-4 hidden">
                                        <img id="previewImage"
                                             className="object-cover w-full h-48 rounded-md shadow-md"
                                             src="#"
                                             alt="Preview Image"
                                        />
                                    </div>
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

                                <div className="w-64">
                                    <select
                                        className="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        onChange={(e) => generatePreset(e.target.value)}
                                    >
                                        <option>AI Preset 선택</option>
                                        {presets.map((preset) => (
                                            <option key={preset.code} value={preset.code}>{preset.name}</option>
                                        ))}
                                    </select>
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

                                <img className="object-cover"
                                     src={imageUrl}
                                     alt="Sample image"/>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </WebLayout>
    );
}
