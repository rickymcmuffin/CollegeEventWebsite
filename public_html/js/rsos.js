var joinedParent;
var rsoParent;

window.onload = function () {
	console.log("window Loaded");

	joinedParent = document.getElementById("yourRSOList");
	rsoParent = document.getElementById("RSOList");

	getRSOs();
}


function showRSO(rso, isIn) {
	console.log("we showing");
	const newRSO = document
		.getElementById("rsoTemplate")
		.cloneNode(true);

	newRSO.classList.remove("invisible");

	newRSO.children[0].innerHTML = rso.name;
	newRSO.name = rso.id;
	if (isIn) {
		newRSO.children[1].addEventListener("click", function () {
			leaveRSO(newRSO, rso.id);
		});
		newRSO.children[1].innerHTML = "Leave";
		joinedParent.appendChild(newRSO);
	} else {
		newRSO.children[1].addEventListener("click", function () {
			joinRSO(newRSO, rso.id);
		});
		newRSO.children[1].innerHTML = "Join";
		rsoParent.appendChild(newRSO);
	}
}

function joinRSO(rsoElement, rsoId) {
	rsoElement.children[1].setAttribute("disabled", "");
	rsoElement.children[1].innerHTML = "Joined!";

	const url = "/php/joinRSO.php";
	fetch(url, {
		method: 'POST',
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({rsoId})
	});

}

function leaveRSO(rsoElement, rsoId) {
	rsoElement.children[1].setAttribute("disabled", "");
	rsoElement.children[1].innerHTML = "Left!";

	const url = "/php/leaveRSO.php";
	fetch(url, {
		method: 'POST',
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json'
		},
		body: JSON.stringify({rsoId})
	});
}


function getRSOs() {
	const url = "/php/readRSOs.php"
	fetch(url)
		.then((res) => res.json())
		.then((res) => {
			console.log("we in da rso fetch");
			if (res.value == 0) {
				return alert(res.error);
			}
			console.log("the value is " + res.value);
			for (const rso of res.yourData) {
				showRSO(rso, 1);
			}
			for (const rso of res.otherData) {
				showRSO(rso, 0);
			}
		});
}