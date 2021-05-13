import React from "react";

export default function Currency({ number }) {
    const formattedNumber = new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR",
    })
        .format(number)
        .replace("€", "");

    return <span>Ð {formattedNumber}</span>;
}
