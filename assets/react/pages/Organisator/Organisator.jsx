import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import Spinner from "../../component/Spinner";
import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";
import SelectorWeek from "./component/SelectorWeek";
import TaskList from "./component/TaskList";
import Agenda from "./component/Agenda";

import OrganisatorApi from "./Service/OrganisatorApi";
import DateService from "./Service/OrganisatorService";
import TaskForm from "./component/TaskForm";

import ButtonShowTaskForm from "./component/ButtonShowTaskForm";

const Organisator = () => {

	const [userConnected, setUserConnected] = useState({});
	const [weekSelected, setWeekSelected] = useState(DateService.getWeekNumber(new Date()))
	const [tasks, setTasks] = useState({});
	const [tasksByDay, setTasksByDay] = useState(DateService.getModelTasksByDay());

	const [showTask, setShowTask] = useState(false);
	const [showForm, setShowForm] = useState(false);

	useEffect(() => {
		setShowTask(false);
		OrganisatorApi.getOrganisatorTask(weekSelected).then(res => {
			setTasks(res["hydra:member"]);
			setTasksByDay(DateService.getModelTasksByDay(res["hydra:member"]));
			setShowTask(true);
		})
	}, [weekSelected, setWeekSelected]);


	// ACTION
	const handleClickShowForm = useCallback(() => {
		showForm ? setShowForm(false) : setShowForm(true);
	})

	// VIEW
	let renderView = showForm ?
		<TaskForm handleClickShowForm={handleClickShowForm} />
		:
		<>
			<ButtonShowTaskForm handleClickShowForm={handleClickShowForm} />
			<TaskList tasks={tasks} />
			<Agenda tasksByDay={tasksByDay} />
		</>;

	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<main className='container'>
				<h1 className="text-center">Organisator</h1>
				<div className="row">
					<SelectorWeek weekSelected={weekSelected} setWeekSelected={setWeekSelected} />
					{showTask ?
						renderView
						:
						<Spinner />
					}
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