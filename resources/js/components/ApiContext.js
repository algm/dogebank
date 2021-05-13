import React, { createContext } from "react";
import { useQuery } from "react-fetching-library";

const ApiContext = createContext({});

const fetchBranchesList = {
    method: "GET",
    endpoint: "/api/branches",
};

const topBranchesList = {
    method: "GET",
    endpoint: "/api/branches/top",
};

const fetchCustomersList = {
    method: "GET",
    endpoint: "/api/customers",
};

export function ApiContextProvider({ children }) {
    const contextValue = {
        branches: useQuery(fetchBranchesList),
        topBranches: useQuery(topBranchesList),
        customers: useQuery(fetchCustomersList),
    };

    return (
        <ApiContext.Provider value={contextValue}>
            {children}
        </ApiContext.Provider>
    );
}

export default ApiContext;
