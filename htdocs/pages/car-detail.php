<?php
require "../includes/header.php";
require "../database/connection.php";

// Haal ID uit de URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<p>Geen auto opgegeven.</p>";
    require "../includes/footer.php";
    exit;
}

// Haal de auto op uit de database
$stmt = $conn->prepare("SELECT * FROM autos WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$auto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$auto) {
    echo "<p>Auto niet gevonden.</p>";
    require "../includes/footer.php";
    exit;
}

// Fallback afbeelding
$afbeelding = !empty($auto['afbeelding']) ? $auto['afbeelding'] : 'placeholder.svg';
?>

<main class="car-detail">
    <div class="grid">
        <div class="row">
            <div class="advertorial">
                <h2><?= htmlspecialchars($auto['merk']) ?> <?= htmlspecialchars($auto['type']) ?></h2>
                <p><?= htmlspecialchars($auto['beschrijving']) ?: 'Geen beschrijving beschikbaar.' ?></p>
                <img src="/assets/images/products/<?= htmlspecialchars($afbeelding) ?>" alt="Auto afbeelding">
                <img src="/assets/images/header-circle-background.svg" alt="" class="background-header-element">
            </div>
        </div>

        <div class="row white-background">
            <h2><?= htmlspecialchars($auto['merk']) ?> <?= htmlspecialchars($auto['type']) ?></h2>
            <div class="rating">
                <span class="stars stars-4"></span>
                <span>440+ reviewers</span>
            </div>
            <div class="car-type">
                <div class="grid">
                    <div class="row"><span class="accent-color">Type</span><span><?= htmlspecialchars($auto['type']) ?></span></div>
                    <div class="row"><span class="accent-color">Personen</span><span><?= htmlspecialchars($auto['personen']) ?></span></div>
                </div>
                <div class="grid">
                    <div class="row"><span class="accent-color">Transmissie</span><span><?= htmlspecialchars($auto['transmissie']) ?></span></div>
                    <div class="row"><span class="accent-color">Tankinhoud</span><span><?= htmlspecialchars($auto['tankinhoud']) ?>L</span></div>
                </div>
                <div class="call-to-action">
                    <div class="row"><span class="font-weight-bold">€<?= number_format($auto['prijs_per_dag'], 2, ',', '.') ?></span> / dag</div>
                    <div class="row"><a href="/huur-form" class="button-primary">Huur nu</a></div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require "../includes/footer.php" ?>
