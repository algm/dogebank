import React from "react";

export default function SubmitButton({ children, ...rest }) {
    return (
        <button
            type="submit"
            {...rest}
            className="p-2 border border-purple-700 bg-purple-900 rounded-md text-sm"
        >
            {children}
        </button>
    );
}
