import React, { useEffect, useState } from "react";

const Spinner = () => {

    const quotes = [
        {
            "citation": "Pour faire taire autrui, commence par te taire.",
            "auteur": "Sénèque",
        },
        {
            "citation": "C'est pendant l'orage qu'on connaît le pilote.",
            "auteur": "Sénèque",
        },
        {
            "citation": "Nécessairement, le hasard a beaucoup de pouvoir sur nous, puisque c'est par hasard que nous vivons.",
            "auteur": "Sénèque",
        },
        {
            "citation": "L'arbre devient solide sous le vent.",
            "auteur": "Sénèque",
        },
        {
            "citation": "L'essentiel est l'emploi de la vie, non sa durée",
            "auteur": "Sénèque",
        }
    ];

    const [quote, setQuote] = useState(quotes[Math.floor(Math.random() * quotes.length)])

    useEffect(() => {
        setInterval(() => {
            let index = Math.floor(Math.random() * quotes.length);
            setQuote(quotes[index]);

        }, 3000);
    })

    return (
        <div className="mt-5 row justify-content-center">
            <div className="col-12 d-flex justify-content-center">
                <div className="spinner-border" role="status">
                    <span className="visually-hidden">Loading...</span>
                </div>
            </div>
            <div className="col-6">
                <p className="text-center">“{quote.citation}”</p>
                <p className="text-end"><b>{quote.auteur}</b></p>
            </div>
        </div>
    )
}

export default Spinner;