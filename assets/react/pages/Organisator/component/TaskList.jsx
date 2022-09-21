import React from "react";
import Task from "./Task";

const TaskList = ({ tasks }) => {

	const [modalHidden, setModelHidden] = useState("d-none");

	// ACTION
	const handleClickHidden = useCallback(() => {
		setModelHidden("d-none");
	});

	return (
		<div className="col-6">
			<h5>Tâche de le semaine</h5>
			{
				tasks.map((value, key) => {
					return <Task key={key} task={value} />
				})
			}
		</div>
	);
}

export default TaskList;