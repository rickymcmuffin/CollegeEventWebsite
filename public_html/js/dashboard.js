var publicParent;
var privateParent;
var rsoParent;

window.onload = function () {
	console.log("window loaded");
	publicParent = document.getElementById("publicEventList");
	privateParent = document.getElementById("privateEventList");
	rsoParent = document.getElementById("rsoEventList");

	fetch("/php/isAdmin.php")
		.then((res) => res.json())
		.then((res) => {
			console.log("we in da fetch 0: " + res.Admin);
			if (res.Admin == 1) {
				document.getElementById("newEvent").removeAttribute("disabled");
			}
		});

	searchEvents();
};

// type must be "public", "private", or "rso".
function showEvent(name, type, id) {
	console.log("ohyea");
	const newEvent = document
		.getElementById("eventTemplate")
		.cloneNode((deep = true));

	newEvent.classList.remove("invisible");
	console.log(newEvent.children[0].innerHTML);
	newEvent.children[0].innerHTML = name;
	newEvent.children[1].innerHTML = id;
	newEvent.name = id;

	newEvent.addEventListener("click", function () {
		window.location = "/dashboard/eventpage.php?id=" + id;
	});
	if (type == "public")
		publicParent.appendChild(newEvent);
	if (type == "private")
		privateParent.appendChild(newEvent);
	if (type == "rso")
		rsoParent.appendChild(newEvent);
}

// doesn't actually search yet
function searchEvents() {
	const url = "/php/readEvents.php";

	fetch(url)
		.then((res) => res.json())
		.then((res) => {
			console.log("we in da fetch");
			if (res.value == 0) {
				return alert(res.error);
			}
			for (const event of res.publicData) {
				showEvent(event.name, event.type, event.id);
			}
			for (const event of res.privateData) {
				showEvent(event.name, event.type, event.id);
			}
			for (const event of res.rsoData) {
				showEvent(event.name, event.type, event.id);
			}
		});
}


