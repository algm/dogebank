import { createClient } from "react-fetching-library";

const responseInterceptor = () => async (action, response) => {
    if (response.payload.data) {
        return {
            ...response,
            payload: response.payload.data,
        };
    }

    return response;
};

const Client = createClient({
    responseInterceptors: [responseInterceptor],
});

export default Client;
