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
			console.log("superadmin: " + res.SuperAdmin);
			if (res.Admin == 1) {
				document.getElementById("newEvent").removeAttribute("disabled");
			}
			if(res.SuperAdmin == 1){
				console.log("GAAHHH");
				document.getElementById("newUniv").innerHTML = "Edit University";
			}
			if(res.univName != null){
				document.getElementById("yourUniv").removeAttribute("disabled");
				document.getElementById("yourUniv").innerHTML = res.univName;
				document.getElementById("yourUniv").addEventListener("click", function(){
					window.location = "universitypage.php?id=" + res.univId;
				});
			}
		});

	document.getElementById("newEvent").addEventListener("click", function(){
		showForm();
	});
	document.getElementById("newUniv").addEventListener("click", function(){
		showUnivForm();
	});
	searchEvents();
};

// type must be "public", "private", or "rso".
function showEvent(name, type, id) {
	console.log("fuck is ogin on?")
	console.log("ohyea");
	const newEvent = document
		.getElementById("eventTemplate")
		.cloneNode((deep = true));

	newEvent.classList.remove("invisible");
	console.log(newEvent.children[0].innerHTML);
	newEvent.children[0].innerHTML = name;
	//newEvent.children[1].innerHTML = id;
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

function showForm(){
	console.log("button clicked");
	const form = document.getElementById("formEvent");
	if(form.classList.contains("invisible")){
		form.classList.remove("invisible");
	} else {
		form.classList.add("invisible");
	}
}

function showUnivForm(){
	console.log("button clicked");
	const form = document.getElementById("formUniv");
	if(form.classList.contains("invisible")){
		form.classList.remove("invisible");
	} else {
		form.classList.add("invisible");
	}
}