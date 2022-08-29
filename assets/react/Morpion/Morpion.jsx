import { createRoot } from 'react-dom/client';
import React, { useCallback, useEffect, useState } from "react";
import Case from "./component/Case";

const MorpionGame = () => {
	const boardStart = [
		{ "index": 0, "value": "" },
		{ "index": 1, "value": "" },
		{ "index": 2, "value": "" },
		{ "index": 3, "value": "" },
		{ "index": 4, "value": "" },
		{ "index": 5, "value": "" },
		{ "index": 6, "value": "" },
		{ "index": 7, "value": "" },
		{ "index": 8, "value": "" },
	]
	const [player, setPlayer] = useState("X");
	const [playerStart, setPlayerStart] = useState("O");
	const [gameFinished, setGameFinished] = useState(false);
	const [board, setBoard] = useState(boardStart);
	const [gameStatus, setGameStatus] = useState("Tour du joueur " + player);
	const [scorePlayerX, setScorePlayerX] = useState(0);
	const [scorePlayerO, setScorePlayerO] = useState(0);

	const clickCase = useCallback((e) => {
		if (
			!gameFinished
			&& e.target !== null
			&& e.target instanceof HTMLElement
			&& e.target.dataset.index
		) {
			let index = parseInt(e.target.dataset.index);
			let newBoard = [];
			let newPlayer = "X";
			board.map((value, key) => {
				if (value.index === index && value.value === "") {
					value.value = player;
					if (player === "X") newPlayer = "O";
				};
				newBoard = [...newBoard, value];
			})

			displayedTurn(newPlayer, newBoard);
			setBoard(newBoard);
		}
	}, [board, player, gameStatus]);

	const displayedTurn = (newPlayer, newBoard) => {
		if (checkWinner()) {
			switch (player) {
				case "X":
					setScorePlayerX(scorePlayerX + 1);
					break;
				case "O":
					console.log("porut");
					setScorePlayerO(scorePlayerO + 1);
					break;
			}
			playerStart === "X" ? setPlayerStart("O") : setPlayerStart("X");
			setPlayer(playerStart);
			setGameStatus("Victoire du joueur " + player);
			setGameFinished(true);
		} else if (!checkCellIfVoid(newBoard)) {
			setGameStatus("Match nul!!!");
		} else {
			setGameStatus("Tour du joueur " + newPlayer);
			setPlayer(newPlayer);
		}
	};

	const checkWinner = () => {
		const winningPattern = [
			[0, 1, 2],
			[3, 4, 5],
			[6, 7, 8],
			[0, 3, 6],
			[1, 4, 7],
			[2, 5, 8],
			[0, 4, 8],
			[2, 4, 6]
		];
		return winningPattern.some(combination => {
			return combination.every((index) => {
				return player === board[index].value;
			})

		})
	};

	const checkCellIfVoid = (newBoard) => {
		return newBoard.find((cell) => {
			return cell.value === "";
		})
	};

	const handleClickNewGame = useCallback((e) => {
		e.preventDefault();
		setBoard(boardStart);
		setGameFinished(false);
		setGameStatus("Tour du joueur " + player);
	});

	const handleClickResetGame = useCallback((e) => {
		e.preventDefault();
		handleClickNewGame(e);
		setPlayerStart("O");
		setPlayer("X");
		setScorePlayerO(0);
		setScorePlayerX(0);
		setGameStatus("Tour du joueur " + "X");
	});

	return (
		<div className="row mb-2">
			<div className="col-12 ">
				<h1 className="text-center mt-2 mb-2">Morpion</h1>
			</div>
			<div className="col-8 p-0 text-center">
			<h3 className="text-center">{gameStatus}</h3>
				<div className="jeu">
					{
						board.map((value, key) => {
							return (
								<Case key={key} value={value} onClick={clickCase} />
							)
						})
					}
				</div>
			</div>
			<div className="col-4 ">
				<div className='d-flex justify-content-between'>
					<button type='button' className='btn btn-info' onClick={(e) => handleClickNewGame(e)} >Nouvelle partie</button>
					<button type='button' className='btn btn-info' onClick={(e) => handleClickResetGame(e)} >Nouveau jeux</button>
				</div>
				<div>
					<p><span className='fw-bold'> Score Joueur X : </span>{scorePlayerX} point</p>
					<p><span className='fw-bold'> Score Joueur O : </span>{scorePlayerO} point</p>
				</div>
			</div>
			<div className="col-2">

			</div>
		</div>
	)
}
export default MorpionGame;

const container = document.getElementById('root');
const root = createRoot(container); // createRoot(container!) if you use TypeScript
root.render(<MorpionGame />);