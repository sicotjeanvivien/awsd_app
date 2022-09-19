import { createRoot } from "react-dom/client";
import React, { useState } from "react";
// Component
import Connexion from "../component/Connexion";


const App = () => {

    const [userConnected, setUserConnected] = useState();

    return (
        <>
            <header>
                header
            </header>
            <main className="container-fluid">
                main container
            </main>
            <footer>
                footer
            </footer>
        </>
    )


}

export default App;


const container = document.getElementById('react_connexion');
const root = createRoot(container);
root.render(<Connexion />);