import React, { useEffect, useState } from "react";

import OrganisatorService from "../../Service/OrganisatorService";

const TaskForm = ({ handleClickShowForm, submitNewTask, weekSelected, errorPostMessage, setErrorPostMessage }) => {

	const [taskValue, setTaskValue] = useState("");
	const [dateValue, setDateValue] = useState("");
	const [descriptionValue, setDescriptionValue] = useState("");

	const [dateByWeek, setDateByWeek] = useState([]);
	const [descriptionLength, setDecriptionLength] = useState(0);

	useEffect(() => {
		setDateByWeek(OrganisatorService.getDateByWeek(weekSelected));
	}, [])

	// ACTION
	const handleChangeTaskValue = (e) => {
		setTaskValue(e.currentTarget.value);
	}

	const handleChangeDateValue = (e) => {
		setDateValue(e.currentTarget.value);
	}

	const handleChangeDescriptionValue = (e) => {
		let description = e.currentTarget.value.slice(0, 250);
		let lengthText = description.length;
		if (lengthText < 251) {
			setDescriptionValue(description)
		}
		setDecriptionLength(lengthText);
	}

	const handleSubmitNewTask = (e) => {
		setErrorPostMessage("");
		let data = {
			task: taskValue,
			description: descriptionValue,
			date: dateValue
		}
		if (taskValue.length && descriptionValue.length && dateValue.length) {
			submitNewTask(data);
		}else{
			setErrorPostMessage("Merci de remplir les champs vides");
		}
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
						<input type="text" className="form-control" value={taskValue} onChange={e => handleChangeTaskValue(e)} />
					</div>
					<div className="mb-3">
						<label htmlFor="" className="form-label">Date</label>
						<select className="form-select" onChange={e => handleChangeDateValue(e)}>
							<option>Choisir une date...</option>
							{
								dateByWeek.map((value, key) => {
									let date = new Date(value);
									let day = new Intl.DateTimeFormat('fr-FR', { weekday: 'long' }).format(date)
									let month = new Intl.DateTimeFormat('fr-FR', { month: 'long' }).format(date);
									return (
										<option key={key} value={date.toUTCString()}>
											{day + " " + date.getDate() + " " + month + " " + date.getFullYear()}
										</option>
									);
								})
							}
						</select>
						{/* <input type="date" className="form-control" value={dateValue} onChange={e => handleChangeDateValue(e)} /> */}
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
					<button type="button" className="btn btn-outline-info" onClick={handleSubmitNewTask} >Ajouter une tâche</button>
				</div>
			</form>
			<div className="col-12  mt-2 ">
				{
					errorPostMessage && <div className="alert alert-danger" role="alert">{errorPostMessage}</div>
				}
			</div>
		</>
	)

}

export default TaskForm;