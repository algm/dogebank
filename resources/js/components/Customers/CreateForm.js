import React, { useState } from "react";
import TextInput from "../Form/TextInput";
import SubmitButton from "../Form/SubmitButton";
import { useMutation } from "react-fetching-library";
import { v4 as uuid } from "uuid";

const createCustomer = (formValues) => ({
    method: "POST",
    endpoint: "/api/customers",
    body: { ...formValues, id: uuid() },
});

export default function CreateForm({ onCreated }) {
    const [name, setName] = useState("");
    const [branchId, setBranchId] = useState("");
    const [balance, setBalance] = useState(0);
    const { loading, mutate, error: mutateError } = useMutation(createCustomer);

    const handleSubmit = async (e) => {
        e.preventDefault();

        await mutate({ name, branchId, balance });

        if (onCreated) {
            onCreated();
        }
    };

    if (loading) {
        return "loading...";
    }

    if (mutateError) {
        return "Creation failed with error";
    }

    return (
        <div className="space-y-3">
            <h2 className="font-semibold">Create branch</h2>
            <form onSubmit={handleSubmit} className="space-y-3">
                <TextInput
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    label="Name"
                />
                <TextInput
                    value={branchId}
                    onChange={(e) => setBranchId(e.target.value)}
                    label="Branch ID"
                />

                <TextInput
                    value={balance}
                    onChange={(e) => setBalance(e.target.value)}
                    label="Initial Balance"
                />
                <SubmitButton>Create Customer</SubmitButton>
            </form>
        </div>
    );
}
