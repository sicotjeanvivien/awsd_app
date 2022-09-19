import React from "react";
import routing from "../../Service/routing.json"

const Footer = () => {

    return (
        <footer className="footer">
            <a
                href="https://www.sicot-development.fr/"
                target="_blank"
                rel="noopener noreferrer"
            >
                Powered by sicot-development
            </a>
            <a href={routing.app_legal_notice.path}>Mention légal</a>
        </footer>
    );
}

export default Footer;