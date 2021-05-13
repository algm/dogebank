import React, { useContext } from "react";
import CreateCustomerForm from "./CreateForm";
import CustomerItem from "./CustomerItem";
import ApiContext from "../ApiContext";

export default function CustomersList() {
    const {
        customers: { loading, payload: customers, error, query },
        branches: { query: updateBranches },
        topBranches: { query: updateTopBranches },
    } = useContext(ApiContext);

    if (loading) {
        return "loading...";
    }

    if (error) {
        return "fetch error";
    }

    return (
        <div className="space-y-3 p-3 flex flex-col">
            <h1 className="text-2xl font-semibold">Customers</h1>
            <CreateCustomerForm
                onCreated={() => {
                    query();
                    updateBranches();
                    updateTopBranches();
                }}
            />
            <div className="pt-3 space-y-2 flex-grow overflow-y-auto">
                {customers.map((customer) => (
                    <CustomerItem key={customer.id} customer={customer} />
                ))}
            </div>
        </div>
    );
}
