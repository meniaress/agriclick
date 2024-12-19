<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>agriclick</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <title>Jeu chat</title>
    <style>
       #gameContainer {
    position: relative;
    width: 100%;
    height: 300px; /* Ajustez la hauteur selon vos besoins */
    border: 2px solid #000; /* Bordure pour le cadre du jeu */
    overflow: hidden; /* Pour cacher les obstacles qui sortent du cadre */
}

#dino {
    position: absolute;
    bottom:20px;
    left: 50px;
    width: 50px;
    height: auto;
   /* background-color: rgb(165, 132, 14);*/
}

.obstacle {
    position: absolute;
    bottom: 20px;
    width: 20px;
    height: 50px;
    background-color: rgb(7, 30, 4);
}

#score {
    position: absolute;
    top: 10px; /* Position en haut de l'écran */
    left: 50px; /* Position à gauche */
    font-size: 30px; /* Taille de la police */
    color: black; /* Couleur du texte */
}
:root {
    --background-color-light: #ffffff;
    --text-color-light: #000000;
    --background-color-dark: #121212;
    --text-color-dark: #ffffff;
}

body {
    background-color: var(--background-color-light);
    color: var(--text-color-light);
}

.dark-mode {
    background-color: var(--background-color-dark);
    color: var(--text-color-dark);
}
.toggle-button {
    position: relative;
    padding: 10px 10px;
    border: none;
    border-radius: 5px;
    background-color: #002400;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.toggle-button:hover {
    background-color: #000;
}

.toggle-button i {
    font-size: 18px;
    margin-right: 10px;
}

#moon-icon {
    display: block;
}

#sun-icon {
    display: none;
}

.dark-mode .toggle-button #moon-icon {
    display: none;
}

.dark-mode .toggle-button #sun-icon {
    display: block;
}

#toggle-text {
    font-size: 16px;
    font-weight: bold;
}
    </style>
     <meta charset="UTF-8">
    <title>AJAX Live Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>

<body>
    
  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-5">
    <a href="index.html" class="navbar-brand">
            <h1 class="m-0 display-4 text-secondary"><span class="text-white">Agri</span>CLICK</h1>
        </a>
        <div class="col-lg-3">
                <div class="m-0  align-items-center justify-content-start">
                    <img src="img/logo.png" alt="Logo" style="height: 100px;"> 
                </div>
            </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="/projet%202/view/front office/vet.html" class="nav-item nav-link">Accueil</a>
                <a href="about.html" class="nav-item nav-link">a propos nous</a>
                <a href="../indexcategorieclient.php" class="nav-item nav-link ">cat/of Travail</a>
                <a href="../ServiceList.php" class="nav-item nav-link ">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">suivi veterinaire</a>
                    <div class="dropdown-menu m-0">
                        <a href="animal.php" class="dropdown-item"> Ajouter un animal </a>
                        <a href="consult.php" class="dropdown-item">Créer une consultation</a>
                    </div>
                </div>
                <a href="../form.php" class="nav-item nav-link">Reclamation</a>

                
                
            </div>
            <div class="d-flex">
                <a href="http://localhost/projet%202/view/front office/profile.php" class="nav-item nav-link" id="signin-btn">Voir le profil</a>
                <a href="http://localhost/projet%202/controllers/deconnexion.php" class="nav-item nav-link" id="signin-btn">se déconnecter</a>
                
            </div>
        </div>
        
    </nav>
    
    <!-- Navbar End -->
    <!-- Animal Form Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="mb-4">Animal Information Form</h2>
                    <form id="animalForm" action="addaniml.php" method="POST" >
                        <div class="mb-3">
                            <label for="nom_ani" class="form-label">Nom de l'animal</label>
                            <input type="text" class="form-control" id="nom_ani" name="nom_ani" required>
                        </div>
                        <div class="mb-3">
                            <label for="espece" class="form-label">Espèce</label>
                            <input type="text" class="form-control" id="espece" name="espece" required>
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <input type="text" class="form-control" id="genre" name="genre" required>
                        </div>
                        <div class="mb-3">
                            <label for="race" class="form-label">Race</label>
                            <input type="text" class="form-control" id="race" name="race" required>
                        </div>
                        <div class="mb-3">
                            <label for="poid" class="form-label">Poids (kg)</label>
                            <input type="number" class="form-control" id="poid" name="poid" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Âge (années)</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_nais" class="form-label">Date de Naissance</label>
                            <input type="date" class="form-control" id="date_nais" name="date_nais" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Animal Form End -->
    <div class="container-fluid py-5">
    <div class="container">
        <h2 class="mb-4">Aventure du Chat: Cliquez pour Gagner!</h2>
        <div id="gameContainer" style="position: relative; width: 100%; height: 300px; border: 2px solid #000;">
            <div id="score">Score: 0</div> <!-- Élément pour afficher le score -->
            <div id="dino"> <img id="dino" src="chat.png" alt="Chat" style="width: 50px; height: auto; position: absolute; bottom: 20px; left: 50px;"></div>
        </div>
    </div>
