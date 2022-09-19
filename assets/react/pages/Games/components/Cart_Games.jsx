import React from "react";

const Cart_Games = ({ games }) => {
	return (
		games.length && games.map((value, key) => {
			return (
				<div key={key} className="col mt-5">
					<div className="card card h-100">
						<div className="d-flex justify-content-center">
							<img src={value.image} className="img-fluid rounded-start max-img-custom" alt="..." />
						</div>
						<div className="card-body">
							<h5 className="card-title">{value.name}</h5>
							<p className="card-text">{value.rules}</p>
						</div>
						<div className="card-footer">
							<div className="d-flex justify-content-end">
								<a href={value.link} className="btn btn-info">Jouer</a>
							</div>
						</div>
					</div>
				</div >
			)
		})
	)


}

export default Cart_Games;