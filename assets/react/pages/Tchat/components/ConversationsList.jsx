import React from "react";

const ConversationList = ({ conversations, handClickJoinConversation }) => {

	return conversations.length ? conversations.map((value, key) => {
		return (
			<div className="text-bg-light border" key={key}
				data-conversation_id={value.id}
				onClick={e => handClickJoinConversation(e.currentTarget.dataset.conversation_id)}
			>
				<a href="#" type="button" >
					<div>{value.id} : {value.name} </div>
					<p>{
						value.users.map((element, key) => {
							return (<span key={key} className="me-1 badge text-bg-dark">{element.username}</span>);
						})
					}
					</p>
				</a>
			</div>
		)
	})
		:
		<div>Pas de conversation</div>
}

export default ConversationList;