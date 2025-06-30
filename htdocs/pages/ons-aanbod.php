<?php require "../includes/header.php"; ?>
<?php require "../database/connection.php"; ?>

<main style="max-width: 1200px; margin: auto; padding: 2rem;">
    <h2 style="font-size: 2rem; margin-bottom: 1.5rem;">Ons aanbod</h2>

    <!-- Filterformulier -->
    <form method="GET" style="margin-bottom: 2rem;">
        <label for="categorie">Filter op categorie:</label>
        <select name="categorie" id="categorie" onchange="this.form.submit()">
            <option value="">-- Alle categorieën --</option>
            <option value="SUV" <?= (isset($_GET['categorie']) && $_GET['categorie'] === 'SUV') ? 'selected' : '' ?>>SUV</option>
            <option value="Sedan" <?= (isset($_GET['categorie']) && $_GET['categorie'] === 'Sedan') ? 'selected' : '' ?>>Sedan</option>
            <option value="Hatchback" <?= (isset($_GET['categorie']) && $_GET['categorie'] === 'Hatchback') ? 'selected' : '' ?>>Hatchback</option>
        </select>
    </form>

    <?php
    $categorie = $_GET['categorie'] ?? '';

    if ($categorie) {
        $stmt = $conn->prepare("SELECT * FROM autos WHERE categorie = :categorie");
        $stmt->bindParam(':categorie', $categorie);
    } else {
        $stmt = $conn->prepare("SELECT * FROM autos");
    }

    $stmt->execute();
    $autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="cars" style="display: flex; flex-wrap: wrap; gap: 2rem;">
        <?php if ($autos): ?>
            <?php foreach ($autos as $auto): ?>
                <div class="car-details" style="border: 1px solid #eee; padding: 1rem; border-radius: 8px; width: calc(33.333% - 1.3rem); box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    <h3><?= htmlspecialchars($auto['merk']) ?> - <?= htmlspecialchars($auto['type']) ?></h3>
                    <?php
                    $afbeelding = !empty($auto['afbeelding']) ? $auto['afbeelding'] : 'placeholder.svg';
                    ?>
                    <img src="/assets/images/products/<?= htmlspecialchars($afbeelding) ?>" alt="Auto" style="width: 100%; height: auto; margin-bottom: 1rem;">
                    <p>Brandstof: <?= htmlspecialchars($auto['brandstof']) ?></p>
                    <p>Transmissie: <?= htmlspecialchars($auto['transmissie']) ?></p>
                    <p>Zitplaatsen: <?= htmlspecialchars($auto['personen']) ?></p>
                    <p>Prijs per dag: <strong>€<?= number_format($auto['prijs_per_dag'], 2, ',', '.') ?></strong></p>
                    <a href="/pages/car-detail.php?id=<?= $auto['id'] ?>" class="button-primary">Bekijk nu</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Geen auto's gevonden in deze categorie.</p>
        <?php endif; ?>
    </div>
</main>

<?php require "../includes/footer.php"; ?>
