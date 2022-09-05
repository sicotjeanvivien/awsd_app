import routing from "./routing.json";

export default class TchatApi {

    constructor() {
        this.headers = {
            "accept": "application/Id+json"
        }
    };

    static async loadConversations() {

        let url = new URL(routing.api_tchat_conversations_get_collection.path, window.location.origin);

        return await fetch(url, {
            method: "GET",
            headers: this.headers
        }).then(res => {
            console.log(res);
            if (res.ok) return res.json();
            return { "error": false, "message": "code error : " + res.status }
        });
    };

}