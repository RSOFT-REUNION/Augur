// Table TR clickable
$("table").on("click", "tr[role=\"button\"]", function (e) {
    window.location = $(this).data("href");
});

$(function () {
    //Fonction permettant de rendre les DIV avec le rôle "button" cliquable.
    $("div").on("click", "div[role=\"button\"]", function (e) {
        window.location = $(this).data("href");
    })
})

// SLIDER PRIMARY
const slidesContainer = document.getElementById("slides-container");
const slide = document.querySelector(".slide");
const prevButton = document.getElementById("slide-arrow-prev");
const nextButton = document.getElementById("slide-arrow-next");

// Défilement automatique toutes les 30 secondes
setInterval(() => {
    const slideWidth = slide.clientWidth;
    slidesContainer.scrollLeft += slideWidth;

    if(slidesContainer.scrollLeft + slidesContainer.clientWidth >= slidesContainer.scrollWidth) {
        // Revenir au début du conteneur de diapositive
        slidesContainer.scrollLeft = 0;
    }

}, 30000);
nextButton.addEventListener("click", (even) => {
    const slideWidth = slide.clientWidth;
    slidesContainer.scrollLeft += slideWidth;

    if(slidesContainer.scrollLeft + slidesContainer.clientWidth >= slidesContainer.scrollWidth) {
        // Revenir au début du conteneur de diapositive
        slidesContainer.scrollLeft = 0;
    }
});
prevButton.addEventListener("click", (even) => {
    const slideWidth = slide.clientWidth;
    const scrollAmount = slideWidth


    if(slidesContainer.scrollLeft === 0) {
        // Si nous sommes au début, passer à la dernière diapositive
        slidesContainer.scrollLeft = slidesContainer.scrollWidth - slidesContainer.clientWidth;
    } else {
        slidesContainer.scrollLeft -= scrollAmount;
    }
});

