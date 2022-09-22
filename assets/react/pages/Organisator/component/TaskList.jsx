import React from "react";
import DeleteTaskModal from "./modal/DeleteTaskModal";
import Task from "./Task";

const TaskList = ({ tasks, handleClickDeletingTask, modalHidden, handleClickHidden, handleClickToggleMaking }) => {

	return (
		<div className="col-6">
			<h5>Tâche de le semaine</h5>
			{
			 tasks.length &&	tasks.map((value, key) => {
					return <Task key={key} task={value}
						handleClickHidden={handleClickHidden}
						handleClickToggleMaking={handleClickToggleMaking}
					/>
				})
			}
			<DeleteTaskModal
				modalHidden={modalHidden}
				handleClickHidden={handleClickHidden}
				handleClickDeletingTask={handleClickDeletingTask}
			/>
		</div>
	);
}

export default TaskList;