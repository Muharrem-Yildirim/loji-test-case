import { Button } from "@/components/ui/button";
import { toast } from "@/hooks/use-toast";
import { PageProps } from "@/types";
import { Head, router } from "@inertiajs/react";
import { useState } from "react";

export default function Home({
    errors,
    traceId = null,
}: PageProps & { error?: string; traceId?: string | null }) {
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
                    <MakeRequest traceId={traceId} />
                </div>
            </div>
        </>
    );
}

const MakeRequest = ({ traceId = null }: { traceId?: string | null }) => {
    const sendRequest = () => {
        router.post(
            route("home.store"),
            {},
            {
                onSuccess: ({ props }) => {
                    console.log(props);
                    toast({
                        title: "Success",
                        description: (
                            <span
                                dangerouslySetInnerHTML={{
                                    __html:
                                        (props?.serviceResponse as string) ??
                                        "Request successfuly sent.",
                                }}
                            ></span>
                        ),
                    });
                },
                onError: (errors) => {
                    toast({
                        title: "Error",
                        description: errors.error,
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
            {traceId && <p>Trace ID: {traceId}</p>}
            <Button className="mt-10" onClick={sendRequest}>
                Send
            </Button>
        </div>
    );
};
