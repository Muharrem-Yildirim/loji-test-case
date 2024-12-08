import { Button } from "@/components/ui/button";
import { toast } from "@/hooks/use-toast";
import Guest from "@/Layouts/GuestLayout";
import { PageProps } from "@/types";
import { Head, router } from "@inertiajs/react";
import { useState } from "react";

export default function Home() {
    return (
        <>
            <Head title="Home" />

            <div>
                <div className="flexflex-col items-center justify-center py-12 px-6 lg:px-8">
                    <div className="sm:mx-auto sm:w-full sm:max-w-sm">
                        <h2 className="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                            Home
                        </h2>
                    </div>
                    <MakeRequest />
                </div>
            </div>
        </>
    );
}

const MakeRequest = () => {
    const [traceId, setTraceId] = useState("");

    const sendRequest = () => {
        router.post(
            route("home.store"),
            {},
            {
                // onSuccess: (res: PageProps & { data: { traceId: string } }) => {
                //     setTraceId(res.data.traceId);
                // },
                onError: () => {
                    setTraceId("");
                    toast({
                        title: "Error",
                        description: "Something went wrong",
                    });
                },
            }
        );
    };

    return (
        <div className="flex flex-col items-center justify-center py-12 px-6 lg:px-8">
            <div className="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 className="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    Make Request
                </h2>
            </div>
            <Button className="mt-10" onClick={sendRequest}>
                Send
            </Button>
        </div>
    );
};
