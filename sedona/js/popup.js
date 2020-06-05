var btn = document.querySelector(".offer-btn");
var popupform = document.querySelector(".search-form");
var close = document.querySelector(".map");
var datein = popupform.querySelector("[name=datein]");
var dateout = popupform.querySelector("[name=dateout]");
var grownups = popupform.querySelector("[name=grownups]");
var children = popupform.querySelector("[name=children]");
var storagegrownups = localStorage.getItem("grownups");
var storagechildren = localStorage.getItem("children");
var error = popupform.classList.contains("popap-error");

btn.addEventListener("click", function(evt) {
  evt.preventDefault();
  popupform.classList.toggle("show-popup");
  popupform.classList.remove("popap-error");
});

close.addEventListener("click", function(evt) {
  popupform.classList.add("show-popup");
  popupform.classList.remove("popap-error");
});



popupform.addEventListener("submit", function(evt) {
  if (!datein.value || !dateout.value || !grownups.value) {
    evt.preventDefault();
    console.log("Нужно ввести логин и пароль");
    popupform.classList.remove("popap-error");
    popupform.offsetWidth = popupform.offsetWidth;
    popupform.classList.add("popap-error");
  } else {
    localStorage.setItem("children", children.value);
    localStorage.setItem("grownups", grownups.value);
  }
});

if (storagegrownups || storagechildren) {
  grownups.value = storagegrownups;
  children.value = storagechildren;
}
