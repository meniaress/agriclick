
    

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profile-pic');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    
    
    
    
    
    function validation() {
        
        const input = document.querySelector('input[name="nom"]'); 
        if (input.value === "") { 
            alert("Le champ nom est requis!");
            return false; 
        }
        return true; 
    }
    

    function validateNomPrenom() {
        const nom = document.getElementById("nom").value;
        const prenom = document.getElementById("prenom").value;
        const verif = /^[a-zA-Z\s]*$/;  

        const isNomValid = verif.test(nom) && nom.length >= 3;
        const isPrenomValid = verif.test(prenom) && prenom.length >= 3;

      
        if (isNomValid && isPrenomValid) {
            document.getElementById("message").innerHTML = "Correct";
            document.getElementById("message").className = "valid";
        } else {
            document.getElementById("message").innerHTML = "Le nom et le prénom doivent contenir au moins 3 caractères et uniquement des lettres !";
            document.getElementById("message").className = "invalid";
        }
    }

   
    function validateEmail() {
        const email = document.getElementById("email").value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/; // Vérifie le format de l'email

        if (emailPattern.test(email)) {
            document.getElementById("emailMessage").innerHTML = "Email correct";
            document.getElementById("emailMessage").className = "valid";
        } else {
            document.getElementById("emailMessage").innerHTML = "Veuillez entrer un email valide !";
            document.getElementById("emailMessage").className = "invalid";
        }
    }

    function validatePhoneNumber() {
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
}
    function validateUsername() {
    const username = document.getElementById("nom_utilisateur").value;
    
    const usernamePattern = /^[a-zA-Z0-9]{8,16}$/;  
    const digitCount = (username.match(/\d/g) || []).length;  

   
    if (usernamePattern.test(username) && digitCount <= 3) {
        document.getElementById("usernameMessage").innerHTML = "Nom d'utilisateur correct";
        document.getElementById("usernameMessage").className = "valid";
    } else {
        document.getElementById("usernameMessage").innerHTML = "Le nom d'utilisateur doit contenir entre 8 et 16 caractères,inclure des chiffres et des lettres,ne pas avoir plus de 3 chiffres,et ne pas contenir de caractères spéciaux.";
        document.getElementById("usernameMessage").className = "invalid";
    }}



    function validateUsername1() {
    const username = document.getElementById("username").value;
    
    const usernamePattern = /^[a-zA-Z0-9]{8,16}$/; 
    const digitCount = (username.match(/\d/g) || []).length;  

   
    if (usernamePattern.test(username) && digitCount <= 3) {
        document.getElementById("userMessage").innerHTML = "Nom d'utilisateur correct";
        document.getElementById("userMessage").className = "valid";
    } else {
        document.getElementById("userMessage").innerHTML = "Rappel : le nom d'utilisateur doit contenir entre 8 et 16 caractères, inclure des chiffres et des lettres, ne pas comporter plus de 3 chiffres, et ne pas contenir de caractères spéciaux."
        document.getElementById("userMessage").className = "invalid";
    }}



    function validatePassword1() {
    const password = document.getElementById("motdepasse").value;
    const passwordMessage = document.getElementById("passMessage");  
    
    
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,16}$/; 


    if (passwordPattern.test(password)) {
        passwordMessage.innerHTML = "Mot de passe correct";
        passwordMessage.className = "valid";  
    } else {
        passwordMessage.innerHTML = "Rappel :Le mot de passe doit contenir entre 8 et 16 caractères,incluant au moins 1 lettre majuscule,1 lettre minuscule,et 1 chiffre.";
        passwordMessage.className = "invalid";  
    }
}

    function validatePassword() {
    const password = document.getElementById("password").value;
    const passwordMessage = document.getElementById("passwordMessage");  
    
    
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,16}$/; 


    if (passwordPattern.test(password)) {
        passwordMessage.innerHTML = "Mot de passe correct";
        passwordMessage.className = "valid";  
    } else {
        passwordMessage.innerHTML = "Le mot de passe doit contenir entre 8 et 16 caractères,incluant au moins 1 lettre majuscule,1 lettre minuscule,et 1 chiffre.";
        passwordMessage.className = "invalid";  
    }
}


document.getElementById("password").addEventListener('keyup', validatePassword);


    
    document.getElementById("nom").addEventListener('keyup', validateNomPrenom);
    document.getElementById("prenom").addEventListener('keyup', validateNomPrenom);
    document.getElementById("email").addEventListener('keyup', validateEmail);
    document.getElementById("nom_utilisateur").addEventListener('keyup', validateUsername);
    document.getElementById("username").addEventListener('keyup', validateUsername1);
    document.getElementById("password").addEventListener('keyup', validatePassword);
    document.getElementById("motdepasse").addEventListener('keyup', validatePassword1);
    document.getElementById("telephone").addEventListener('keyup', validatePhoneNumber);


   
function validateForm() {
   
    const nom = document.getElementById("nom").value;
    const prenom = document.getElementById("prenom").value;
    const nom_utilisateur = document.getElementById("nom_utilisateur").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const telephone = document.getElementById("telephone").value;
    const choix = document.getElementById("choix").value;

    
    if (nom === "" || prenom === "" || nom_utilisateur === "" || email === "" || password === "" || telephone === "" || choix === "") {
        
        alert("Tous les champs doivent être remplis !");
        return false; 
    }

    return true; 
}


