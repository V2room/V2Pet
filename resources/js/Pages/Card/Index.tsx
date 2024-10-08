import {Head} from '@inertiajs/react';
import {Container} from "@/types/container";
import React, {useState} from "react";
import {CursorPagination} from "@/types/cursor-pagination";
import {Card} from "@/types/Card/card";
import PrimaryButton from "@/Components/PrimaryButton";
import WebLayout from "@/Layouts/WebLayout";

export default function Dashboard({
                                      auth,
                                      title,
                                      pagination,
                                  }: Container<{
    pagination: CursorPagination<Card>;
}>) {
    const [cards, setChats] = useState<Card[]>(
        pagination.data.sort((a, b) => a.id - b.id)
    );
    const [formError, setFormError] = useState(null);

    return (
        <WebLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{title}</h2>}
            auth={auth}
            title={title}
        >
            <Head title={title}/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <section className="max-w-xl">
                            {cards.map((card) => (
                                <div
                                    key={card.id}
                                >
                                    <img src={card.image} alt="Preview"
                                         style={{maxWidth: '100%', maxHeight: '200px'}}/>
                                    {card.message}
                                </div>
                            ))}

                        </section>
                    </div>

                    <div className="flex items-center gap-4">
                        <PrimaryButton
                            onClick={() => {
                                window.location.href = route('card.create');
                            }}
                        >
                            카드 등록
                        </PrimaryButton>
                    </div>
                </div>
            </div>
        </WebLayout>
    );
}
