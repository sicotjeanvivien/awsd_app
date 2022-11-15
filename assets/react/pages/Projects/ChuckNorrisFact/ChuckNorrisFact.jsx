import { createRoot } from 'react-dom/client';
import React, { useCallback, useEffect, useState } from "react";

import Header from "../../../component/Header/Header";
import Footer from "../../../component/Footer/Footer";
import ChuckNorrisFactApi from './Service/chuckNorrisFactApi';
import Spinner from '../../../component/Spinner';
import Fact from './component/Fact';
import Form from './component/Form';

const ChuckNorrisFact = () => {

	const [userConnected, setUserConnected] = useState({});
	const [fact, setFact] = useState({});

	const [contentView, setContentView] = useState(<Spinner />);

	useEffect(() => {
		ChuckNorrisFactApi.getRandom().then(res => {
			renderView(res);
		});
	}, []);

	useEffect(() => {
		if (fact.fact) {
			setContentView(<Fact fact={fact}
				handleclickLiked={handleclickLiked}
				handleclickDisliked={handleclickDisliked}
				handleclickChangeView={handleclickChangeView}
			/>);
		}
	}, [fact]);


	// ACTION

	const handleclickLiked = useCallback((e) => {
		setContentView(<Spinner />)
		ChuckNorrisFactApi.put(fact.id, { "liked": (parseInt(fact.liked) + 1) }).then(res => {
			renderView(res);
		});
	});
	const handleclickDisliked = useCallback((e) => {
		setContentView(<Spinner />)
		ChuckNorrisFactApi.put(fact.id, { "disliked": (parseInt(fact.disliked) + 1) }).then(res => {
			renderView(res);
		});
	});

	const handleclickChangeView = useCallback((view) => {
		switch (view) {
			case "fact":
				setContentView(<Fact
					fact={fact}
					handleclickLiked={handleclickLiked}
					handleclickDisliked={handleclickDisliked}
					handleclickChangeView={handleclickChangeView}
				/>)
				break;
			case "form":
				setContentView(<Form
					handleclickChangeView={handleclickChangeView}
				/>)
				break;

			default:
				break;
		}

	})

	// VIEW

	const renderView = (res) => {
		if (res) {
			setFact(res)
		} else {
			setContentView(<div className='bg-danger'>error server</div>)
		};
	}


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