</div>
    <!-- affichage -->
    <?php
    
    include_once '../../controllers/crud.php';
$animalController = new CrudAnimals();

// Capture search input
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Fetch animals based on search term
if ($searchTerm) {
    $animalList = $animalController->searchAnimals($searchTerm);
} else {
    $animalList = $animalController->listAnimals(); // Fetch all animals if no search term
}
?>
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="rounded h-100 p-4" style=" background-color : #002400">
                        <h6 class="mb-4">List of Animals</h6>
                        <input type="text" name="search" placeholder="Search by name or species" class="form-control mb-3" value="<?= htmlspecialchars($searchTerm); ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        
                                        <th scope="col">Nom de l'animal</th>
                                        <th scope="col">Espéce</th>
                                        <th scope="col">genre</th>
                                        <th scope="col">race</th>
                                        <th scope="col">poids</th>
                                        <th scope="col">Date de naissance</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($animalList)) {
                                        $index = 1;
                                        foreach ($animalList as $animal) {
                                    ?>
                                    <tr>
                                    <th scope="row"><?= $index++; ?></th>
                                <td hidden="hidden"><?= $animal['id_ani']; ?></td>
                                <td><?= htmlspecialchars($animal['nom_ani']); ?></td>
                                <td><?= htmlspecialchars($animal['espece']); ?></td>
                                <td><?= htmlspecialchars($animal['genre']); ?></td>
                                <td><?= htmlspecialchars($animal['race']); ?></td>
                                <td><?= htmlspecialchars($animal['poid']); ?></td>
                                <td><?= htmlspecialchars($animal['date_nais']); ?></td>
                                <td><?= htmlspecialchars($animal['age']); ?></td>
                                <td>
                                            <a href="deleteanim.php?id_animal=<?php echo $animal['id_ani']; ?>" class="btn btn-outline-danger m-2">Delete</a>
                                            <a href="updateAnimal.php?id_animal=<?= $animal['id_ani']; ?>" class="btn btn-outline-success m-2">Update</a>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    } else {
                                    ?>
                                    <tr>
                                        <td colspan="10">No animals found.</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
        </div>
    </div>
    </div>
    <!--end affichage-->

    <script>
$(document).ready(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val();
        if (query.length > 2) {
            $.ajax({
                url: 'search.php',
                type: 'POST',
                data: { search: query },
                success: function(data) {
                    $('#result').html(data);
                }
            });
        } else {
            $('#result').html('');
        }
    });
});
</script>
    <script>
       function toggleDarkMode() {
    const isDark = document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
    const toggleButton = document.querySelector('.toggle-button');
    if (isDark) {
        toggleButton.textContent = 'Light Mode';
    } else {
        toggleButton.textContent = ' Dark Mode';
    }
}
script>
       /* function validateForm() {
            var nomAni = document.getElementById("nom_ani").value;
            var espece = document.getElementById("espece").value;
            var genre = document.getElementById("genre").value;
            var race = document.getElementById("race").value;
            var poid = document.getElementById("poid").value;
            var age = document.getElementById("age").value;
            var dateNais = document.getElementById("date_nais").value;

            // Check if all fields are filled
            if (nomAni.trim() === "" || espece.trim() === "" || genre.trim() === "" || race.trim() === "" || poid.trim() === "" || age.trim() === "" || dateNais.trim() === "") {
                alert("Tous les champs sont obligatoires.");
                return false;
            }

            // Validate Animal Name
            if (nomAni.length <= 5) {
                alert("Le nom de l'animal doit contenir plus de 5 caractères.");
                return false;
            }

            var firstChar = nomAni.charAt(0);
            if (firstChar !== firstChar.toUpperCase()) {
                alert("Le nom de l'animal doit commencer par une lettre majuscule.");
                return false;
            }

            if (/\d/.test(nomAni)) {
                alert("Le nom de l'animal ne doit pas contenir de chiffres.");
                return false;
            }

            if (/[!@#$%^&*(),.?":{}|<>]/.test(nomAni)) {
                alert("Le nom de l'animal ne doit pas contenir de signes spéciaux.");
                return false;
            }

            // Validate Weight
            if (isNaN(poid) || poid <= 0) {
                alert("Le poids doit être un nombre positif.");
                return false;
            }

            // Validate Age
            if (isNaN(age) || age < 0) {
                alert("L'âge doit être un nombre positif.");
                return false;
            }

            // Validate Date of Birth
            if (!/^\d{4}-\d{2}-\d{2}$/.test(dateNais)) {
                alert("La date de naissance doit être au format YYYY-MM-DD.");
                return false;
            }

            // If all validations pass
            return true;
        }*/
