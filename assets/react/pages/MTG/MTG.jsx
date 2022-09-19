import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import MTGApi from "./Service/MTGApi";
import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";

import Spinner from "../../component/Spinner";
import CardDetail from "./components/CardDetail";
import Extensions from "./components/Extensions";
import Cards from "./components/Cards";
import Error from "./components/Error";


const MTG = () => {

    const [userConnected, setUserConnected] = useState({});
    const [extensions, setExtensions] = useState({});
    const [extensionSelected, setExtensionSelected] = useState({});
    const [cards, setCards] = useState({});
    const [cardDetail, setCardDetail] = useState({});
    const [pageCards, setPageCards] = useState(1);
    const [lastPageCards, setLastPageCards] = useState(2);
    const [error, setError] = useState("");

    useEffect(() => {
        loadExtensions();
    }, []);
    useEffect(() => {
        setCards({});
        if (extensionSelected.code && extensionSelected.code.length) {
            loadCards();
        }
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
        MTGApi.getCards(extensionSelected.code, pageCards).then(res => {
            if (typeof res === "object" && !res.hasOwnProperty("error")) {
                let urltest = new URL(res["hydra:view"]["hydra:last"], location.origin);
                setLastPageCards(urltest.searchParams.get("page"));
                setCards(res["hydra:member"]);
            } else {
                setError(res.message)
            }
        });
    }
    const loadCard = (id) => {
        MTGApi.getCard(id).then((res) => {
            setCardDetail(res);
        });
    }

    // Action
    const handleSelectedExtension = useCallback((e) => {
        e.preventDefault();
        extensions.map((value, key) => {
            if (value.code === e.currentTarget.dataset.extension_code) {
                setExtensionSelected(value);
            }
        })
    });
    const handleClickEmptyData = useCallback((e) => {
        e.preventDefault();
        setCards({});
        setCardDetail({});
        setPageCards(1);
        setExtensionSelected({});
    });
    const handleClickEmptyCardDetail = useCallback((e) => {
        setCardDetail({});
    })
    const handleSelectedPageCard = useCallback((e, page) => {
        setPageCards(page);
    })
    const handleClickCardDetail = useCallback((e) => {
        e.preventDefault();
        loadCard(e.currentTarget.dataset.id);
    })


    // View

    let renderView = <Spinner />;
    if (extensions.length && !extensionSelected.code) {
        renderView = (
            <Extensions
                extensions={extensions}
                handleSelectedExtension={handleSelectedExtension}
            />
        );
    }
    if (cards.length && !cardDetail.id) {
        renderView = (
            <Cards
                extensionSelected={extensionSelected}
                cards={cards}
                pageCards={pageCards}
                lastPageCards={lastPageCards}
                handleClickCardDetail={handleClickCardDetail}
                handleSelectedPageCard={handleSelectedPageCard}
                handleClickEmptyData={handleClickEmptyData}
            />
        );
    }
    if (cardDetail.id) {
        renderView = (
            <CardDetail
                cardDetail={cardDetail}
                handleClickEmptyCardDetail={handleClickEmptyCardDetail}
            />
        );
    }
    if (error.length) {
        renderView = (
            <Error message={error} />
        );
    }

    return (
        <>
            <Header userConnected={userConnected} setUserConnected={setUserConnected} />
            <div className="row">
                {renderView}
            </div>
            <Footer />
        </>
    );
}

export default MTG;

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<MTG />);