import React, { useState } from "react";
import TextInput from "../Form/TextInput";
import SubmitButton from "../Form/SubmitButton";
import { useMutation } from "react-fetching-library";
import { v4 as uuid } from "uuid";

const createTransfer = (formValues) => ({
    method: "POST",
    endpoint: "/api/transfers",
    body: { ...formValues, id: uuid() },
});

export default function CreateForm({ onCreated }) {
    const [from, setFrom] = useState("");
    const [to, setTo] = useState("");
    const [amount, setAmount] = useState(0);
    const { loading, mutate, error: mutateError } = useMutation(createTransfer);

    const handleSubmit = async (e) => {
        e.preventDefault();

        await mutate({ from, to, amount: parseFloat(amount) });

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
                    value={from}
                    onChange={(e) => setFrom(e.target.value)}
                    label="From"
                />
                <TextInput
                    value={to}
                    onChange={(e) => setTo(e.target.value)}
                    label="To"
                />
                <TextInput
                    value={amount}
                    onChange={(e) => setAmount(e.target.value)}
                    label="Amount"
                />
                <SubmitButton>Create Transfer</SubmitButton>
            </form>
        </div>
    );
}
