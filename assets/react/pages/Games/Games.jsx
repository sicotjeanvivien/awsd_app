import { createRoot } from 'react-dom/client';
import React, { useState } from "react";

import routing from "../../Service/routing.json";

import Header from "../../component/Header/Header";
import Footer from "../../component/Footer/Footer";
import Cart_Games from './components/Cart_Games';

const Games = () => {

	const [userConnected, setUserConnected] = useState({});
	const [games, setGames] = useState([
		{
			"name": "Morpion",
			"rules": "Le premier joueur a aligner 3 symboles identiques gagne la partie. Attention, le joueur qui d\u00e9bute est toujours avantag\u00e9 pour gagner. Pensez donc \u00e0 alterner!",
			"image": "\/img\/morpion_img.png",
			"link": routing.game_morpion.path
		},
		{
			"name": "Cabdy-Crush v1",
			"rules": "Aligner 3 bonbons identiques pour gagner des points.",
			"image": "\/img\/candy_crush.png",
			"link": routing.game_candy_crush.path
		}
	]);

	return (
		<>
			<Header userConnected={userConnected} setUserConnected={setUserConnected} />
			<main className='container'>
				<div className="row ">
					<Cart_Games games={games} />
				</div>
			</main>
			<Footer />
		</>
	)
}
export default Games;

const container = document.getElementById('root');
const root = createRoot(container);
root.render(<Games />);