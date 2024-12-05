// Fonction pour valider le nom et prénom en temps réel
function validateNomPrenom() {
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const verif = /^[a-zA-Z\s]*$/;

    const isNomValid = verif.test(nom) && nom.length >= 3;
    const isPrenomValid = verif.test(prenom) && prenom.length >= 3;

    const messageElement = document.getElementById("message");

    if (isNomValid && isPrenomValid) {
        messageElement.innerHTML = "Correct";
        messageElement.className = "valid";
        return true;
    } else {
        messageElement.innerHTML = "Le nom et le prénom doivent contenir au moins 3 caractères et uniquement des lettres !";
        messageElement.className = "invalid";
        return false;
    }
}

// Fonction pour valider l'email en temps réel
function validateEmail() {
    const email = document.getElementById("email").value;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const emailMessage = document.getElementById("emailMessage");

    if (emailPattern.test(email)) {
        emailMessage.innerHTML = "Email correct";
        emailMessage.className = "valid";
        return true;
    } else {
        emailMessage.innerHTML = "Veuillez entrer un email valide !";
        emailMessage.className = "invalid";
        return false;
    }
}

// Fonction pour valider le numéro de téléphone en temps réel
function validatePhoneNumber() {
    const phoneNumber = document.getElementById("telephone").value;
    const phoneMessage = document.getElementById("telephoneMessage");

    const phonePattern = /^[\d+\s]+$/;

    if (phonePattern.test(phoneNumber) && phoneNumber.length >= 8 && phoneNumber.length <= 15) {
        phoneMessage.innerHTML = "Numéro de téléphone correct";
        phoneMessage.className = "valid";
        return true;
    } else {
        phoneMessage.innerHTML = "Le numéro de téléphone doit contenir uniquement des chiffres et le caractère '+', avec une longueur entre 8 et 15 caractères.";
        phoneMessage.className = "invalid";
        return false;
    }
}

// Fonction pour valider le nom d'utilisateur en temps réel
function validateUsername() {
    const username = document.getElementById("nom_utilisateur").value;
    const usernamePattern = /^[a-zA-Z0-9]{8,16}$/;
    const digitCount = (username.match(/\d/g) || []).length;

    const usernameMessage = document.getElementById("usernameMessage");

    if (usernamePattern.test(username) && digitCount <= 3) {
        usernameMessage.innerHTML = "Nom d'utilisateur correct";
        usernameMessage.className = "valid";
        return true;
    } else {
        usernameMessage.innerHTML = "Le nom d'utilisateur doit contenir entre 8 et 16 caractères, inclure des chiffres et des lettres, ne pas avoir plus de 3 chiffres, et ne pas contenir de caractères spéciaux.";
        usernameMessage.className = "invalid";
        return false;
    }
}

// Fonction pour valider le mot de passe en temps réel
function validatePassword() {
    const password = document.getElementById("password").value;
    const passwordMessage = document.getElementById("passwordMessage");

    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,16}$/;

    if (passwordPattern.test(password)) {
        passwordMessage.innerHTML = "Mot de passe correct";
        passwordMessage.className = "valid";
        return true;
    } else {
        passwordMessage.innerHTML = "Le mot de passe doit contenir entre 8 et 16 caractères, incluant au moins 1 lettre majuscule, 1 lettre minuscule, et 1 chiffre.";
        passwordMessage.className = "invalid";
        return false;
    }
}

// Ajouter les écouteurs d'événements pour chaque champ de saisie
document.getElementById("nom").addEventListener("input", validateNomPrenom);
document.getElementById("prenom").addEventListener("input", validateNomPrenom);
document.getElementById("email").addEventListener("input", validateEmail);
document.getElementById("telephone").addEventListener("input", validatePhoneNumber);
document.getElementById("nom_utilisateur").addEventListener("input", validateUsername);
document.getElementById("password").addEventListener("input", validatePassword);

// Fonction pour valider le formulaire à la soumission
function validateForm(event) {
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const nom_utilisateur = document.getElementById("nom_utilisateur").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const telephone = document.getElementById("telephone").value;
    const choix = document.getElementById("choix").value;

    // Vérification des champs vides et validation en temps réel
    if (nom === "" || prenom === "" || nom_utilisateur === "" || email === "" || password === "" || telephone === "" || choix === "") {
        alert("Tous les champs doivent être remplis !");
        event.preventDefault(); 
        return false;
    }

    // Vérification de la validation des champs
    if (!validateNomPrenom() || !validateEmail() || !validatePhoneNumber() || !validateUsername() || !validatePassword()) {
        event.preventDefault(); 
        return false;
    }

    return true;
}

// Attacher l'écouteur pour la soumission du formulaire
document.getElementById("client-form").addEventListener("submit", validateForm);
