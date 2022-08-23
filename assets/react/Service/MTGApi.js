import routing from "../Service/routing.json";

export default class MTGApi {

    static async getExtensions() {
        let url = routing.api_mtg_sets_get_collection.path ;
        return await fetch(url, {
            method: "GET",
            headers: {
                "accept" : "application/json"
            }
        }).then(res => {
            if (res.ok) return res.json();
            return {"error" :  false, "message" : "code error : " + res.status}
        });
    }

    static async getCards() {
        let url = routing.api_mtg_cards_get_collection
    }
}