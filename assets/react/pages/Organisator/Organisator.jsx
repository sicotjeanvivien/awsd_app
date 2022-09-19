import { createRoot } from "react-dom/client";
import React, { useState } from "react";

import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";

const Organisator = () => {

	const [userConnected, setUserConnected] = useState({});

	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<main className='container'>
				<div className="row">
					Not to day please
				</div>
			</main>
			<Footer />
		</>
	)
}

export default Organisator;

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Organisator />);