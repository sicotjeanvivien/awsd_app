import routing from "../Service/routing.json";

export default class Security {

    static async checkIfUserIsConnected() {
        return await fetch(routing.security_check.path, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
        }
        ).then(res => {
            if (res.ok) return res.json();
        });
    }

    static async login(data) {
        return await fetch(routing.security_login.path, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        }).then(res => res.json())
    }

    static async signin(data) {
        return await fetch(routing.security_signin.path, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        }).then(res => res.json())
    }
}