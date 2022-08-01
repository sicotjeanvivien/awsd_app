import { createRoot } from "react-dom/client";
import React from "react";
// Component
import Connexion from "../component/Connexion";

const container = document.getElementById('react_connexion');
const root = createRoot(container); 
root.render(<Connexion />);