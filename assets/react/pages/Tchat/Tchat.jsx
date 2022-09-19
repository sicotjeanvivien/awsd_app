import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import TchatApi from "../../Service/TchatApi";

import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";
import Spinner from "../../component/Spinner";
import Chat from "./components/Chat";
import Newconversation from "./components/NewConversation";
import ConversationList from "./components/ConversationsList";


const Tchat = () => {

  const [socket, setSocket] = useState({});
  const [userConnected, setUserConnected] = useState({});
  const [conversation, setConversation] = useState([]);
  const [conversationSelected, setConversationSelected] = useState("");

  const [showChat, setShowChat] = useState(false);
  const [showconversationList, setShowconversationList] = useState(false);
  const [showNewConversation, setShowNewConversation] = useState(false);

  useEffect(() => {
    setSocket( TchatApi.connectSocket());
    loadConversations(userConnected.username);
  }, [userConnected]);


  // API
  const loadConversations = (username) => {

    setShowconversationList(false)
    TchatApi.loadConversations(username).then((res) => {
      setConversation(res["hydra:member"]);
      setShowconversationList(true)
    });
  };
  const addConversation = (conversationData) => {
    TchatApi.addConversation(conversationData).then(res => {
      loadConversations(userConnected.username);
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
    <>
      <Header userConnected={userConnected} setUserConnected={setUserConnected} />
      <main className="container">
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
                <Newconversation addConversation={addConversation} userConnected={userConnected} />
              )
            }
          </div>
        </div>
      </main>
      <Footer />
    </>
  );
}

export default Tchat;
const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Tchat />);