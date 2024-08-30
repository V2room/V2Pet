import {Head, useForm} from '@inertiajs/react';
import {Container} from "@/types/container";
import React, {ChangeEvent, FormEventHandler, useState} from "react";
import PrimaryButton from "@/Components/PrimaryButton";
import WebLayout from "@/Layouts/WebLayout";
import {Preset} from "@/types/AI/preset";
import RequestService from "@/Services/request";
import {Transition} from "@headlessui/react";
import {Input} from "@/Components/ui/input";
import {Labels} from "@/Components/Labels";
import {Avatar, AvatarFallback, AvatarImage} from "@/Components/ui/avatar";
// @ts-ignore
import {InertiaFormProps} from '@inertiajs/react/types/useForm';

// Define the interface for form data
interface FormData {
    message: string,
    preset: string | null,
    image: File | null;
}

interface AIResponseType {
    url: string,
    size: number,
    width: number,
    height: number
}

export default function Store({auth, title, presets}: Container<{
    presets: Preset[];
}>) {
    const [aiImage, setAIImage] = useState([
        {
            url: ''
        }
    ]);
    let form: InertiaFormProps<FormData> = useForm<FormData>({
        image: null,
        message: '',
        preset: null,
    });

    const requestService = new RequestService(form);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        form.post(route('cards.store'));
    };

    const handleFileInputChange = (e: ChangeEvent<HTMLInputElement>) => {
        const {name, value, files} = e.target;
        if (files && files.length > 0) {
            let file: File = files[0];

            const reader = new FileReader();

            reader.onload = function (this: FileReader, e: ProgressEvent<FileReader>) {
                const previewImage = document.getElementById('previewImage');
                const imagePreview = document.getElementById('imagePreview');
                if (previewImage && imagePreview) {
                    let src: string = e.target?.result?.toString() ?? '';
                    previewImage.setAttribute('src', src);
                    imagePreview.classList.remove('hidden');
                }
            }

            reader.readAsDataURL(file);

            form.setData('image', file);
        }
    }

    const generatePreset = (preset: string) => {
        form.data.preset = preset;
        requestService.callAxios<AIResponseType[]>(
            'post',
            route('cards.ai.presets.generate'),
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
                                        onChange={(e) => handleFileInputChange(e)}
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
                                                className="w-32 h-32"
                                                onClick={() => generatePreset(preset.id)}
                                            >
                                                <AvatarImage src={preset.image}/>
                                                <AvatarFallback>CN</AvatarFallback>
                                            </Avatar>
                                        </>
                                    ))}

                                    <div>
                                        {aiImage.map((image) => (
                                                <img className="object-cover"
                                                     src={image.url}
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
