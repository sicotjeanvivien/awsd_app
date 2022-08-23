import React from "react";
const ExtensionCard = ({ extension }) => {
    let dateRelease = new Date(extension.releaseDate);
    return <div className="col-xl-6 p-2">
        <div className="card">
            <div className="card-header">
                {extension.code}
            </div>
            <div className="card-body row">
                <div className="col-8">
                    <p className="text-start lh-1">
                    <span className="fw-bold">SET :</span> {extension.name}
                    </p>
                    <p className="text-start lh-1">
                        <span className="fw-bold">RELEASE : </span>  {dateRelease.getDate() + "/" + dateRelease.getMonth() + "/" + dateRelease.getFullYear()}
                    </p>
                </div>
                <div className="col-4 d-flex justify-content-end">
                    <div>
                        <a className="btn btn-outline-info" data-extension_id={extension.id} href="#">Cartes</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

}

export default ExtensionCard;