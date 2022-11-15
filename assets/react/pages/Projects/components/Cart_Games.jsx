import React from "react";
import routing from "../../../Service/routing.json";


const Cart_Games = ({ projects }) => {
	return (
		projects.length && projects.map((value, key) => {
			let path = value.link;
			if (!value.externalLink && routing[value.link]) {
				path = routing[value.link].path;
			}

			return (
				<div key={key} className="col mt-5">
					<div className="card card h-100">
						<div className="d-flex justify-content-center">
							<img src={value.image || "/img/projectdefault.png" } className="img-fluid rounded-start max-img-custom" alt="..." />
						</div>
						<div className="card-body">
							<h5 className="card-title">{value.name}</h5>
							<p className="card-text">{value.description}</p>
						</div>
						<div className="card-footer">
							<div className="d-flex justify-content-around">
								<a href={value.github} className="btn btn-info">Github</a>
								<a href={path} className="btn btn-info">Voir</a>
							</div>
						</div>
					</div>
				</div >
			)
		})
	)


}

export default Cart_Games;