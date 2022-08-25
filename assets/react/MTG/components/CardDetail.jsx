import React, { useCallback, useEffect, useState } from "react";

const CardDetail = ({ cardDetail, handleClickEmptyCardDetail }) => {

    const [texts, setTexts] = useState(JSON.parse(cardDetail.foreignTexts));
    const [textSelected, setTextSelected] = useState({});


    let cardImage = cardDetail.imageUrl ? cardDetail.imageUrl : "/img/Magic_card_back.jpeg";

    const handleClickSelectedLanguage = useCallback((e) => {
        e.preventDefault();
        texts.length && texts.map((value, key) => {
            if (value.language == e.currentTarget.dataset.language) {
                setTextSelected(value);
            }
        })
    }, []);

    return (
        <>
            <div className="col-12 d-flex mb-3">
                <button type="button" className="btn btn-outline-info" onClick={handleClickEmptyCardDetail}>Retour</button>
            </div>
            <div className="col-6">
                <img className="img-fluid w-100" src={cardImage} alt={cardDetail.name} />
            </div>
            <div className="col-6">
                <p><span className="fw-bold"> NOM : </span> {cardDetail.name}</p>
                <p><span className="fw-bold"> Numéro : </span> {cardDetail.number}</p>
                <p><span className="fw-bold"> Puissance : </span> {cardDetail.power}</p>
                <p><span className="fw-bold"> résistance : </span> {cardDetail.toughness}</p>
            </div>
            <div className="col-12">
                <ul className="nav nav-tabs">
                    {
                        texts && texts.map((value, key) => {
                            return <li className="nav-item" key={key} >
                                <a type="button" href="#" className="nav-link" data-language={value.language} onClick={(e) => handleClickSelectedLanguage(e)} >{value.language.slice(0, 2)}</a>
                            </li>
                        })
                    }
                </ul>
            </div>
            <div className="col-12">
                <p>{textSelected.name} - {textSelected.type}</p>
                <p>{textSelected.text}</p>
            </div>
        </>
    );
}

export default CardDetail;