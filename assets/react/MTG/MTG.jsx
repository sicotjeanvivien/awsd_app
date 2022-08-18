import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

const MTG = () => {

    return (
        <div>MTG</div>
    );
}

export default MTG;

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<MTG />);