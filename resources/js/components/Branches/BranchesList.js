import React, { useContext } from "react";
import CreateBranchForm from "./CreateForm";
import BranchItem from "./BranchItem";
import ApiContext from "../ApiContext";

export default function BranchesList() {
    const {
        branches: { loading, payload: branches, error, query },
    } = useContext(ApiContext);

    const {
        topBranches: {
            loading: topLoading,
            payload: topBranches,
            error: topError,
        },
    } = useContext(ApiContext);

    if (loading || topLoading) {
        return "loading...";
    }

    if (error || topError) {
        return "fetch error";
    }

    return (
        <div className="space-y-3 p-3 flex flex-col">
            <h1 className="text-2xl font-semibold">Branches</h1>
            <CreateBranchForm onCreated={() => query()} />
            {topBranches.length > 0 && (
                <div>
                    <h2 className="text-xl font-semibold">Top branches</h2>
                    <div className="pt-3 space-y-2 flex-grow overflow-y-auto">
                        {topBranches.map((branch) => (
                            <BranchItem key={branch.id} branch={branch} />
                        ))}
                    </div>
                </div>
            )}
            <div>
                <h2 className="text-xl font-semibold">All branches</h2>
                <div className="pt-3 space-y-2 flex-grow overflow-y-auto">
                    {branches.map((branch) => (
                        <BranchItem key={branch.id} branch={branch} />
                    ))}
                </div>
            </div>
        </div>
    );
}