// On page load
document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }
});
       
document.getElementById('animalForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    let isValid = true;

    // Clear previous error messages
    document.querySelectorAll('.error-message').forEach(function(el) {
        el.remove();
    });

    // Validate text inputs
    ['nom_ani', 'espece', 'genre', 'race'].forEach(function(id) {
        const input = document.getElementById(id);
        if (input.value.length < 3 || input.value.length > 20 ) {
            isValid = false;
            const error = document.createElement('div');
            error.className = 'error-message text-danger';
            error.innerText = 'Must be between 3 and 20 characters';
            input.parentNode.appendChild(error);
        }
    });
   
    // Validate number inputs
    ['poid', 'age'].forEach(function(id) {
        const input = document.getElementById(id);
        if (!input.value) {
            isValid = false;
            const error = document.createElement('div');
            error.className = 'error-message text-danger';
            error.innerText = 'This field is required';
            input.parentNode.appendChild(error);
        }
    });

    // Validate date input
    const dateInput = document.getElementById('date_nais');
    if (!dateInput.value) {
        isValid = false;
        const error = document.createElement('div');
        error.className = 'error-message text-danger';
        error.innerText = 'This field is required';
        dateInput.parentNode.appendChild(error);
    }

    // If the form is valid, submit the form
    if (isValid) {
        alert('Form submitted successfully!');
        document.getElementById('animalForm').submit(); // Submit the form manually
    }
});

</script>
<script>let gameStarted = false; // Variable to track if the game has started
const dino = document.getElementById('dino');
const scoreDisplay = document.getElementById('score'); // Élément pour afficher le score
let isJumping = false;
let score = 0; // Initialisation du score

// Écouteur d'événements pour le saut
document.addEventListener('keydown', function(event) {
    // Prevent default action for space key
    if (event.code === 'Space') {
        event.preventDefault(); // Prevent scrolling
        if (!isJumping) {
            isJumping = true;
            dino.style.bottom = '150px'; // Position de saut
            setTimeout(() => {
                dino.style.bottom = '20px'; // Position normale
                isJumping = false;
            }, 500);
        }
    }
});

// Function to start the game
function startGame() {
    if (!gameStarted) {
        gameStarted = true; // Set the game as started
        setInterval(createObstacle, 2000); // Start creating obstacles
    }
}

// Add click event listener to the game container
document.getElementById('gameContainer').addEventListener('click', startGame);

