import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

import Spinner from "../../component/Spinner";
import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";
import SelectorWeek from "./component/button/SelectorWeek";
import TaskList from "./component/TaskList";
import Agenda from "./component/Agenda";

import OrganisatorApi from "./Service/OrganisatorApi";
import DateService from "./Service/OrganisatorService";
import TaskForm from "./component/form/TaskForm";

import ButtonShowTaskForm from "./component/button/ButtonShowTaskForm";

const Organisator = () => {

	const [userConnected, setUserConnected] = useState({});
	const [weekSelected, setWeekSelected] = useState(DateService.getWeekNumber(new Date()))
	const [tasks, setTasks] = useState({});
	const [tasksByDay, setTasksByDay] = useState(DateService.getModelTasksByDay());

	const [showTask, setShowTask] = useState(false);
	const [showForm, setShowForm] = useState(false);

	const [errorPostMessage, setErrorPostMessage] = useState("");

	useEffect(() => {
		setShowTask(false);
		loadTask();
	}, [weekSelected, setWeekSelected]);

	// API
	const loadTask = () => {
		OrganisatorApi.getOrganisatorTask(weekSelected).then(res => {
			setTasks(res["hydra:member"]);
			setTasksByDay(DateService.getModelTasksByDay(res["hydra:member"]));
			setShowTask(true);
		});
	}

	const submitNewTask = (data) => {
		setShowForm(false);
		setShowTask(false);
		if (weekSelected  && userConnected["@id"] ) {
			let newTask = {
				"task": data.task,
				"weekNumber": weekSelected,
				"description": data.description,
				"making": false,
				"date": data.date,
				"user": userConnected["@id"]
			};

			OrganisatorApi.postOrganisationTask(newTask).then(res => {
				if (res.error) {
					setShowForm(true);
					setErrorPostMessage(res.message);
				}
				loadTask();
			})
		}else{
			setErrorPostMessage("error data empty");
		}
	}

	// ACTION
	const handleClickShowForm = useCallback(() => {
		setErrorPostMessage("");
		showForm ? setShowForm(false) : setShowForm(true);
	})

	// VIEW
	let renderView = showForm ?
		<TaskForm
			handleClickShowForm={handleClickShowForm}
			submitNewTask={submitNewTask}
			weekSelected={weekSelected}
			errorPostMessage={errorPostMessage}
			setErrorPostMessage={setErrorPostMessage}
		/>
		:
		<>
			<ButtonShowTaskForm handleClickShowForm={handleClickShowForm} />
			<TaskList tasks={tasks} />
			<Agenda tasksByDay={tasksByDay} />
		</>;

	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<main className='container mt-2 mb-2'>
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