import { createRoot } from 'react-dom/client';
import React, { useCallback, useEffect, useState } from "react";

const Home = () => {
    return (
        <div>
            Home Page
        </div>
    )
}

export default Home;

const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<Home />);