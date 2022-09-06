import React from "react";

const ConversationList = ({ conversations, handClickLoadMessages }) => {

    let renderViewConversation = conversations.map((value, key) => {
        let nameConversation = "";
        value.users.forEach(element => {
            nameConversation += element.username + " ";
        })
        return (
            <a href="#" type="button" key={key} data-conversation_id={value.id} onClick={e => handClickLoadMessages(e)}>
                <div>
                    {value.id} {nameConversation}
                </div>
            </a>
        )
    })

    return (
        <>
            <div className="col-4">
                {renderViewConversation}
            </div>
            <div className="col-8">
                message
            </div>
        </>
    )
}

export default ConversationList;