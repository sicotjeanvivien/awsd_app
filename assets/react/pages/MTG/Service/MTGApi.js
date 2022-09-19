import routing from "../../../Service/routing.json";

export default class MTGApi {

    constructor() {
        this.headers = {
            "accept": "application/Id+json"
        };
    }

    static async getExtensions() {
        let url = routing.api_mtg_sets_get_collection.path;
        return await fetch(url, {
            method: "GET",
            headers: {
                "accept": "application/json"
            }
        }).then(res => {
            if (res.ok) return res.json();
            return { "error": false, "message": "code error : " + res.status }
        });
    }

    static async getCards(mtgSet_code, page) {
        let url = new URL(routing.api_mtg_cards_get_collection.path, window.location.origin);
        url.searchParams.append("mtgSet.code", mtgSet_code);
        url.searchParams.append("page", page);
        return await fetch(url, {
            method: "GET",
            headers: this.headers
        }).then(res => {
            if (res.ok) return res.json();
            return { "error": false, "message": "code error : " + res.status }
        });
    }

    static async getCard(id) {
        let url = window.location.origin + routing.api_mtg_cards_get_item.path;
        url = url.replace("{id}", id);
        return await fetch(url, {
            method: "GET",
            headers: this.headers
        }).then(res => {
            if (res.ok) return res.json();
            return { "error": false, "message": "code error : " + res.status }
        })
    }
}