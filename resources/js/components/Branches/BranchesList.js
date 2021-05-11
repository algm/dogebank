import React from "react";
import { useQuery } from "react-fetching-library";
import CreateBranchForm from "./CreateForm";
import BranchItem from "./BranchItem";

const fetchBranchesList = {
    method: "GET",
    endpoint: "/api/branches",
};

export default function BranchesList() {
    const {
        loading,
        payload: branches,
        error,
        query,
    } = useQuery(fetchBranchesList);

    if (loading) {
        return "loading...";
    }

    if (error) {
        return "fetch error";
    }

    return (
        <div className="space-y-3 p-3">
            <h1 className="text-2xl font-semibold">Branches</h1>
            <CreateBranchForm onCreated={() => query()} />
            <div className="pt-3 space-y-2">
                {branches.map((branch) => (
                    <BranchItem key={branch.id} branch={branch} />
                ))}
            </div>
        </div>
    );
}
