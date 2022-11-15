import React from "react";
import routing from "../../Service/routing.json";

import Connexion from "../Connexion";

import logo from "../../assets/img/logo_awsd.svg";


const Header = ({userConnected, setUserConnected }) => {

    return (
        <header>
            <nav className="nav nav-custom pt-2 pb-2 justify-content-around">
                <div>
                    <a className="navbar-brand" href="/">
                        <img src={logo} alt="Vercel Logo"
                            className="img-fluid rounded img_size img_background" />
                    </a>
                </div>
                <div className="d-flex justify-content-between">
                    <a className="nav-link" href={routing.app_home.path}>Accueil</a>
                    <a className="nav-link" href={routing.app_projects.path}>Projet</a>
                    <a className="nav-link" href={routing.app_mtg.path} >Magic</a>
                    {/* < a className="nav-link" href="#">New World Armurerie</a>
                    < a className="nav-link" href="#" >Rosette Twitch</a> */}
                    <a className="nav-link" href="#">About</a>
                </div>
                <div>
                    <Connexion userConnected={userConnected} setUserConnected={setUserConnected} />

                </div>
            </nav >
        </header >
    )

}
export default Header;