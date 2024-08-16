import {Head, useForm} from '@inertiajs/react';
import {Container} from "@/types/container";
import React from "react";
import WebLayout from "@/Layouts/WebLayout";
import {Card} from "@/types/Card/card";
import DangerButton from "@/Components/DangerButton";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Show({auth, title, card}: Container<{
    card: Card;
}>) {

    const form = useForm();

    const updateClick = () => {
        form.get(route('card.edit', card.id))
    }

    const deleteClick = () => {
        form.delete(route('card.destroy', card.id))
    }

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

                            <div className="p-4">
                                <p className="mt-2 text-gray-600">{card.message}</p>
                            </div>
                        </div>

                        {card.user_id === auth.user?.id ?
                            <div className="mt-4">
                                <PrimaryButton
                                    onClick={updateClick}
                                >
                                    Update
                                </PrimaryButton>

                                <DangerButton
                                    onClick={deleteClick}
                                >
                                    Delete
                                </DangerButton>
                            </div>
                            :
                            <></>
                        }
                    </div>
                </div>
            </div>
        </WebLayout>
    );
}
