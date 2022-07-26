import React, { useCallback } from "react";
import ButtonTrashDeleteTask from "./button/ButtonTrashDeleteTask";

const Task = ({ task, handleClickHidden, handleClickToggleMaking }) => {

	// ACTION
	const handleClickToggleCollapse = useCallback((e) => {
		let element = e.currentTarget;
		element.classList.toggle("active");
		let panel = document.querySelector("#" + element.dataset.id);
		if (panel.style.maxHeight) {
			panel.style.maxHeight = null;
		} else {
			panel.style.maxHeight = panel.scrollHeight + "px";
		}
	})

	return (
		<div>
			<div className="d-flex">
				<div className="form-check">
					<input className="form-check-input" type="checkbox" defaultChecked={task.making}
						value={task.id} onClick={e => handleClickToggleMaking(e)}
					/>
				</div>
				<button type="button" className="accordion" data-id={"js_panel_" + task.id}
					onClick={e => handleClickToggleCollapse(e)}
				>
					{task.task}</button>
				<ButtonTrashDeleteTask task_id={task.id} handleClickHidden={handleClickHidden} />
			</div>
			<div className="panel" id={"js_panel_" + task.id}>
				<p>{task.description}</p>
			</div>
		</div>
	)
}

export default Task;