import React, { useCallback, useEffect, useState } from "react";

const Case = ({ value, onClick }) => {
    return (
        <div onClick={(e) => onClick(e)} data-index={value.index} className="case">{value.value}</div>
    )
}

export default Case;