var fuck;
var publicParent;
var privateParent;
var rsoParent;

window.onload = function () {
  console.log("window loaded");
  publicParent = document.getElementById("publicEventList");
  privateParent = document.getElementById("privateEventList");
  rsoParent = document.getElementById("rsoEventList");
  fuck = document.getElementById("event1");

  fuck.addEventListener("click", function () {
    showEvent("poop", "crapU", "public", 11);
    //document.getElementById("label1").value = "You did it!";
  });

  searchEvents();
};

// type must be "public", "private", or "rso".
function showEvent(name, university, type, id) {
  const newEvent = document
    .getElementById("eventTemplate")
    .cloneNode((deep = true));

  newEvent.classList.remove("invisible");
  console.log(newEvent.children[0].innerHTML);
  newEvent.children[0].innerHTML = name;
  newEvent.children[1].innerHTML = university;
  newEvent.name = id;

  newEvent.addEventListener("click", function(){
	window.location = "/dashboard/eventpage.php?e=" + id;
  });

  publicParent.appendChild(newEvent);
}

// doesn't actually search yet
function searchEvents() {
  const url = "/php/readEvents.php";
  while (publicParent.children.length > 0) {
    publicParent.removeChild(publicParent.firstChild);
  }

  fetch(url)
    .then((res) => res.json())
    .then((res) => {
      console.log("we in da fetch");
      if (res.value == 0) {
        return alert(res.error);
      }
      for (const event of res.data) {
        showEvent(event.name, event.univId, event.type, event.id);
      }
    });
}


