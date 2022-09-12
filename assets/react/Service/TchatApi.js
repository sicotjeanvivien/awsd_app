import routing from "./routing.json";
import io from "socket.io-client";

export default class TchatApi {

  constructor() {
    this.headers = {
      "Accept": "application/ld+json",
      "Content-Type": "application/ld+json",
    };
  };

  static connectSocket() {
    // return io.connect("http://localhost:3033");
    return io.connect("https://tchat.awsd.fr:3033");
  }

  // CONVERSATITION
  static async loadConversations(username) {
    console.log(username);
    let url = new URL(routing.api_tchat_conversations_get_collection.path, window.location.origin);
    url.searchParams.append("users.username", username)
    return await fetch(url, {
      method: "GET",
      headers: this.headers
    }).then(res => {
      if (res.ok) return res.json();
      return { "error": false, "message": "code error : " + res.status }
    });
  };
  static async addConversation(converstaionData) {
    let url = routing.api_tchat_conversations_post_collection.path;
    return await fetch(url, {
      method: "POST",
      headers: {
        "Accept": "application/ld+json",
        "Content-Type": "application/ld+json",
      },
      body: JSON.stringify(converstaionData)
    }).then(res => {
      if (res.ok) return res.json();
      return { "error": false, "message": "code error : " + res.status }
    });
  }

  // MESSAGES
  static async loadMessages(conversation_id) {
    let url = new URL(routing.api_tchat_messages_get_collection.path, window.location.origin);
    url.searchParams.append("tchatConversation.id", conversation_id);
    return await fetch(url, {
      method: "GET",
      headers: this.headers
    }).then(res => {
      if (res.ok) return res.json();
      return { "error": false, "message": "code error : " + res.status }
    });
  }

  static async addMessage(messageData) {

    let user = routing.api_users_get_item.path;
    let tchatConversation = routing.api_tchat_conversations_get_item.path;

    let data = {
      "content": messageData.content,
      "user": user.replace("{id}", messageData.user.id),
      "tchatConversation": tchatConversation.replace("{id}", messageData.room),
      "created": "2022-09-08T13:59:30+02:00",
      "updated": "2022-09-08T13:59:30+02:00"
    };

    let url = new URL(routing.api_tchat_messages_post_collection.path, window.location.origin);
    return await fetch(url, {
      method: "POST",
      headers: {
        "Accept": "application/ld+json",
        "Content-Type": "application/ld+json",
      },
      body: JSON.stringify(data)
    }).then(res => {
      if (res.ok) return res.json();
      return { "error": false, "message": "code error : " + res.status }
    });

  }

  // USER
  static async getUsers() {
    let url = routing.api_users_get_collection.path;
    return await fetch(url, {
      method: "GET",
      headers: this.headers
    }).then(res => {
      if (res.ok) return res.json();
      return { "error": false, "message": "code error : " + res.status }
    })
  }

}