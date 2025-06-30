<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Rydr - Snel en eenvoudig een auto huren in Nederland. Bekijk ons aanbod en huur direct online.">
    <meta name="robots" content="index, follow">
    <title>Rydr</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="icon" type="image/png" href="../assets/images/favicon.ico" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>
<body>
<div class="topbar">
    <div class="logo">
        <a href="/">
            Rydr.
        </a>
    </div>
    <form action="/home" method="get">
        <input type="search" name="zoek" placeholder="Welke auto wilt u huren?" value="<?= htmlspecialchars($_GET['zoek'] ?? '') ?>">
        <img src="../assets/images/icons/search-normal.svg" alt="" class="search-icon">
    </form>

    <nav class="main-nav">
        <ul>
            <li><a href="/" class="nav-link<?= ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/home') ? ' active' : '' ?>">Home</a></li>
            <li><a href="/pages/ons-aanbod.php" class="nav-link<?= (strpos($_SERVER['REQUEST_URI'], 'ons-aanbod') !== false) ? ' active' : '' ?>">Ons aanbod</a></li>
            <li><a href="#" id="openHelpModal" class="nav-link">Hulp nodig?</a></li>
        </ul>
    </nav>
    <div class="menu">
        <?php if(isset($_SESSION['id']) || isset($_SESSION['user_id'])){ ?>
        <div class="account">
            <img src="../assets/images/profil.png" alt="">
            <div class="account-dropdown">
                <ul>
                    <li><img src="../assets/images/icons/setting.svg" alt="">
                        <a href="/account-info">Naar account</a>
                    </li>
                    <li><img src="../assets/images/icons/logout.svg" alt=""><a href="/logout">Uitloggen</a></li>
                </ul>
            </div>
        </div>
        <?php }else{ ?>
            <button type="button" class="button-primary" id="openLoginModal">Start met huren</button>
        <?php } ?>

    </div>
</div>
<div class="content">
<!-- Content here -->

<!-- Help Modal -->
<div id="helpModal" class="modal hidden">
    <div class="modal-content">
        <h2>Hulp nodig?</h2>
        <form id="helpForm" method="post" action="/help-request" style="display: flex; flex-direction: column; gap: 1em;">
            <label for="help-email">E-mail</label>
            <input type="email" id="help-email" name="email" required>
            <label for="help-message">Uw vraag</label>
            <textarea id="help-message" name="message" rows="4" required></textarea>
            <button type="submit" class="button-primary">Verstuur</button>
        </form>
        <button class="modal-close" type="button">&times;</button>
    </div>
</div>

<script>
    // Modal functionaliteit
    const openHelpModal = document.getElementById('openHelpModal');
    const helpModal = document.getElementById('helpModal');
    const closeHelpModal = document.querySelector('.modal-close');

    openHelpModal.addEventListener('click', () => {
        helpModal.classList.remove('hidden');
    });

    closeHelpModal.addEventListener('click', () => {
        helpModal.classList.add('hidden');
    });

    window.addEventListener('click', (event) => {
        if (event.target === helpModal) {
            helpModal.classList.add('hidden');
        }
    });
</script>
</body>
</html>
