import React, { useEffect, useState } from "react";

import DateService from "../Service/OrganisatorService";

const SelectorWeek = ({ weekSelected, setWeekSelected }) => {

	const [weekInYear, setWeekInYear] = useState(Array(52).fill(""));
	const [optionRenderView, setOptionRenderView] = useState({});

	useEffect(() => {
	}, [])


	return (
		<div className="col-12 pt-3 pb-3 input-group">
			<label htmlFor="" className="input-group-text">Semaine</label>
			<select className="form-select" defaultValue={weekSelected} onChange={e => setWeekSelected(e.currentTarget.value)} >
				{weekInYear.map((elem, key) => {
					return <option key={key} value={key + 1}>{key + 1}</option>
				})}
			</select>

		</div>
	);
}

export default SelectorWeek;