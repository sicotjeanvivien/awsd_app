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
	const [tasks, setTasks] = useState([]);
	const [tasksByDay, setTasksByDay] = useState(DateService.getModelTasksByDay());

	const [taskIdDeleting, setTaskIdDeleting] = useState();

	const [showTask, setShowTask] = useState(false);
	const [showForm, setShowForm] = useState(false);
	const [modalHidden, setModelHidden] = useState("d-none");

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
		if (weekSelected && userConnected["@id"]) {
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
		} else {
			setErrorPostMessage("error data empty");
		}
	}

	const deleteTask = (taskId) => {
		console.log("delete task");
		OrganisatorApi.deletedTask(taskId).then(res => {
			loadTask();
			handleClickHidden(res);
		})
	}

	const patchTask = (task) => {
		OrganisatorApi.patchTask(task).then(res => {
		loadTask();

		});
	}

	// ACTION
	const handleClickShowForm = useCallback(() => {
		setErrorPostMessage("");
		showForm ? setShowForm(false) : setShowForm(true);
	})

	const handleClickHidden = useCallback((e) => {
		if (modalHidden === "d-none") {
			setModelHidden("d-block");
			setTaskIdDeleting(e.currentTarget.value)
		} else {
			setModelHidden("d-none");
			setTaskIdDeleting(0);
		}
	});

	const handleClickDeletingTask = useCallback(() => {
		console.log("deleted task");
		deleteTask(taskIdDeleting);
	})

	const handleClickToggleMaking = useCallback((e) => {

		let checked = e.currentTarget.checked;
		let taskId = e.currentTarget.value;
		let taskSeleted = tasks.filter((task) => task.id == taskId)[0];
		taskSeleted.making = checked;
		patchTask(taskSeleted);

	})

	// VIEW
	let renderView = showForm ?
		<TaskForm
			handleClickShowForm={handleClickShowForm}
			submitNewTask={submitNewTask}
			setErrorPostMessage={setErrorPostMessage}
			weekSelected={weekSelected}
			errorPostMessage={errorPostMessage}
		/>
		:
		<>
			<ButtonShowTaskForm handleClickShowForm={handleClickShowForm} />
			<TaskList
				tasks={tasks}
				taskIdDeleting={taskIdDeleting} setTaskIdDeleting={setTaskIdDeleting}
				modalHidden={modalHidden} handleClickHidden={handleClickHidden}
				handleClickDeletingTask={handleClickDeletingTask}
				handleClickToggleMaking={handleClickToggleMaking}
			/>
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