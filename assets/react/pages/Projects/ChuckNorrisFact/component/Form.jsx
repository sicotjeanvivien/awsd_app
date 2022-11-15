import React, { useCallback, useState } from "react";
import ChuckNorrisFactApi from "../Service/chuckNorrisFactApi";

const Form = ({ handleclickChangeView }) => {

	const [textFact, setTextFact] = useState("");

	const handleSubmitNewfact = useCallback((e) => {
		e.preventDefault();
		let fact = {
			"fact" : textFact
		}
		ChuckNorrisFactApi.post(fact).then(res => {
			handleclickChangeView("fact");
		})
	});

	const handleChangeTextFact = (e) => {
		setTextFact(e.currentTarget.value);
	}

	return (
		<>
			<div className='p-0 mb-2 d-flex justify-content-end'>
				<button type='button' className='btn btn-info' onClick={e => handleclickChangeView("fact")}>Retour</button>
			</div>
			<form>
				<textarea className="form-control" style={{ height: "10rem" }}
					placeholder="Leave a comment here"
					value={textFact} onChange={e => handleChangeTextFact(e)}
				></textarea>
				<button type="button" className="btn btn-info" onClick={e => handleSubmitNewfact(e)}>Créer</button>
			</form>
		</>
	)
}

export default Form;