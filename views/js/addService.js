document.addEventListener("DOMContentLoaded", function(){

    var titleElement = document.getElementById("title");
    var descriptionelement = document.getElementById("description");

    titleElement.addEventListener("keyup", function(){
        var titleerrorElement = document.getElementById("titleError");
        var titleErrorValue = titleElement.value;
        var pattern = /^(?=.*[A-Za-z])[A-Za-z0-9 ]{3,}$/;
    
        if (titleErrorValue.length < 3) {
            titleerrorElement.innerHTML = "Le titre doit contenir au moins 3 caractères.";
            titleerrorElement.style.color = "red";
        } else if (!pattern.test(titleErrorValue)) {
            titleerrorElement.innerHTML = "Le titre doit contenir uniquement des lettres, des chiffres et des espaces, et au moins une lettre.";
            titleerrorElement.style.color = "red";
        } else {
            titleerrorElement.innerHTML = "Correct";
            titleerrorElement.style.color = "green";
        }
    });

    descriptionelement.addEventListener("keyup", function(){
        var descriptionerrorElement = document.getElementById("descriptionError");
        var descriptionerrorValue = descriptionelement.value;
        // Updated pattern to accept letters and numbers but not only numbers
        var pattern = /^(?=.*[A-Za-z])[A-Za-z0-9 ]{3,}$/;
        if(!pattern.test(descriptionerrorValue)){
            descriptionerrorElement.innerHTML = "La destination doit contenir uniquement des lettres, des chiffres et des espaces, et au moins 3 caractères, avec au moins une lettre.";
            descriptionerrorElement.style.color = "red";
        } else {
            descriptionerrorElement.innerHTML = "Correct";
            descriptionerrorElement.style.color = "green";
        }
    });

});