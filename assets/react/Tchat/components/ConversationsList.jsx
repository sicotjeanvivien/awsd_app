import React from "react";

const ConversationList = ({ conversations, handClickJoinConversation }) => {

    return conversations.map((value, key) => {
        let nameConversation = "";
        value.users.forEach(element => {
            nameConversation += element.username + " ";
        })
        return (
            <div className="text-bg-light border" key={key}
                data-conversation_id={value.id}
                onClick={e => handClickJoinConversation(e)}
            >
                <a href="#" type="button" >
                    {value.id} {nameConversation}
                </a>
            </div>
        )
    })
}

export default ConversationList;