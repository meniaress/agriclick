document.getElementById("partnershipForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Empêcher la soumission du formulaire avant la validation

    // Réinitialiser les erreurs
    resetErrors();

    // Récupérer les valeurs des champs
    var partnerName = document.getElementById("partnerName").value.trim();
    var contactName = document.getElementById("contactName").value.trim();
    var email = document.getElementById("email").value.trim();
    var phone = document.getElementById("phone").value.trim();
    var partnershipType = document.getElementById("partnershipType").value;
    var description = document.getElementById("description").value.trim();

    var isValid = true;

    // Validation du nom de l'organisation
    var partnerNamePattern = /^[a-zA-Z0-9\s]+$/; // Autorise uniquement lettres, chiffres et espaces
    if (partnerName === "") {
        showError("partnerNameError");
        isValid = false;
    } else if (partnerName.length > 10) {
        showError("partnerNameLengthError");
        isValid = false;
    } else if (!partnerNamePattern.test(partnerName)) {
        showError("partnerNameSpecialCharError");
        isValid = false;
    }

    // Validation du nom du responsable
    var contactNamePattern = /^[a-zA-Z\s]+$/; // Autorise uniquement lettres et espaces
    if (contactName === "") {
        showError("contactNameError");
        isValid = false;
    } else if (contactName.length > 20) {
        showError("contactNameLengthError");
        isValid = false;
    } else if (!contactNamePattern.test(contactName)) {
        showError("contactNameSpecialCharError");
        isValid = false;
    }

    // Validation de l'email avec une expression régulière
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        showError("emailError");
        isValid = false;
    }

    // Validation du numéro de téléphone
    var phonePattern = /^\+216\s?\d{2}\s?\d{3}\s?\d{3}$/;
    if (!phonePattern.test(phone)) {
        showError("phoneError");
        isValid = false;
    }

    // Validation du type de partenariat
    if (partnershipType === "") {
        showError("partnershipTypeError");
        isValid = false;
    }

    // Validation de la description (autorise seulement les lettres, chiffres, espaces et un point)
    var descriptionPattern = /^[a-zA-Z0-9\s.]+$/; 
    if (description === "") {
        showError("descriptionError");
        isValid = false;
    } else if (!descriptionPattern.test(description)) {
        showError("descriptionSpecialCharError");
        isValid = false;
    }

    // Soumission du formulaire si tout est valide
    if (isValid) {
        alert("Demande de partenariat soumise avec succès !");
        this.submit();
    }
});


function showError(errorId) {
    document.getElementById(errorId).style.display = "block";
}

function resetErrors() {
    var errorElements = document.querySelectorAll(".text-danger");
    errorElements.forEach(function(error) {
        error.style.display = "none";
    });
}





(function ($) {
    "use strict";

    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 40) {
            $('.navbar').addClass('sticky-top');
        } else {
            $('.navbar').removeClass('sticky-top');
        }
    });
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });


    // Product carousel
    $(".product-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 45,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
    });
    
})(jQuery);

