import {Head, useForm} from '@inertiajs/react';
import {Container} from "@/types/container";
import React, {ChangeEvent, useState} from "react";
import WebLayout from "@/Layouts/WebLayout";
import {Card} from "@/types/Card/card";
import DangerButton from "@/Components/DangerButton";
import PrimaryButton from "@/Components/PrimaryButton";
import {Comment} from "@/types/Card/comment";

export default function Show({auth, title, card}: Container<{
    card: Card;
}>) {
    const [newComment, setNewComment] = useState('');

    const form = useForm({
        message: ''
    });


    const updateClick = () => {
        form.get(route('cards.edit', card.id))
    }

    const deleteClick = () => {
        form.delete(route('cards.destroy', card.id))
    }

    const storeComment = () => {
        form.data.message = newComment;
        form.post(route('cards.comments.store', card.id))
        setNewComment('');
    }

    const deleteCommentClick = (comment: Comment) => {
        form.delete(route('cards.comments.destroy', {
            card: card.id,
            comment: comment.id
        }))
    }

    const handleCommentChange = (e: ChangeEvent<HTMLTextAreaElement>) => {
        setNewComment(e.target.value);
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
                        {card.user?.id === auth.user?.id ?
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
                                        <small className="text-gray-600 dark:text-gray-400">
                                            - {comment.user.name}
                                        </small>
                                        <p className="text-gray-800 dark:text-gray-200">{comment.message}</p>

                                        {/* 댓글 업데이트 삭제 버튼 */}
                                        {comment.user.id === auth.user?.id ?
                                            <div className="mt-4">
                                                <DangerButton
                                                    onClick={() => deleteCommentClick(comment)}
                                                >
                                                    Delete
                                                </DangerButton>
                                            </div>
                                            :
                                            <></>
                                        }
                                    </div>
                                ))}
                            </div>
                        </div>

                        {/* 댓글 입력 폼 */}
                        <div className="mt-6">
                <textarea
                    className="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
                    placeholder="Write a comment..."
                    rows={3}
                    value={newComment}
                    onChange={handleCommentChange}
                ></textarea>
                            <div className="mt-4">
                                <PrimaryButton onClick={storeComment}>댓글 등록</PrimaryButton>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </WebLayout>
    );
}
