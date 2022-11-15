import { createRoot } from 'react-dom/client';
import React, { useEffect, useState } from "react";

import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";
import Cart_Games from './components/Cart_Games';

const Projects = () => {

	const [userConnected, setUserConnected] = useState({});
	const [projects, setProjects] = useState([]);

	useEffect(() => {
		setProjects(window.awsd_projects)
	}, [])

	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<main className='container'>
				<div className="row ">
					<Cart_Games projects={projects} />
				</div>
			</main>
			<Footer />
		</>
	)
}
export default Projects;

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Projects />);