 function validateForm(event) {
        let isFormValid = true;

      
        const nom = document.getElementById("nom").value;
        const nomMessage = document.getElementById("nomMessage");
        const nomRegex = /^[a-zA-Z\s]*$/;
        if (!nomRegex.test(nom) || nom.length < 3) {
            nomMessage.innerHTML = "Le nom doit contenir au moins 3 caractères et uniquement des lettres !";
            nomMessage.className = "invalid";
            isFormValid = false;
        } else {
            nomMessage.innerHTML = "Nom valide";
            nomMessage.className = "valid";
        }

       
        const prenom = document.getElementById("prenom").value;
        const prenomMessage = document.getElementById("prenomMessage");
        if (!nomRegex.test(prenom) || prenom.length < 3) {
            prenomMessage.innerHTML = "Le prénom doit contenir au moins 3 caractères et uniquement des lettres !";
            prenomMessage.className = "invalid";
            isFormValid = false;
        } else {
            prenomMessage.innerHTML = "Prénom valide";
            prenomMessage.className = "valid";
        }

       
        
        const username = document.getElementById("nom_utilisateur").value;
        const usernameMessage = document.getElementById("usernameMessage");
        const usernamePattern = /^[a-zA-Z0-9]{8,16}$/;
        const digitCount = (username.match(/\d/g) || []).length;
        if (!usernamePattern.test(username) || digitCount > 3) {
            usernameMessage.innerHTML = "Le nom d'utilisateur doit contenir entre 8 et 16 caractères, inclure des chiffres et des lettres, ne pas avoir plus de 3 chiffres, et ne pas contenir de caractères spéciaux.";
            usernameMessage.className = "invalid";
            isFormValid = false;
        } else {
            usernameMessage.innerHTML = "Nom d'utilisateur correct";
            usernameMessage.className = "valid";
        }

       
        const phoneNumber = document.getElementById("telephone").value;
        const phoneMessage = document.getElementById("telephoneMessage");
    
       
        const phonePattern = /^[\d+\s]+$/;
    
        if (phonePattern.test(phoneNumber) && phoneNumber.length >= 8 && phoneNumber.length <= 15) {
            phoneMessage.innerHTML = "Numéro de téléphone correct";
            phoneMessage.className = "valid";
        } else {
            phoneMessage.innerHTML = "Le numéro de téléphone doit contenir uniquement des chiffres et le caractère'+',avec une longueur entre 8 et 15 caractères.";
            phoneMessage.className = "invalid";
        }

        
       
        const email = document.getElementById("email").value;
        const emailMessage = document.getElementById("emailMessage");
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            emailMessage.innerHTML = "Veuillez entrer un email valide !";
            emailMessage.className = "invalid";
            isFormValid = false;
        } else {
            emailMessage.innerHTML = "Email correct";
            emailMessage.className = "valid";
        }

        
        if (!isFormValid) {
            event.preventDefault();
        }
    }

  
    document.getElementById("client-form").addEventListener('submit', validateForm);
  