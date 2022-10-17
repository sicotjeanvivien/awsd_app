import { createRoot } from 'react-dom/client';
import React, { useCallback, useEffect, useState } from "react";

import Header from "../../../component/Header/Header";
import Footer from "../../../component/Footer/Footer";
import ChuckNorrisFactApi from './Service/chuckNorrisFactApi';
import Spinner from '../../../component/Spinner';
import Fact from './component/Fact';

const ChuckNorrisFact = () => {

	const [userConnected, setUserConnected] = useState({});
	const [fact, setFact] = useState({});
	const [contentView, setContentView] = useState(<Spinner />);

	useEffect(() => {
		console.log("start chuck norris fact random");
		ChuckNorrisFactApi.getRandom().then(res => {
			setFact(res);
		});
	}, []);

	useEffect(() => {
		if (fact.fact) {
			setContentView(<Fact fact={fact} handclickLiked={handclickLiked} handclickDisliked={handclickDisliked} />)
		}
	}, [fact]);

	// ACTION


	const handclickLiked = useCallback((e) => {
		console.log("handclickLiked");
		ChuckNorrisFactApi.put

	});

	const handclickDisliked = useCallback((e) => {
		console.log("handclickDisliked");
	});

	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<div className='container mt-2 mb-2'>
				<h1 className='text-center'>Chuck Norris Fact</h1>
				<div className="row mt-5 mb-5 ">
					{contentView}
				</div>
			</div>
			<div></div>

			<Footer />
		</>
	)
}

export default ChuckNorrisFact;

const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<ChuckNorrisFact />);