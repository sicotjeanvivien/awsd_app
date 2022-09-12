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
  const [showconversationList, setShowconversationList] = useState(false);
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

    setShowconversationList(false)
    TchatApi.loadConversations(username).then((res) => {
      setConversation(res["hydra:member"]);
      setShowconversationList(true)
    });
  };
  const addConversation = (conversationData) => {
    console.log("start add converstion");
    TchatApi.addConversation(conversationData).then(res => {
        console.log(res);
        loadConversations(userConnected.username);
        console.log(res.id);
        handClickJoinConversation(res.id + '');
    });
};


  // Action 
  const handClickJoinConversation = useCallback(async (room) => {
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

  return (
    <div className="App row mt-5">
      <div className="col-4">
        <button type="button" className="btn rounded-0 btn-info mb-3"
          onClick={(e) => handClickNewConverstion(e)}
        >
          Nouvelle Conversation</button>
        {
          showconversationList ?
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
            <Newconversation  addConversation={addConversation} userConnected={userConnected} />
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