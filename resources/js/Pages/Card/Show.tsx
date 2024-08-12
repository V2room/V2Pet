import {Head} from '@inertiajs/react';
import {Container} from "@/types/container";
import React from "react";
import WebLayout from "@/Layouts/WebLayout";
import {Card} from "@/types/Card/card";

export default function Show({auth, title, card}: Container<{
    card: Card;
}>) {

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
                                <h2 className="text-xl font-semibold text-gray-800">Card Title</h2>
                                <p className="mt-2 text-gray-600">{card.message}</p>

                                <div className="mt-4">
                                    <a href="#"
                                       className="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-500">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </WebLayout>
    );
}
