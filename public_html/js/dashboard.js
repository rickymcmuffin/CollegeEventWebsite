console.log("dashboard.js loaded");

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

  publicParent.appendChild(newEvent);
}
