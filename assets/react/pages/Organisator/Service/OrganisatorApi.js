
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

	static async deletedTask(taskId) {

		let path = routing.api_organisator_tasks_delete_item.path;
		path = path.replace("{id}", taskId);
		let url = new URL(path, window.location.origin);

		return await fetch(url, {
			method: "DELETE",
			headers: this.headers
		}).then(res => {
			console.log(res);
			if (res.ok) return { "error": false, "message": "code error : " + res.status };
			return { "error": true, "message": "code error : " + res.status }
		})
	}

	static async patchTask(task) {
		let data = {
			"task": task.task,
			"weekNumber": task.weekNumber,
			"description": task.description,
			"making": task.making,
			"date": task.date
		}

		let path = routing.api_organisator_tasks_patch_item.path;
		path = path.replace("{id}", task.id);
		let url = new URL(path, window.location.origin)

		return await fetch(url, {
			method: "PATCH",
			headers: {
				"Accept": "application/ld+json",
				"Content-Type": "application/merge-patch+json",
			},
			body: JSON.stringify(data)
		}).then(res => {
			if (res.ok) return res.json();
			return { "error": true, "message": "code error : " + res.status }
		})
	}
}