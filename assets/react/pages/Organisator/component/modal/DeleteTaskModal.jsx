import React, { useState } from "react";

const DeleteTaskModal = ({ modalHidden, handleClickHidden, handleClickDeletingTask }) => {

	return (
		<div className={modalHidden + " modal_custom"}>
			<div className="modal_custom-content">
				<div className="modal_custom-header">
					<span className="close_custom" onClick={handleClickHidden}>&times;</span>
					<h2>Supprimer une tâche</h2>
				</div>
				<div className="modal_custom-body">
					<p>
						Êtes-vous sùr de vouloir supprimer la tâche?
					</p>
					<div className="d-flex justify-content-around">
						<input type="button" className="btn btn-danger" value="Annuler" onClick={handleClickHidden} />
						<input type="submit" className="btn btn-primary" value="Supprimer"
							onClick={handleClickDeletingTask}
						/>
					</div>
				</div>
			</div>
		</div>
	)

}

export default DeleteTaskModal;