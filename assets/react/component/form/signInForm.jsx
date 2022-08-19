import React from "react";

const SignInForm = ({
    username, handleChangeUsername,
    email, handleChangeEmail,
    password, handleChangePassword,
    passwordVerified, handleChangePasswordVerified,
    handleClickHidden,
    signIn,
    signinFormMessage, signinFormCSS
}) => {
    return (
        <form onSubmit={(e) => signIn(e)}>
            <div className="mb-3">
                <label htmlFor="js_signin_username" className="form-label"><b>Nom d'utilisateur</b></label>
                <input type="text" id="js_signin_username" className="form-control" value={username} onChange={(e) => handleChangeUsername(e)} />
                <div className="invalid-feedback">Veuillez remplir le champs...</div>
            </div>
            <div className="mb-3">
                <label htmlFor="js_signin_email" className="form-label"><b>Adresse email</b></label>
                <input type="email" id="js_signin_email" className="form-control" value={email} onChange={(e) => handleChangeEmail(e)} />
                <div className="invalid-feedback">Veuillez remplir le champs...</div>
            </div>
            <div className="mb-3">
                <label htmlFor="js_signin_password" className="form-label"><b>Mot de passe</b></label>
                <input type="password" className="form-control" id="js_signin_password" value={password} onChange={(e) => handleChangePassword(e)} />
                <div className="invalid-feedback">Veuillez remplir le champs...</div>
            </div>
            <div className="mb-3">
                <label htmlFor="js_signin_password_verified" className="form-label"><b>Confirmer mot de passe</b></label>
                <input type="password" className="form-control" id="js_signin_password_verified" value={passwordVerified} onChange={(e) => handleChangePasswordVerified(e)} />
                <div className="invalid-feedback">Veuillez remplir le champs...</div>
            </div>
            <div className="d-flex justify-content-around">
                <input type="submit" className="btn btn-danger" value="Annuler" onClick={handleClickHidden} />
                <input type="submit" className="btn btn-primary" value="S'inscrire" />
            </div>
            <div className="mb-3" >
                <div className={"alert " + signinFormCSS} role="alert">
                    {signinFormMessage}
                </div>
            </div>
        </form>
    )
}

export default SignInForm;