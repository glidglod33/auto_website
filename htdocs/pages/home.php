<?php
require_once './database/connection.php';

// Zoekfunctionaliteit
$zoekterm = $_GET['zoek'] ?? '';

if (!empty($zoekterm)) {
    $stmt = $conn->prepare("SELECT * FROM autos WHERE merk LIKE :zoek OR type LIKE :zoek");
    $zoek = "%" . $zoekterm . "%";
    $stmt->bindParam(':zoek', $zoek);
    $stmt->execute();
    $populaire_autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $titel = "Zoekresultaten voor: " . htmlspecialchars($zoekterm);
} else {
    $stmt = $conn->prepare("SELECT * FROM autos ORDER BY id ASC LIMIT 8");
    $stmt->execute();
    $populaire_autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $titel = "Populaire auto's";
}

// Aanbevolen auto's
$stmt = $conn->prepare("SELECT * FROM autos ORDER BY RAND() LIMIT 4");
$stmt->execute();
$aanbevolen_autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require "./includes/header.php" ?>

<header>
    <div class="advertorials">
        <div class="advertorial">
            <h2>Hét platform om een auto te huren</h2>
            <p>Snel en eenvoudig een auto huren. Natuurlijk voor een lage prijs.</p>
            <a href="/huur-form" class="button-primary">Huur nu een auto</a>

            <img src="assets/images/car-rent-header-image-1.png" alt="">
            <img src="assets/images/header-circle-background.svg" alt="" class="background-header-element">
        </div>
        <div class="advertorial">
            <h2>Wij verhuren ook bedrijfswagens</h2>
            <p>Voor een vaste lage prijs met prettig voordelen.</p>
            <a href="/huur-form" class="button-primary">Huur een bedrijfswagen</a>
            <img src="assets/images/car-rent-header-image-2.png" alt="">
            <img src="assets/images/header-block-background.svg" alt="" class="background-header-element">
        </div>
    </div>
</header>

<main>
    <!-- Zoekresultaten of Populaire auto's -->
    <h2 class="section-title"><?= $titel ?></h2>
    <div class="cars">
        <?php if (empty($populaire_autos)): ?>
            <p>Geen auto's gevonden.</p>
        <?php else: ?>
            <?php foreach ($populaire_autos as $auto): ?>
                <?php $afbeelding = !empty($auto['afbeelding']) ? $auto['afbeelding'] : 'placeholder.svg'; ?>
                <div class="car-details">
                    <div class="car-brand">
                        <h3><?= htmlspecialchars($auto['merk']) ?></h3>
                        <div class="car-type"><?= htmlspecialchars($auto['type']) ?></div>
                    </div>
                    <img src="/assets/images/products/<?= htmlspecialchars($afbeelding) ?>" alt="Auto afbeelding">
                    <div class="car-specification">
                        <span><img src="assets/images/icons/gas-station.svg" alt=""><?= htmlspecialchars($auto['brandstof'] ?? $auto['tankinhoud']) ?></span>
                        <span><img src="assets/images/icons/car.svg" alt=""><?= htmlspecialchars($auto['transmissie']) ?></span>
                        <span><img src="assets/images/icons/profile-2user.svg" alt=""><?= htmlspecialchars($auto['personen'] ?? $auto['zitplaatsen']) ?> Personen</span>
                    </div>
                    <div class="rent-details">
                        <span><span class="font-weight-bold">€<?= number_format($auto['prijs_per_dag'], 2, ',', '.') ?></span> / dag</span>
                        <a href="pages/car-detail.php?id=<?= $auto['id'] ?>" class="button-primary">Bekijk nu</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if (empty($zoekterm)): ?>
        <div class="show-more">
            <a class="button-primary" href="pages/ons-aanbod.php">Toon alle</a>
        </div>
    <?php endif; ?>
</main>

<?php if (empty($zoekterm)): ?>
<main>
    <!-- Aanbevolen auto's -->
    <h2 class="section-title">Aanbevolen auto's</h2>
    <div class="cars">
        <?php foreach ($aanbevolen_autos as $auto): ?>
            <?php $afbeelding = !empty($auto['afbeelding']) ? $auto['afbeelding'] : 'placeholder.svg'; ?>
            <div class="car-details">
                <div class="car-brand">
                    <h3><?= htmlspecialchars($auto['merk']) ?></h3>
                    <div class="car-type"><?= htmlspecialchars($auto['type']) ?></div>
                </div>
                <img src="/assets/images/products/<?= htmlspecialchars($afbeelding) ?>" alt="Auto afbeelding">
                <div class="car-specification">
                    <span><img src="/assets/images/icons/gas-station.svg" alt=""><?= htmlspecialchars($auto['brandstof']) ?></span>
                    <span><img src="/assets/images/icons/car.svg" alt=""><?= htmlspecialchars($auto['transmissie']) ?></span>
                    <span><img src="/assets/images/icons/profile-2user.svg" alt=""><?= htmlspecialchars($auto['personen']) ?> Personen</span>
                </div>
                <div class="rent-details">
                    <span><span class="font-weight-bold">€<?= number_format($auto['prijs_per_dag'], 2, ',', '.') ?></span> / dag</span>
                    <a href="pages/car-detail.php?id=<?= $auto['id'] ?>" class="button-primary">Bekijk nu</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php endif; ?>

<?php require "includes/footer.php" ?>
