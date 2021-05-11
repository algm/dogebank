import React from "react";

export default function BranchItem({ branch }) {
    return (
        <div className="bg-gray-700 p-3 rounded-md">
            <h3 className="font-medium">{branch.location} Branch</h3>
            <span>Top Ð {branch.maxBalance}</span>
        </div>
    );
}
