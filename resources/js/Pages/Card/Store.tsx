import {Head, useForm} from '@inertiajs/react';
import {Container} from "@/types/container";
import React, {FormEventHandler, useState} from "react";
import PrimaryButton from "@/Components/PrimaryButton";
import WebLayout from "@/Layouts/WebLayout";
import {Preset} from "@/types/AI/preset";
import RequestService from "@/Services/request";
import {Transition} from "@headlessui/react";
import {Input} from "@/Components/ui/input";
import {Labels} from "@/Components/Labels";
import {Avatar, AvatarFallback, AvatarImage} from "@/Components/ui/avatar";

export default function Store({auth, title, presets}: Container<{
    presets: Preset[];
}>) {
    const [aiImage, setAIImage] = useState([]);
    const form = useForm({
        image: null,
        message: '',
        preset: null,
    });

    const requestService = new RequestService(form);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        form.post(route('card.store'));
    };

    const handleFileInputChange = (file: File) => {
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

        form.setData('image', file);
    }

    const generatePreset = (preset: string) => {
        form.data.preset = preset;
        requestService.callAxios(
            'post',
            route('card.ai.preset.generate'),
            {
                preset: preset,
                image: form.data.image,
            },
            {
                'Content-Type': 'multipart/form-data'
            },
            response => {
                setAIImage(response.data)
            },
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
                                    카드 만들기
                                </h2>
                            </header>
                            <form onSubmit={submit} className="mt-6 space-y-6">
                                <Labels
                                    id='image'
                                    label="사진"
                                    className="grid w-full max-w-sm items-center gap-1.5"
                                    errors={form.errors}
                                >
                                    <Input
                                        id='image'
                                        type='file'
                                        className={
                                            'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm '
                                        }
                                        onChange={(e) => handleFileInputChange(e.target.files[0])}
                                    />

                                    <div id="imagePreview" className="mt-4 hidden">
                                        <img id="previewImage"
                                             className="object-cover w-full h-48 rounded-md shadow-md"
                                             src="#"
                                             alt="Preview Image"
                                        />
                                    </div>
                                </Labels>

                                <Labels
                                    id='message'
                                    label="메시지"
                                    className="grid w-full max-w-sm items-center gap-1.5"
                                    onChange={(e) => handleFileInputChange(e.target.files[0])}
                                    errors={form.errors}
                                >
                                    <Input
                                        type="text"
                                        placeholder="메시지를 입력하세요."
                                        value={form.data.message}
                                        onChange={(e) => form.setData('message', e.target.value)}
                                    />
                                </Labels>

                                <div className="w-64">
                                    {presets.map((preset) => (
                                        <>
                                            {preset.name}
                                            <Avatar
                                                onClick={() => generatePreset(preset.code)}
                                            >
                                                <AvatarImage src={preset.image}/>
                                                <AvatarFallback>CN</AvatarFallback>
                                            </Avatar>
                                        </>
                                    ))}

                                    <div>
                                        {aiImage.map((aiImage) => (
                                                <img className="object-cover"
                                                     src={aiImage.url}
                                                     alt="Sample image"/>
                                            )
                                        )}
                                    </div>
                                </div>


                                <div className="flex items-center gap-4">
                                    <PrimaryButton disabled={form.processing}>Save</PrimaryButton>

                                    <Transition
                                        show={form.recentlySuccessful}
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
        </WebLayout>
    );
}
