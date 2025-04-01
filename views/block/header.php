<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title><?= $title ?? "Assurance Auto" ?></title>

    <style>
        /* Style général de la navbar */
        .navbar {
            background: rgba(0, 0, 0, 0.85); /* Transparence pour effet premium */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Logo avec effet au survol */
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.1);
        }

        /* Style des liens */
        .nav-link {
            font-size: 1.1rem;
            margin-left: 15px;
            transition: color 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: #f8c400 !important; /* Couleur dorée premium */
        }

        /* Bouton personnalisé pour Connexion et Déconnexion */
        .btn-custom {
            background: #f8c400;
            color: #000;
            border-radius: 25px;
            padding: 8px 16px;
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background: #ffd700;
            color: #000;
        }

        /* Pour mobile : espacement des liens */
        @media (max-width: 991px) {
            .nav-item {
                text-align: center;
                padding: 10px 0;
            }
        }
    </style>
</head>

<body>

<nav class="mb-5 navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand text-light" href="index.php">Assurance Auto</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-light" href="index.php">Accueil</a>
                </li>

                <?php
                if (!isset($_SESSION)) {
                    session_start();
                }

                if (!isset($_SESSION["username"])) { ?>
                    <li class="nav-item">
                        <a class="btn btn-custom" href="login.php">Connexion</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="admin.php">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-custom" href="logout.php">Déconnexion</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF27qF4aYx5V4u5R1RYWlT9IEh5zzx0U5z7U5e5v5I5t9UJ0Z" crossorigin="anonymous"></script>
</body>

</html>
