import React from "react";
import BranchesList from "./Branches/BranchesList";
import { createClient, ClientContextProvider } from "react-fetching-library";
import logo from "../../images/dogecoin.png";

const responseInterceptor = () => async (action, response) => {
    if (response.payload.data) {
        return {
            ...response,
            payload: response.payload.data,
        };
    }

    return response;
};

const Client = createClient({
    responseInterceptors: [responseInterceptor],
});

export default function App() {
    return (
        <ClientContextProvider client={Client}>
            <div className="bg-purple-900 flex flex-row items-center space-x-3 px-3 py-2">
                <div>
                    <img
                        src={logo}
                        className="w-[55px] h-[55px]"
                        alt="dogecoin"
                    />
                </div>
                <h1 className="text-xl font-bold text-white">DOGEBANK</h1>
            </div>
            <div className="text-white flex flex-row items-stretch flex-grow">
                <BranchesList />
            </div>
        </ClientContextProvider>
    );
}
