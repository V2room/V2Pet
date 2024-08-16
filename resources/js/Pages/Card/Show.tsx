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

    const form = useForm({
        newComment: ''
    });

    const updateClick = () => {
        form.get(route('card.edit', card.id))
    }

    const deleteClick = () => {
        form.delete(route('card.destroy', card.id))
    }

    const storeComment = () => {

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

                        {/* 업데이트 삭제 버튼 */}
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

                        {/* 댓글 목록 */}
                        <div className="mt-6">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100">Comments</h3>
                            <div className="mt-4 space-y-4">
                                {card.comments.map((comment) => (
                                    <div key={comment.id} className="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                        <p className="text-gray-800 dark:text-gray-200">{comment.content}</p>
                                        <small className="text-gray-600 dark:text-gray-400">
                                            - {comment.user_id}
                                        </small>
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* 댓글 입력 폼 */}
                        <div className="mt-6">
                <textarea
                    className="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                    rows="3"
                    placeholder="Write a comment..."
                    value={form.data.newComment}
                ></textarea>
                            <div className="mt-4">
                                <PrimaryButton onClick={storeComment}>Submit</PrimaryButton>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </WebLayout>
    );
}
