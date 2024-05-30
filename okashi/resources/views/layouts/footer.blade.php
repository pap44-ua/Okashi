<!-- resources/views/layouts/footer.blade.php -->
<footer class="custom-footer py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center"> <!-- Añadido text-center -->
                <h1><b>Okashi</b></h1>
                <p><i>Disfruta de japón desde casa</i></p>
            </div>
            <div class="col-md-6 text-center"> <!-- Cambiado text-md-end a text-center -->
                <h5><b>Contacto</b></h5>
                <p>Email: okashistore23@gmail.com</p>
                <div class="social-icons mt-3">
                    <a href="https://x.com/OkashiStore23" target="_blank">
                        <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a href="https://www.instagram.com/okashi" target="_blank">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <small class="d-block mt-3">&copy; 2024 Okashi. Todos los derechos reservados.</small>
        </div>
    </div>
</footer>

<!-- Asegúrate de incluir Font Awesome en tu proyecto -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Añade el siguiente CSS en tu archivo de estilos -->
<style>
    .social-icons a {
        color: white; /* Color blanco para los iconos */
        margin: 0 10px; /* Espaciado entre los iconos */
        text-decoration: none; /* Sin subrayado */
    }
    .social-icons a:hover {
        color: #cccccc; /* Color más claro al pasar el cursor */
    }
</style>
