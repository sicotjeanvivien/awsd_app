import React, { useCallback, useEffect, useState } from "react";
import TchatApi from "../Service/TchatApi";

const Newconversation = ({ addConversation, userConnected }) => {

    const [users, setUsers] = useState([]);
    const [nameConversation, setNameConversation] = useState("");
    const [usersSelected, setUsersSelected] = useState([]);

    useEffect(() => {
        loadUsers();
    }, []);

    // API
    const loadUsers = () => {
        TchatApi.getUsers().then(res => {
            setUsers(res["hydra:member"])
        });
    };

    // Action
    const handleClickSubmitNewconversation = useCallback((e) => {
        e.preventDefault();
        let conversationData = {
            "name": nameConversation,
            "users": [...usersSelected, userConnected["@id"]],
        };
        if (nameConversation && usersSelected.length) {   
            addConversation(conversationData);
        }
    });
    const handleChangeNameInForm = useCallback((e) => {
        e.preventDefault();
        setNameConversation(e.target.value);
    });
    const handleClickCheckbox = useCallback((e) => {
        let usersChecked = [];
        document.querySelectorAll(".js_tchatConversation_new_form_user").forEach((value, key) => {
            if (value.checked) usersChecked = [...usersChecked, value.value];
        });
        setUsersSelected(usersChecked);
    });

    return <>
        <div className="col-12">
            <form>
                <div className="mb-3">
                    <label htmlFor="js_tchatConversation_new_form_name" className="form-label">Nom</label>
                    <input type="text" className="form-control" id="js_tchatConversation_new_form_name" aria-describedby="emailHelp" onChange={e => handleChangeNameInForm(e)} />
                </div>
                {
                    users.map((value, key) => {
                        if (value.username !== userConnected.username) {
                            return (
                                <div key={key} className="form-check">
                                    <input className="form-check-input js_tchatConversation_new_form_user"
                                        type="checkbox" value={value["@id"]}
                                        id={"js_tchatConversation_new_form_user" + value.id}
                                        onClick={e => handleClickCheckbox(e)}
                                    />
                                    <label className="form-check-label" htmlFor={"js_tchatConversation_new_form_user" + value.id}>
                                        {value.username}
                                    </label>
                                </div>
                            )
                        }
                    })
                }
                <button type="button" className="btn btn-primary"
                    onClick={e => handleClickSubmitNewconversation(e)}
                >Créer</button>
            </form>
        </div>
    </>
}

export default Newconversation;