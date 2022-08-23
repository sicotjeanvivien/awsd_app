import React from "react";

const Card = ({ card }) => {
    let cardImage =  card.imageUrl ? card.imageUrl : "/img/Magic_card_back.jpeg" ;
    return (
        <div className="col-4 p-1">
            <div className="card h-100  ">
                <img src={cardImage} className="img-fluid  card-img-top" alt="..." />
                <div className="card-body">
                    <h6 className="card-title">{card.name} </h6>
                    <p className="card-text"></p>
                </div>
            </div>
        </div>
    );
}

export default Card;