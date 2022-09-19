import React from "react";

const Card = ({ card, handleClickCardDetail }) => {
    let cardImage = card.imageUrl ? card.imageUrl : "/img/Magic_card_back.jpeg";
    return (
        <div className="col-3 p-1">
            <a className="card" href="#" data-id={card.id} onClick={handleClickCardDetail} >
                <img src={cardImage} className="img-fluid  card-img-top" alt="..." />
                <div className="card-body">
                    <div className="text-start">{card.number} - {card.name}</div>
                </div>
            </a>
        </div>
    );
}

export default Card;