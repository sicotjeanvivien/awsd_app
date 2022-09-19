import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";

// Components 
import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";
import SearchBar from "./components/SearchBar";

const RosetteTwitch = () => {

	const [userConnected, setUserConnected] = useState({});

	const [channelSelected, setChannelSelected] = useState();
	const [channels, setChannels] = useState();
	const [renderView, setRenderView] = useState();

	useEffect(() => {
		renderViewStream();
	}, [channelSelected]);

	const findChannels = useCallback((channels) => {
		setChannels(channels);
	})

	const handleSelectedChannel = useCallback((e) => {
		let elem = e.currentTarget;
		setChannelSelected(channels.data[elem.dataset.key]);
	});

	const renderViewStream = useCallback(() => {

	})

	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<main className='container'>
				<SearchBar handleSelectedChannel={handleSelectedChannel} setChannels={findChannels} />
			</main>
			<Footer />
		</>
	)
}

export default RosetteTwitch;

const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<RosetteTwitch />);