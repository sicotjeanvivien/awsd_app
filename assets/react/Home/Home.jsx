import { createRoot } from 'react-dom/client';
import React, { useCallback, useEffect, useState } from "react";

const Home = () => {
    return (
        <div>
            <h1>Bienvenu sur AWSD.FR</h1>
            <p>Ce site rassemble plusieurs projets en un seul endroit. Certains sont visibles et trouvables simplement, d'autres sont cachés.</p>
            <h2>Bonne chasse au trésor!!!</h2>
            <h2><span className='bg-danger'>Attention</span></h2>
            <tt>Certaines parties du sites peuvent être choquantes, dérangeantes ou étranges.</tt> 
        </div>
    )
}

export default Home;

const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<Home />);