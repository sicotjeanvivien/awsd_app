import { createRoot } from "react-dom/client";
import React, { useState } from "react";

import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";
import SelectorWeek from "./component/SelectorWeek";
import TaskList from "./component/TaskList";
import Agenda from "./component/Agenda";

const Organisator = () => {

	const [userConnected, setUserConnected] = useState({});
	const [currentDate, setCurrentDate] = useState(new Date());


	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<main className='container'>
				<h1 className="text-center">Organisator</h1>
				<div className="row">
					<SelectorWeek currentDate={currentDate} />
					<TaskList />
					<Agenda />
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