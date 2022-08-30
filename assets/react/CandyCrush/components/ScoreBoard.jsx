import React from "react";

const ScoreBoard = ({score}) =>{
    return (
        <div className="scrore-board">
            <h2>
                Scrore : {score}
            </h2>
        </div>
    )
};

export default ScoreBoard;