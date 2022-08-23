import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import Spinner from "../component/Spinner";
import MTGApi from "../Service/MTGAPI";
import Extension from "./components/Extension";
import Card from "./components/Card";
import Pagination from "./components/Pagination";

const MTG = () => {

    const [extensions, setExtensions] = useState({});
    const [extensionSelected, setExtensionSelected] = useState("");
    const [cards, setCards] = useState({});
    const [pageCards, setPageCards] = useState(1);
    const [error, setError] = useState("");

    useEffect(() => {
        loadExtensions();
    }, []);
    useEffect(() => {
        setCards({});
        loadCards();
    }, [extensionSelected, setExtensionSelected, pageCards, setPageCards])

    // LOADING DATA
    const loadExtensions = () => {
        MTGApi.getExtensions().then(res => {
            if (typeof res === "object" && !res.hasOwnProperty("error")) {
                setExtensions(res);
            } else {
                setError(res.message)
            }
        });
    }
    const loadCards = () => {
        MTGApi.getCards(extensionSelected, pageCards).then(res => {
            if (typeof res === "object" && !res.hasOwnProperty("error")) {
                setCards(res);
            } else {
                setError(res.message)
            }
        });
    }

    // Action
    const handleSelectedExtension = useCallback((e) => {
        e.preventDefault();
        setExtensionSelected(e.currentTarget.dataset.extension_code);
        // loadCards(e.currentTarget.dataset.extension_code);
    });
    const handleClickEmptyData = useCallback((e) => {
        e.preventDefault();
        setCards({});
        setExtensionSelected("");
    });
    const handleSelectedPageCard = useCallback((e, page) => {
        setPageCards(page);
    })


    // View

    let renderView = <Spinner />;
    if (extensions.length && !extensionSelected.length) {
        renderView = <>
            <h1>Liste des extensions</h1>
            {
                extensions.map((value, key) => {
                    return <Extension key={key} extension={value} handleSelectedExtension={handleSelectedExtension} />
                })
            }
        </>
    }
    if (cards.length) {
        renderView = (
            <>
                <div className="col-12 d-flex">
                    <button type="button" className="btn btn-outline-info" onClick={handleClickEmptyData}>Retour</button>
                </div>
                <h1>Liste cartes pour l'extension : </h1>
                <div className="row row-cols-1 row-cols-md-3 g-4">
                    {cards.map((value, key) => {
                        return <Card key={key} card={value} />;

                    })}
                </div>
                <Pagination pageCards={pageCards} handleSelectedPageCard={handleSelectedPageCard} />
            </>
        );
    }
    if (error.length) {
        renderView = (
            <div className="alert alert-danger" role="alert">
                {error}
            </div>
        );
    }

    return (
        <div className="row">
            {renderView}
        </div>
    );
}

export default MTG;

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<MTG />);