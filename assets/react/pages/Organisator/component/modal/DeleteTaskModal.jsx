import React, { useState } from "react";

const DeleteTaskModal = () => {



	return (
		<div className={modalHidden + " modal_custom"}>
			<div className="modal_custom-content">
				<div className="modal_custom-header">
					<span className="close_custom" onClick={handleClickHidden}>&times;</span>
					<h2>Connexion</h2>
				</div>
				<div className="modal_custom-body">
					
				</div>
			</div>
		</div>
	)

}

export default DeleteTaskModal;