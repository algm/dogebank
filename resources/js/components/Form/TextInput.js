import React from "react";
import uniqid from "uniqid";

export default function TextInput({ label, value, onChange }) {
    const inputId = uniqid();

    return (
        <div className="space-y-2">
            <label className="block" htmlFor={inputId}>
                {label}
            </label>
            <input
                className="bg-gray-600 text-gray-200 py-1 px-3 rounded-sm"
                id={inputId}
                type="text"
                value={value}
                onChange={onChange}
            />
        </div>
    );
}
