import React from "react";
import Currency from "../Currency";

export default function BranchItem({ branch }) {
    return (
        <div className="bg-gray-700 p-3 rounded-md">
            <h3 className="font-medium">{branch.location} Branch</h3>
            <div>
                Top <Currency number={branch.maxBalance} />
            </div>
            <div className="mt-3 text-gray-300 text-sm">id: {branch.id}</div>
        </div>
    );
}
