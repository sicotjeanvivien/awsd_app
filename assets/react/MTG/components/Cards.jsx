import React from "react";
import Card from "./Card";
import Pagination from "./Pagination";

const Cards = ({ handleClickEmptyData, handleClickCardDetail, handleSelectedPageCard, cards, pageCards, lastPageCards }) => {
    return <>
        <div className="col-12 d-flex">
            <button type="button" className="btn btn-outline-info" onClick={handleClickEmptyData}>Retour</button>
        </div>
        <h1>Liste cartes pour l'extension : </h1>
        <div className="row row-cols-1 row-cols-md-3 g-4">
            {cards.map((value, key) => {
                return <Card key={key} card={value} handleClickCardDetail={handleClickCardDetail} />;

            })}
        </div>
        <Pagination pageCards={pageCards} lastPageCards={lastPageCards} handleSelectedPageCard={handleSelectedPageCard} />
    </>
}
export default Cards;