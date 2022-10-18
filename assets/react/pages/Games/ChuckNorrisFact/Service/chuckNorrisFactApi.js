import ApiService from "../../../../Service/ApiService";
import routing from "../../../../Service/routing.json";


export default class ChuckNorrisFactApi extends ApiService {

	static async getRandom() {
		let url = new URL(routing.api_games_chuck_norris_facts_random_collection.path, window.location.origin);

		return await fetch(url, {
			method: "GET",
			headers: this.headers
		}).then(res => {
			if (res.ok) return res.json();
			return { "error": false, "message": "code error : " + res.status }
		})
	}

	static async put(id, fact) {
		let url = window.location.origin + routing.api_games_chuck_norris_facts_putCustom_item.path;
		url = url.replace("{id}", id);

		return await fetch(url, {
			method: "PUT",
			headers: {
				"Accept": "application/ld+json",
				"Content-Type": "application/ld+json",
			},
			body: JSON.stringify(fact)
		}).then(res => {
			if (res.ok) return res.json();
			return { "error": false, "message": "code error : " + res.status }
		})
	}

}