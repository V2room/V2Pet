import {Container} from "@/types/container";
import WebLayout from "@/Layouts/WebLayout";
import {Head} from "@inertiajs/react";

export default function Dashboard({auth}: Container) {
    return (
        <WebLayout
            auth={auth}
            title={'Dashboard'}
        >
            <Head title="Dashboard"/>

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            V2Pet 에 오신걸 환영합니다.
                        </div>
                    </div>
                </div>
            </div>
        </WebLayout>
    );
}
