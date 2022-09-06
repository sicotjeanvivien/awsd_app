import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import Spinner from "../component/Spinner"
import TchatApi from "../Service/TchatApi";
import ConversationList from "./components/ConversationsList";

const Tchat = () => {

    const [conversations, setConversations] = useState([]);

    useEffect(() => {
        loadConversations();
    }, [])

    // API
    const loadConversations = () => {
        TchatApi.loadConversations().then(res => {
            setConversations(res["hydra:member"])
        });
    }
    const loadMessages = (conversation_id) => {
        TchatApi.loadMessages(conversation_id).then(res => {
            console.log(res);
        })
    }

    // Action
    const handClickLoadMessages = useCallback((e) => {
        e.preventDefault();
        loadMessages(e.currentTarget.dataset.conversation_id);
    })
    // View
    let renderView = <Spinner />;
    if (conversations.length) {
        renderView = <ConversationList conversations={conversations} handClickLoadMessages={handClickLoadMessages} />
    }

    return (
        <>
            <h1 className="text-center">Tchat Infini</h1>
            <div className="row text-bg-light">
                {renderView}
            </div>
        </>
    )
}

export default Tchat;


const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Tchat />);