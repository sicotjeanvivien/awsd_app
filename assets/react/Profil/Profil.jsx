import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

const Profil = ()=>{
    return (
        <div>Hello World </div>
    )
}

export default Profil;

const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<Profil />);