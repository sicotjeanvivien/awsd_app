import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import Spinner from "../component/Spinner";
import MTGApi from "../Service/MTGAPI";
import ExtensionCard from "./components/ExtensionCard";

const MTG = () => {

    const [extensions, setExtensions] = useState({});
    const [error, setError] = useState("");

    useEffect(() => {
        loadExtensions();
    }, [])

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
    const loadExtension = (extension) =>{
        
    }


    // Vieaw

    let renderView = <Spinner />;
    if (extensions.length) {
        renderView = <>
            {
                extensions.map((value, key) => {
                    return <ExtensionCard key={key} extension={value} />
                })
            }
        </>
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
            <h1>Liste des extensions</h1>
            {renderView}
        </div>

    );
}

export default MTG;

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<MTG />);