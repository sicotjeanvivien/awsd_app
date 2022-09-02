import { createRoot } from "react-dom/client";

import React from "react";

const Organisator =  ()=>{

    return (
        <div className="row">
            Not to day please 
        </div>
    )
}

export default Organisator;

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Organisator />);