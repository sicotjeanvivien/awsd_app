
import ApiService from "../../../Service/ApiService";
import routing from "../../../Service/routing.json"

export default class OrganisatorApi extends ApiService {

    static getOrganisatorTask(weekNumber) {

        console.log("start fetch data");
        let url = new URL(routing.api_organisator_tasks_collection.path, window.location.origin);
        url.searchParams.append("weekNumber", weekNumber)
        
        return fetch(url, {
            method: "GET",
            headers: this.headers
        }).then(res => {
            if (res.ok) return res.json();
            return { "error": false, "message": "code error : " + res.status }
        })
    }


}