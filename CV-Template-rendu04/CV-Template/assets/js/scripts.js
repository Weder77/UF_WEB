/*
* @Author: Théo
* @Date:   2019-03-18 18:33:03
* @Last Modified by:   Théo
* @Last Modified time: 2019-03-18 18:33:19
*/

function burger() 
{
	const barre1 = document.querySelector("#barre1");
	const barre2 = document.querySelector("#barre2");
	const barre3 = document.querySelector("#barre3");
	const burger = document.querySelector("#burger");

	//Ajout classes ON
	barre1.classList.toggle("animOnBarre1");
	barre2.classList.toggle("animOnBarre2");
	barre3.classList.toggle("animOnBarre3");
	burger.classList.toggle("animOn");

	//Ajout class OFF
	barre1.classList.toggle("animOffBarre1");
	barre3.classList.toggle("animOffBarre3");
	burger.classList.toggle("animOff");

	const header = document.querySelector("header");
	header.classList.toggle("visible");
}