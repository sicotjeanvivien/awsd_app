export default class TwitchApi {

    constructor() {
        this.a = 2;
        this.url = new URL("", "https://api.twitch.tv");
        this.headers = {
            "Authorization": "Bearer 0l3c15w1ko3ut4i2g80fnkv3jx1wxx",
            "Client-Id": "mkbe1ixu699uhgewc07snypkngj15v"
        }
    }

    searchChannel(query) {

        let url = new URL("/helix/search/channels", this.url);
        url.searchParams.set("query", query);
        url.searchParams.set("live_only", "true");

        return fetch(url, {
            method: "GET",
            headers: this.headers
        }).then(res => res.json()).then(res => {
            return res;
        });

    }

}