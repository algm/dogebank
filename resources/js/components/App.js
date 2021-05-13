import React from "react";
import BranchesList from "./Branches/BranchesList";
import { ClientContextProvider } from "react-fetching-library";
import logo from "../../images/dogecoin.png";
import CustomersList from "./Customers/CustomersList";
import Client from "../api/client";
import { ApiContextProvider } from "./ApiContext";
import TransfersList from "./Transfers/TransfersList";

export default function App() {
    return (
        <ClientContextProvider client={Client}>
            <ApiContextProvider>
                <div className="bg-purple-900 flex flex-row items-center space-x-3 px-3 py-2 sticky top-0">
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
                    <CustomersList />
                    <TransfersList />
                </div>
            </ApiContextProvider>
        </ClientContextProvider>
    );
}
