import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import Spinner from "../component/Spinner";
import ConversationList from "./components/ConversationsList";
import TchatApi from "../Service/TchatApi";

import Chat from "./components/Chat";
import Security from "../Service/Security";
import Newconversation from "./components/NewConversation";

const Tchat = () => {

  const [socket, setSocket] = useState({});
  const [userConnected, setUserConnected] = useState({});
  const [conversation, setConversation] = useState([]);
  const [conversationSelected, setConversationSelected] = useState("");

  const [showChat, setShowChat] = useState(false);
  const [showNewConversation, setShowNewConversation] = useState(false);

  useEffect(() => {
    Security.checkIfUserIsConnected().then(async res => {
      setUserConnected(res);
      loadConversations(res.username);
      setSocket(await TchatApi.connectSocket());
    })
  }, []);


  // API
  const loadConversations = (username) => {
    TchatApi.loadConversations(username).then((res) => {
      setConversation(res["hydra:member"]);
    });
  };


  // Action 
  const handClickJoinConversation = useCallback(async (e) => {
    e.preventDefault();
    let room = e.currentTarget.dataset.conversation_id;
    let userConnected = window.awsdData.userConnected;
    if (userConnected !== "" && room !== "") {

      socket.emit("join_room", room);
      setConversationSelected(room);
      setUserConnected(userConnected);
      setShowNewConversation(false);
      setShowChat(true);
    }
  });
  const handClickNewConverstion = useCallback((e) => {
    e.preventDefault();
    setShowChat(false);
    setShowNewConversation(true);
  });
  const handClickCreateNewConversation = useCallback((e)=>{
    e.preventDefault();
    TchatApi.addConversation(data).then(res => {
      setConversation(res["hydra:member"]);
    });

  })

  return (
    <div className="App row mt-5">
      <div className="col-12 mb-3">
        <button type="button" className="btn rounded-0 btn-info"
          onClick={(e) => handClickNewConverstion(e)}
        >
          Nouvelle Conversation</button>
      </div>
      <div className="col-4">
        {
          conversation.length ?
            <ConversationList conversations={conversation}
              handClickJoinConversation={handClickJoinConversation}
            />
            :
            <Spinner />
        }
      </div>
      <div className="col-8 row">

        {showChat && (
          <Chat
            socket={socket}
            userConnected={userConnected}
            room={conversationSelected}
          />
        )}
        {
          showNewConversation && (
            <Newconversation />
          )
        }
      </div>
    </div>
  );
}

export default Tchat;
const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Tchat />);