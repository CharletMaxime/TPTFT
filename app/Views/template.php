<html lang="fr">
<head>
    <title><?= $this->e($title) ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/TpWeb/TFT/2024-2025-R3-01-B1-CHARLET/public/css/style.css">
    <script src="/TpWeb/TFT/2024-2025-R3-01-B1-CHARLET/public/js/script.js"></script>
</head>

<body>
<header>
    <nav class="navbar">
        <!-- Liens à gauche -->
        <div class="nav-links left-navLinks">
            <ul>
                <li><a href="/TPweb/TFT/2024-2025-R3-01-B1-CHARLET/index.php">Accueil</a></li>
                <li><a href="?action=add-unit">Ajouter une unité</a></li>
            </ul>
        </div>

        <!-- Barre de recherche -->
        <div class="search-bar">
            <label for="search"></label>
            <input type="search" name="search" id="search" placeholder="Rechercher une unité..." onkeyup="searchBar()">
        </div>

        <!-- Liens à droite -->
        <div class="nav-links right-navLinks">
            <ul>
                <li><a href="?action=add-origin">Ajouter une origine</a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>

        <!-- Icone burger -->
        <img src="/TpWeb/TFT/2024-2025-R3-01-B1-CHARLET/public/img/burgermenu.png" alt="menu" class="menu-icon">
    </nav>
</header>
<script>
    init();
</script>

<!-- Contenu -->
<main id="contenu">
    <?= $this->section('content') ?>
</main>

<!-- bas de page -->
<footer>

</footer>
<!-- Pop-up Container -->
<div id="popup" class="popup-container">
    <div id="popup-content" class="popup-content">
        <!-- Les résultats seront insérés ici par JavaScript -->
    </div>
</div>
</body>
</html>