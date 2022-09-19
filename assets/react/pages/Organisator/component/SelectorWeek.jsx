import React, { useEffect, useState } from "react";

import DateService from "../Service/DateService";

const SelectorWeek = ({ currentDate }) => {

	const [weekInYear, setWeekInYear] = useState(Array(52).fill(""));
	const [currentWeek, setCurrentWeek] = useState(DateService.getWeekNumber(currentDate))
	const [optionRenderView, setOptionRenderView] = useState({});

	useEffect(() => {
	}, [])


	return (
		<div className="col-12 p-3 input-group">
			<label htmlFor="" className="input-group-text">Semaine</label>
			<select className="form-select" aria-label="Default select example" defaultValue={currentWeek}>
				{weekInYear.map((elem, key) => {
					return <option key={key} value={key+1}>{key+1}</option>
				})}
			</select>

		</div>
	);
}

export default SelectorWeek;