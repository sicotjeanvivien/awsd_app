import { createRoot } from "react-dom/client";
import React from "react";

const Tchat = () => {

    return (
        <>
            <h1 className="text-center">Tchat Infini</h1>
            <div className="row">

            </div>
        </>
    )
}

export default Tchat;


const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Tchat />);