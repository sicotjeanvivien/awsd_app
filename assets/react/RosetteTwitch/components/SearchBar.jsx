import React, { useCallback, useState } from "react";
import TwitchApi from "../../Service/TwitchApi";

const SearchBar = ({handleSelectedChannel, setChannels}) => {

	const [channelsView, setChannelsView] = useState("");
	const [querySearch, setQuerySearch] = useState("");

	const findChannels = useCallback(async (e) => {
		e.preventDefault();
		let renderView = "";
		let query = e.currentTarget.value;
		setQuerySearch(query);
		if (query.length > 2) {
			let api = new TwitchApi();
			let res = await api.searchChannel(query);
			setChannels(res);
			renderView = res.data.map((value, key) => {
				return (
					<li key={key} data-key={key} onClick={(e)=> handleSelectedChannel(e)}>
						<div className="d-flex justify-content-between">
							<div>{value.display_name}</div>
							<div>{value.game_name}</div>
						</div>
						<div>
							<div>{value.title}</div>
						</div>
					</li>);
			})
		}
		setChannelsView(renderView);
	})

	

	return (
		<div >
			<div className="mb-3">
				<label htmlFor="" className="form-label">Recherche une chaîne...</label>
				<input type="text" className="form-control" value={querySearch} onChange={e => findChannels(e)} placeholder="Rechercher par nom..." />
				<small> 3 caractère minimun pour effectuer une recherche</small>
			</div>
			<div className="mb-3">
				<ul className="custom-ul-list-channel">
					{channelsView}
				</ul>
			</div>
		</div>
	)
}

export default SearchBar;