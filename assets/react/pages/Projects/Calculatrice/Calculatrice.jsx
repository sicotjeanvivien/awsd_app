import React, { useCallback, useEffect, useState } from "react";
import { createRoot } from 'react-dom/client';
import Footer from "../../../component/Footer/Footer";
import Header from "../../../component/Header/Header";

const Calculatrice = () => {

    const [userConnected, setUserConnected] = useState({});
    const [value, setValue] = useState("0");
    const [operator, setOperator] = useState("");
    const [result, setResult] = useState("");

    const handleClickValue = useCallback((e) => {
        setValue(value !== "0" ? value + e.currentTarget.value : e.currentTarget.value);
        if (value == "0" && e.currentTarget.value === ".") setValue("0.");
    })
    const handleClickOperator = useCallback((e) => {
        let operatorCliked = e.currentTarget.value;
        setOperator(operatorCliked);
        if (e.currentTarget.value === "=") {
            operatorCliked = operator;
            setOperator("");
        }
        let newResult = value;
        if (result !== "" && value !== "" && operator !== "") {
            switch (operatorCliked) {
                case "*":
                    newResult = result === "" ? parseFloat(value) : parseFloat(result) * parseFloat(value);
                    break;

                case "/":
                    newResult = parseFloat(result) / parseFloat(value);
                    if (value === "0") newResult = "ERREUR";
                    break;

                case "+":
                    newResult = parseFloat(result) + parseFloat(value);
                    break;

                case "-":
                    newResult = parseFloat(result) - parseFloat(value);

                    break;
                default:
                    newResult = value;
                    break;
            }
        }
        setResult(newResult.toString());
        setValue("");
        e.currentTarget.value === "=" && setValue(newResult);
    })

    const handleClickReset = useCallback(() => {
        setValue("0");
        setOperator("");
        setResult("");
    })
    const handleClickResetValue = useCallback(() => {
        setValue("0");
        setOperator("");
    })

    return (<>
        <Header userConnected={userConnected} setUserConnected={setUserConnected} />
        <main className='container-fluid row justify-content-center'>
            <div className="col-8 row justify-content-between mt-5 mb-5 badass">
                <div className="col-12 row align-items-center p-0 m-0 ">
                    <div className="col-12 bg-dark text-light h-50 fw-bold text-end">
                        <div className="fs-1"><span>{operator}</span>{value}</div>
                        <div className="fs-3">{result}</div>
                    </div>
                </div>
                <div className="col-8 row">
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={7}
                            onClick={(e) => handleClickValue(e)}
                        >7</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={8}
                            onClick={(e) => handleClickValue(e)}
                        >8</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={9}
                            onClick={(e) => handleClickValue(e)}
                        >9</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={4}
                            onClick={(e) => handleClickValue(e)}
                        >4</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={5}
                            onClick={(e) => handleClickValue(e)}
                        >5</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={6}
                            onClick={(e) => handleClickValue(e)}
                        >6</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={1}
                            onClick={(e) => handleClickValue(e)}
                        >1</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={2}
                            onClick={(e) => handleClickValue(e)}
                        >2</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={3}
                            onClick={(e) => handleClickValue(e)}
                        >3</button>
                    </div>
                    <div className="col-8">
                        <button type="button" className="btn col-12  p-3 btn-secondary"
                            value={0}
                            onClick={(e) => handleClickValue(e)}
                        >0</button>
                    </div>
                    <div className="col-4">
                        <button type="button" className="btn col-12 p-3 btn-secondary"
                            value={"."}
                            onClick={(e) => handleClickValue(e)}
                        >.</button>
                    </div>
                </div>
                <div className="col-4 row">
                    <div className="col-6">
                        <button type="button" className="btn col-12 p-3 btn-info fw-bold"
                            onClick={e => handleClickResetValue(e)}
                            value="CE"
                        >CE</button>
                    </div>
                    <div className="col-6">
                        <button type="button" className="btn col-12 p-3 btn-info fw-bold"
                            onClick={e => handleClickReset(e)}
                            value="C"
                        >C</button>
                    </div>
                    <div className="col-6">
                        <button type="button" className="btn col-12 p-3 btn-warning fw-bold"
                            onClick={e => handleClickOperator(e)}
                            value="*"
                        >*</button>
                    </div>
                    <div className="col-6">
                        <button type="button" className="btn col-12 p-3 btn-warning fw-bold"
                            onClick={e => handleClickOperator(e)}
                            value="/"
                        >/</button>
                    </div>
                    <div className="col-6">
                        <button type="button" className="btn col-12 p-3 btn-warning fw-bold"
                            onClick={e => handleClickOperator(e)}
                            value="+"
                        >+</button>
                    </div>
                    <div className="col-6">
                        <button type="button" className="btn col-12 p-3 btn-warning fw-bold"
                            onClick={e => handleClickOperator(e)}
                            value="-"
                        >-</button>
                    </div>
                    <div className="col-12">
                        <button type="button" className="btn col-12 p-3 btn-success fw-bold"
                            onClick={e => handleClickOperator(e)}
                            value="="
                        >=</button>
                    </div>
                </div>
            </div>

        </main>
        <Footer />
    </>)

}

export default Calculatrice;
const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Calculatrice />);