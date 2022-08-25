import React from "react";

const Card = ({ card, handleClickCardDetail }) => {
    let cardImage = card.imageUrl ? card.imageUrl : "/img/Magic_card_back.jpeg";
    return (
        <div className="col-4 p-1">
            <div className="card">
                <img src={cardImage} className="img-fluid  card-img-top" alt="..." />
                <div className="card-body d-flex justify-content-between">
                    <div className="col text-start">{card.name}</div>
                    <div className="col text-end">{card.number}</div>
                    <div>
                        <button type="button" className="btn  btn-info" data-id={card.id} onClick={handleClickCardDetail}>Détail</button>

                    </div>
                </div>
            </div>
        </div>
    );
}

export default Card;