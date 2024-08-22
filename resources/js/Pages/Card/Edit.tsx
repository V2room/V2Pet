import {Head, Link, useForm} from '@inertiajs/react';
import {Container} from "@/types/container";
import React, {FormEventHandler} from "react";
import WebLayout from "@/Layouts/WebLayout";
import {Card} from "@/types/Card/card";
import {Input} from "@/Components/ui/input";
import {Labels} from "@/Components/Labels";
import {Button} from "@headlessui/react";

export default function Edit({auth, title, card}: Container<{
    card: Card;
}>) {
    const form = useForm({
        message: card.message,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        form.put(route('cards.update', card));
    };

    return (
        <WebLayout
            auth={auth}
            title={title}
        >
            <Head title={title}/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

                        <div className="max-w-sm mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
                            <img className="w-full h-48 object-cover" src={card.image}
                                 alt="Image"/>

                            <Labels
                                id='message'
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
                        </div>

                        {card.user?.id === auth.user?.id &&
                            <div className="mt-4">
                                <Button
                                    className="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-500"
                                    onClick={submit}
                                >
                                    Update
                                </Button>

                                <Link
                                    className="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-500"
                                    href={route('cards.show', card.id)}
                                >
                                    Cancel
                                </Link>
                            </div>
                        }
                    </div>
                </div>
            </div>
        </WebLayout>
    );
}
