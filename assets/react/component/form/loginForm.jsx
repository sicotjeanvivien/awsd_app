import React from "react";

const loginForm = ({
    username, handleChangeUsername,
    password, handleChangePassword,
    handleClickHidden,
    login
}) => {
    return (<form className="" onSubmit={(e) => login(e)}>
        <div className="mb-3">
            <label htmlFor="js_connexion_username" className="form-label"><b>Nom d'utilisateur</b></label>
            <input type="text" id="js_connexion_username" className="form-control" value={username} onChange={(e) => handleChangeUsername(e)} />
        </div>
        <div className="mb-3">
            <label htmlFor="js_connexion_password" className="form-label"><b>Mot de passe</b></label>
            <input type="current-password" className="form-control" id="js_connexion_password" value={password} onChange={(e) => handleChangePassword(e)}  />
        </div>
        <div className="d-flex justify-content-around">
            <input type="button" className="btn btn-danger" value="Annuler" onClick={handleClickHidden} />
            <input type="submit" className="btn btn-primary" value="Connection" />
        </div>
    </form>);
}

export default loginForm;