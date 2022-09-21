
import ApiService from "../../../Service/ApiService";
import routing from "../../../Service/routing.json"

export default class OrganisatorApi extends ApiService {

	static async getOrganisatorTask(weekNumber) {
		let url = new URL(routing.api_organisator_tasks_collection.path, window.location.origin);
		url.searchParams.append("weekNumber", weekNumber)
		return await fetch(url, {
			method: "GET",
			headers: this.headers
		}).then(res => {
			if (res.ok) return res.json();
			return { "error": false, "message": "code error : " + res.status }
		})
	}

	static async postOrganisationTask(data) {
		let url = new URL(routing.api_organisator_tasks_post_collection.path, window.location.origin);
		return await fetch(url, {
			method: "POST",
			headers: {
				"Accept": "application/ld+json",
				"Content-Type": "application/ld+json",
			},
			body: JSON.stringify(data)
		}).then(res => {
			if (res.ok) return res.json();
			return { "error": true, "message": "code error : " + res.status }
		})
	}


}