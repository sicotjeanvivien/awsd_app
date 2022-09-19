import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";

const Profil = () => {

	const [userConnected, setUserConnected] = useState({});

	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<main className='container'>
				<div>Hello World </div>
			</main>
			<Footer />
		</>
	)
}

export default Profil;

const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<Profil />);