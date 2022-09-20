import React from "react";
import Task from "./Task";

const TaskList = ({tasks}) => {

	console.log(tasks);

	return (
		<div className="col-6">
			<h5>Tâche de le semaine</h5>
			{
				tasks.map((value, key)=>{
					return <Task key={key} task={value} />
				})
			}
		</div>
	);
}

export default TaskList;