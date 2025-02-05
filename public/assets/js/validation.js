document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire d'inscription
    const registerForm = document.querySelector('form[action="/register"]');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas');
            }
        });
    }

    // Validation des rendez-vous
    const appointmentForm = document.querySelector('form[action="/appointments/create"]');
    if (appointmentForm) {
        appointmentForm.addEventListener('submit', function(e) {
            const dateTime = new Date(document.getElementById('date_time').value);
            const now = new Date();

            if (dateTime < now) {
                e.preventDefault();
                alert('La date du rendez-vous doit être dans le futur');
            }
        });
    }
});