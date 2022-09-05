import { createRoot } from "react-dom/client";
import React, { useEffect, useState } from "react";

import Spinner from "../component/Spinner"
import TchatApi from "../Service/TchatApi";

const Tchat = () => {

    const [conversations, setConversations] = useState([]);

    useEffect(() => {
        TchatApi.loadConversations().then(res => {
            console.log(res);
            setConversations(res["hydra:member"])
        });
    }, [])

    // API

    // Action

    // View
    let renderView = <Spinner />;

    return (
        <>
            <h1 className="text-center">Tchat Infini</h1>
            <div className="row">
                {renderView}
            </div>
        </>
    )
}

export default Tchat;


const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Tchat />);