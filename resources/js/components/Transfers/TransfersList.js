import React, { useContext } from "react";
import CreateTransferForm from "./CreateForm";
import ApiContext from "../ApiContext";

export default function TransfersList() {
    const {
        customers: { query },
        branches: { query: updateBranches },
        topBranches: { query: updateTopBranches },
    } = useContext(ApiContext);

    return (
        <div className="space-y-3 p-3 flex flex-col">
            <h1 className="text-2xl font-semibold">Transfer</h1>
            <CreateTransferForm
                onCreated={() => {
                    query();
                    updateBranches();
                    updateTopBranches();
                }}
            />
        </div>
    );
}