// Function to create an obstacle
function createObstacle() {
    const obstacle = document.createElement('div');
    obstacle.classList.add('obstacle');
    obstacle.style.left = '100%'; // Commence à droite de l'écran
    gameContainer.appendChild(obstacle);
    moveObstacle(obstacle);
}

// Function to move the obstacle
function moveObstacle(obstacle) {
    let position = gameContainer.offsetWidth; // Utilise la largeur du conteneur
    const interval = setInterval(() => {
        if (position < -20) {
            clearInterval(interval);
            obstacle.remove();
            updateScore(); // Met à jour le score lorsque l'obstacle est évité
        } else {
            position -= 5; // Vitesse de l'obstacle
            obstacle.style.left = position + 'px';

            // Vérification de collision
            if (checkCollision(obstacle)) {
                alert('Game Over! Votre score est : ' + score);
                clearInterval(interval);
                location.reload(); // Redémarre le jeu
            }
        }
    }, 20);
}

// Function to check collision
function checkCollision(obstacle) {
    const dinoRect = dino.getBoundingClientRect();
    const obstacleRect = obstacle.getBoundingClientRect();

    return !(
        dinoRect.right < obstacleRect.left ||
        dinoRect.left > obstacleRect.right ||
        dinoRect.bottom < obstacleRect.top ||
        dinoRect.top > obstacleRect.bottom
    );
}

// Function to update the score
function updateScore() {
    score++; // Incrémente le score
    scoreDisplay.textContent = 'Score: ' + score; // Met à jour l'affichage du score
}


            </script>
          
<script>
window.embeddedChatbotConfig = {
chatbotId: "-Wl1GRqkm6ByF6KeAocQW",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="-Wl1GRqkm6ByF6KeAocQW"
domain="www.chatbase.co"
defer>
</script>
    <!-- About Start -->
    <div class="container-fluid about pt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="d-flex h-100 border border-5 border-primary border-bottom-0 pt-4">
                        <img class="img-fluid mt-auto mx-auto" src="img/about.png">
                    </div>
                </div>
                <div class="col-lg-6 pb-5">
                    <div class="mb-3 pb-2">
                        <h6 class="text-primary text-uppercase">About Us</h6>
                        <h1 class="display-5">We Produce Organic Food For Your Family</h1>
                    </div>
                    <p class="mb-4">Tempor erat elitr at rebum at at clita. Diam dolor diam ipsum et tempor sit. Clita erat ipsum et lorem et sit, sed stet no labore lorem sit. Sanctus clita duo justo et tempor eirmod magna dolore erat amet magna</p>
                    <div class="row gx-5 gy-4">
                        <div class="col-sm-6">
                            <i class="fa fa-seedling display-1 text-secondary"></i>
                            <h4>100% Organic</h4>
                            <p class="mb-0">Labore justo vero ipsum sit clita erat lorem magna clita nonumy dolor magna dolor vero</p>
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-award display-1 text-secondary"></i>
                            <h4>Award Winning</h4>
                            <p class="mb-0">Labore justo vero ipsum sit clita erat lorem magna clita nonumy dolor magna dolor vero</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-footer bg-primary text-white mt-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <h4 class="text-white mb-4">Get In Touch</h4>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-white me-2"></i>
                                <p class="text-white mb-0">123 Street, New York, USA</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-white me-2"></i>
                                <p class="text-white mb-0">agriclick@gmail.com</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-white me-2"></i>
                                <p class="text-white mb-0">+21629888973</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-secondary btn-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-secondary btn-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white mb-4">Quick Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Home</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>About Us</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Our Services</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Meet The Team</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Latest Blog</a>
                                <a class="text-white" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Contact Us</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <h4 class="text-white mb-4">Popular Links</h4>
                            <div class="d-flex flex-column justify-content-start">
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Home</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>About Us</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Our Services</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Meet The Team</a>
                                <a class="text-white mb-2" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Latest Blog</a>
                                <a class="text-white" href="#"><i class="bi bi-arrow-right text-white me-2"></i>Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <a class="text-secondary fw-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed by <a class="text-secondary fw-bold" href="https://htmlcodex.com">HTML Codex</a></p>
           
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>