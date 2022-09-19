import React, { useEffect, useRef, useState } from "react";
import TchatApi from "../../../Service/TchatApi";

const Chat = ({ socket, userConnected, room }) => {

  const [currentMessage, setCurrentMessage] = useState("");
  const [messageList, setMessageList] = useState([]);

  useEffect(() => {
    loadMessages(room);
  }, [room]);

  useEffect(() => {
    socket.on("receive_message", (data) => {
      setMessageList((list) => [...list, data]);
    });
  }, [socket]);

  useEffect(()=>{
    scrollTopDown();
  }, [messageList])

  const loadMessages = (conversation_id) => {
    TchatApi.loadMessages(conversation_id).then(res => {
      if (!res.error) setMessageList(res["hydra:member"]);
    })
  };

  const sendMessage = async () => {
    if (currentMessage !== "") {
      const messageData = {
        room: room,
        user: userConnected,
        content: currentMessage,
        created:
          new Date(Date.now()).getHours() +
          ":" +
          new Date(Date.now()).getMinutes(),
      };
      console.log(messageList);
      TchatApi.addMessage(messageData);
      await socket.emit("send_message", messageData);
      console.log(messageData);
      setMessageList((list) => [...list, messageData]);
      setCurrentMessage("");
    }
  };

  const scrollTopDown = ()=>{
    let windowScroll = document.querySelector(".message-container");
    let windowSize = windowScroll.scrollHeight
    windowScroll.scroll({
      top: windowSize,
      left: 100,
      behavior: 'smooth'
    });
  }


  return (
    <div className="chat-window">
      <div className="chat-header">
        <p>Live Chat</p>
      </div>
      <div className="chat-body">
        <div className="message-container">
          {messageList.map((messageContent, key) => {
            return (
              <div
                key={key}
                className="message"
                id={userConnected.username === messageContent.user.username ? "you" : "other"}
              >
                <div>
                  <div className="message-content">
                    <p>{messageContent.content}</p>
                  </div>
                  <div className="message-meta">
                    <p id="time">{messageContent.created}</p>
                    <p id="author">{messageContent.user.username}</p>
                  </div>
                </div>
              </div>
            );
          })}
        </div>
      </div>
      <div className="chat-footer">
        <input
          type="text"
          value={currentMessage}
          placeholder="Hey..."
          onChange={(event) => {
            setCurrentMessage(event.target.value);
          }}
          onKeyPress={(event) => {
            event.key === "Enter" && sendMessage();
          }}
        />
        <button onClick={sendMessage}>&#9658;</button>
      </div>
    </div>
  );
}

export default Chat;