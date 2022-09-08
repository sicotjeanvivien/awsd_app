import React, { useState, useCallback, useEffect } from "react";
import Security from "../Service/Security";
import routing from "../Service/routing.json";

import LoginForm from "./form/loginForm";
import SignInForm from "./form/signInForm";

const Connexion = () => {

  const [modalHidden, setModelHidden] = useState("d-none");
  const [username, setUsername] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [passwordVerified, setPasswordVerified] = useState("");
  const [user, setUser] = useState();
  const [hiddenLoginButton, setHiddenLoginButton] = useState(false);
  const [calledFormInModal, setCalledFormInModal] = useState();
  const [signinFormMessage, setSigninFormMessage] = useState("");
  const [signinFormCSS, setSigninFormCSS] = useState("");

  useEffect(() => {
    checkIfUserIsConnected();
  }, [])


  // HYDRATE DATA
  const handleChangeUsername = useCallback((e) => {
    setUsername(e.currentTarget.value)
  });
  const handleChangeEmail = useCallback((e) => {
    setEmail(e.currentTarget.value);
  })
  const handleChangePassword = useCallback((e) => {
    setPassword(e.currentTarget.value)
  });
  const handleChangePasswordVerified = useCallback((e) => {
    setPasswordVerified(e.currentTarget.value);
  })


  // SECURITY
  const login = useCallback((e) => {
    e.preventDefault();
    let data = {
      "security": {
        "username": username,
        "password": password
      }
    };
    Security.login(data).then(res => renderViewIfUserIsConnected(res));
  });
  const signIn = useCallback((e) => {
    e.preventDefault();
    let data = {
      "username": username,
      "email": email,
      "password": password,
      "passwordVerified": passwordVerified
    };
    if (checkIfDataForSigninIsCorrect(data)) {
      Security.signin(data).then(res => {
        setSigninFormMessage(res.message);
        setSigninFormCSS("alert-danger");
        if (res.error) {
          login(e);
          setSigninFormCSS("alert-success");
        };
      })
    }
  });
  const checkIfUserIsConnected = () => {
    Security.checkIfUserIsConnected().then(res => renderViewIfUserIsConnected(res));
  }
  const checkIfDataForSigninIsCorrect = (data) => {
    let error = true;
    document.getElementById("js_signin_username").classList.remove("is-valid", "is-invalid");
    document.getElementById("js_signin_email").classList.remove("is-valid", "is-invalid");
    document.getElementById("js_signin_password").classList.remove("is-valid", "is-invalid");
    document.getElementById("js_signin_password_verified").classList.remove("is-valid", "is-invalid");
    if (!data.username || !data.username.length) {
      error = false;
      document.querySelector("#js_signin_username").classList.add("is-invalid");
    }
    if (!data.email || !data.email.length) {
      error = false;
      document.querySelector("#js_signin_email").classList.add("is-invalid");
    }
    let regex = /[a-zA-Z0-9]{6,20}/;
    if (!data.password || !data.password.length || !regex.test(data.password)) {
      error = false;
      document.querySelector("#js_signin_password").classList.add("is-invalid");
    }
    if (!data.passwordVerified || !data.passwordVerified.length) {
      error = false;
      document.querySelector("#js_signin_password_verified").classList.add("is-invalid");
    }
    if (data.password !== data.passwordVerified) {
      error = false;
      document.querySelector("#js_signin_password_verified").classList.add("is-invalid");
    }
    return error;
  }
  const renderViewIfUserIsConnected = (res) => {
    if (typeof res === "object" && res.hasOwnProperty("token") && res.token.length) {
      setHiddenLoginButton(true);
      handleClickHidden();
      window.awsdData = { "userConnected": res };
      setUser(res);
    }
  }

  // SIGNIN / SIGNOUT
  const dropDownShow = useCallback((e) => {
    e.currentTarget.parentElement.lastChild.classList.toggle("show");
  });
  let authButton = (
    <>
      <button type="button" className="btn ms-2 btn-outline-light" data-form="login" onClick={(e) => handleClickShow(e)}>Connexion</button>
      <button type="button" className="btn ms-2 btn-outline-light" data-form="signin" onClick={(e) => handleClickShow(e)}>s'inscrire</button>
    </>
  );
  if (hiddenLoginButton) {
    authButton = (
      <div className="position-relative d-inline-block">
        <button onClick={dropDownShow} className="btn btn-outline-light">{user.username}</button>
        <div id="myDropdown" className="dropdown-content">
          <a href={routing.app_profil.path}>Profil</a>
          <a href={routing.app_organisator.path}>Organisator</a>
          <a href={routing.security_logout.path}>Déconnexion</a>
        </div>
      </div>
    );
  }

  // FORM / MODAL
  const handleClickShow = useCallback((e) => {
    setUsername("");
    setEmail("")
    setPassword("");
    setPasswordVerified("");
    setCalledFormInModal(e.currentTarget.dataset.form);
    setModelHidden("d-block");
  });
  const handleClickHidden = useCallback(() => {
    setModelHidden("d-none");
  });
  let renderViewFormInModal = (
    <LoginForm
      login={login}
      username={username}
      handleChangeUsername={handleChangeUsername}
      password={password}
      handleChangePassword={handleChangePassword}
      handleClickHidden={handleClickHidden}
    />
  );
  if (calledFormInModal === "signin") {
    renderViewFormInModal = (
      <SignInForm
        username={username}
        handleChangeUsername={handleChangeUsername}
        email={email}
        handleChangeEmail={handleChangeEmail}
        password={password}
        handleChangePassword={handleChangePassword}
        passwordVerified={passwordVerified}
        handleChangePasswordVerified={handleChangePasswordVerified}
        handleClickHidden={handleClickHidden}
        signIn={signIn}
        signinFormMessage={signinFormMessage}
        signinFormCSS={signinFormCSS}
      />
    )
  }

  return (
    <>
      {/* button */}
      <div className="d-flex align-items-center ">
        {authButton}
      </div>

      {/* Modal */}
      <div className={modalHidden + " modal_custom"}>
        <div className="modal_custom-content">
          <div className="modal_custom-header">
            <span className="close_custom" onClick={handleClickHidden}>&times;</span>
            <h2>Connexion</h2>
          </div>
          <div className="modal_custom-body">
            {renderViewFormInModal}
          </div>
        </div>
      </div>
    </>
  )
}
export default Connexion;
