import { createRoot } from "react-dom/client";
import React, { useCallback, useEffect, useState } from "react";
// Components 
import SearchBar from "./components/SearchBar";
const RosetteTwitch = () => {

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
			<SearchBar handleSelectedChannel={handleSelectedChannel} setChannels={findChannels} />
		</>
	)
}

export default RosetteTwitch;

const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<RosetteTwitch />);