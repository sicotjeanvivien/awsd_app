import React, { useState } from "react";

import OrganisatorService from "../Service/OrganisatorService";

const TaskForm = ({ handleClickShowForm }) => {

	const [taskValue, setTaskValue] = useState("");
	const [dateValue, setDateValue] = useState("");
	const [descriptionValue, setDescriptionValue] = useState("");

	const [descriptionLength, setDecriptionLength] = useState(0);

	console.log(OrganisatorService.getDateByWeek(38));


	// ACTION
	const handleChangeDescriptionValue = (e) => {
		let description = e.currentTarget.value;
		let lengthText =  description.length;
		if (lengthText < 250) {	
			setDescriptionValue(description)
		}
		setDecriptionLength(lengthText);
	}

	return (
		<>
			<div className="col-12">
				<button type="button" className="btn btn-outline-info" onClick={handleClickShowForm}>Retour</button>
			</div>
			<div className="col-12">
				<h5 className="text-center">Nouvelle tâche</h5>
			</div>
			<form className="col-12 row">
				<div className="col-6">
					<div className="mb-3">
						<label htmlFor="" className="form-label">Tâche</label>
						<input type="text" className="form-control" value={taskValue} onChange={e => setTaskValue(e.currentTarget.value)} />
					</div>
					<div className="mb-3">
						<label htmlFor="" className="form-label">Date</label>
						<input type="date" className="form-control" value={dateValue} onChange={e => setDateValue(e.currentTarget.value)} />
					</div>
				</div>
				<div className="col-6">
					<label htmlFor="" className="form-label">Description de la tâche ({descriptionLength}/ 250 )</label>
					<div className="form-floating">
						<textarea className="form-control" style={{ height: "10rem" }}
							placeholder="Leave a comment here"
							value={descriptionValue} onChange={e => handleChangeDescriptionValue(e)}
						></textarea>
					</div>
				</div>
				<div className="col-12 mt-2 d-flex justify-content-end">
					<button type="button" className="btn btn-outline-info">Ajouter une tâche</button>
				</div>
			</form>
		</>
	)

}

export default TaskForm;