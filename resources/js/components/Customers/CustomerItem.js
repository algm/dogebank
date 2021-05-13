import React from "react";
import Currency from "../Currency";

export default function CustomerItem({ customer }) {
    return (
        <div className="bg-gray-700 p-3 rounded-md">
            <h3 className="font-medium">{customer.name}</h3>
            <div>
                <Currency number={customer.balance} />
            </div>
            <div className="mt-3 text-gray-300 text-sm">
                Branch ID: {customer.branchId}
            </div>
            <div className="mt-3 text-gray-300 text-sm">id: {customer.id}</div>
        </div>
    );
}
