window.addEventListener('resize', function () {
    var screenWidth = window.innerWidth;
    var screenHeight = window.innerHeight;

    // Envoyer les informations au serveur via une requête AJAX avec Axios
    axios.post('/update-screensize', { screenWidth: screenWidth, screenHeight: screenHeight })
        .then(function (response) {
            // Traitement en cas de succès
            console.log(response.data);
        })
        .catch(function (error) {
            // Traitement en cas d'erreur
            console.error(error);
        });
});
