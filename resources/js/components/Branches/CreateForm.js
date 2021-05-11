import React, { useState } from "react";
import TextInput from "../Form/TextInput";
import SubmitButton from "../Form/SubmitButton";
import { useMutation } from "react-fetching-library";
import { v4 as uuid } from "uuid";

const createBranch = (formValues) => ({
    method: "POST",
    endpoint: "/api/branches",
    body: { ...formValues, id: uuid() },
});

export default function CreateForm({ onCreated }) {
    const [location, setLocation] = useState("");
    const { loading, mutate, error: mutateError } = useMutation(createBranch);

    const handleSubmit = async (e) => {
        e.preventDefault();

        await mutate({ location });

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
                    value={location}
                    onChange={(e) => setLocation(e.target.value)}
                    label="Location"
                />
                <SubmitButton>Create Branch</SubmitButton>
            </form>
        </div>
    );
}
