document.addEventListener("DOMContentLoaded", function() {
    var listItems = document.querySelectorAll("li");
    listItems.forEach(function(item) {
        var label = item.querySelector("label");
        // Vérifier si le label existe et si son title est "osi_projets"
        if (label && label.getAttribute("title") === "osi_projets") {
            // Supprimer l'élément <li> du DOM
            item.remove();
        }
    });
});