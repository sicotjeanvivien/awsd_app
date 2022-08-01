import React, { useState, useCallback } from "react";

const Connexion = () => {

  const [modalHidden, setModelHidden] = useState("d-none");
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");

  const handleClickShow = useCallback(() => {
    setModelHidden("d-block");
  })
  const handleClickHidden = useCallback(() => {
    setModelHidden("d-none");
  })

  const handleChangeUsername = useCallback((e) => {
    console.log(e.currentTarget);
    setUsername(e.currentTarget.value)
  })
  const handleChangePassword = useCallback((e) => {
    console.log(e.currentTarget);
    setPassword(e.currentTarget.value)
  })
  const submited = useCallback((e) => {
    e.preventDefault();
    let data = {
      "security": {
        "credentials": {
          "login": username,
          "password": password
        }
      }
    };

    fetch("/security/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(data)
    }).then(res => console.log(res));
  })

  return (
    <>
      {/* button */}
      <div className="d-flex justify-cont-end align-items-center">
        <button type="button" className="btn btn-outline-light" onClick={handleClickShow}>Connexion</button>
      </div>
      {/* Modal */}
      <div className={modalHidden + " modal_custom"}>
        <div className="modal_custom-content">
          <div className="modal_custom-header">
            <span className="close_custom" onClick={handleClickHidden}>&times;</span>
            <h2>Connexion</h2>
          </div>
          <div className="modal_custom-body">
            <form className="" onSubmit={(e) => submited(e)}>
              <div className="mb-3">
                <label htmlFor="js_connexion_username" className="form-label"><b>Nom d'utilisateur</b></label>
                <input type="text" id="js_connexion_username" className="form-control" value={username} onChange={(e) => handleChangeUsername(e)} />
              </div>
              <div className="mb-3">
                <label htmlFor="js_connexion_password" className="form-label"><b>Mot de passe</b></label>
                <input type="text" className="form-control" id="js_connexion_password" value={password} onChange={(e) => handleChangePassword(e)} />
              </div>
              <div className="d-flex justify-content-around">
                <input type="submit" className="btn btn-danger" value="Annuler" onClick={handleClickHidden}/>
                <input type="submit" className="btn btn-primary" value="Connection" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </>
  )
}
export default Connexion;
