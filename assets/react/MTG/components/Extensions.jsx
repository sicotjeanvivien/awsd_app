import React, { useCallback, useState } from "react";
import Extension from "./Extension";

const Extensions = ({ extensions, handleSelectedExtension }) => {

    const [searchName, setSearchName] = useState("");

    const handleChangeSerachName = useCallback((e) => {
        setSearchName(e.currentTarget.value);
    });

    return <>
        <h1>Liste des extensions</h1>
        <div className="col-12">
            <label htmlFor="js_input_searchName" className="form-label">Recherche set</label>
            <input type="text" className="form-control" id="js_input_searchName"
                value={searchName}
                onChange={(e) => handleChangeSerachName(e)}
            />
        </div>
        {
            extensions.map((value, key) => {
                console.log("boo", value);

                let test = /^ Kami $/i
                if (value.code.match(searchName) || value.name.toLowerCase().match(searchName.toLowerCase())) {
                    return <Extension key={key} extension={value} handleSelectedExtension={handleSelectedExtension} />
                }
            })
        }
    </>
}

export default Extensions