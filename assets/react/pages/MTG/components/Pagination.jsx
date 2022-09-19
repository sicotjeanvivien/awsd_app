import React from "react";

const Pagination = ({ pageCards, lastPageCards, handleSelectedPageCard }) => {
    return (
        <div className="d-flex justify-content-center txt-black">
            <nav aria-label="Page navigation example">
                <ul className="pagination">
                    {pageCards > 1 &&
                        <li className="page-item" onClick={(e) => handleSelectedPageCard(e, pageCards - 1)}>
                            <button type="button" className="page-link" >Précédent</button>
                        </li>
                    }

                    <li className="page-item">
                        <a className="page-link" href="#">{pageCards}</a>
                    </li>
                    {/* <li className="page-item">
                        <a className="page-link" href="#">2</a>
                    </li>
                    <li className="page-item">
                        <a className="page-link" href="#">3</a>
                    </li> */}
                    {pageCards < lastPageCards &&
                        <li className="page-item" onClick={(e) => handleSelectedPageCard(e, pageCards + 1)}>
                            <button type="button" className="page-link">Suivant</button>
                        </li>
                    }
                </ul>
            </nav>
        </div>
    );
}

export default Pagination;