<?php
// Add session_start if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fix: Accept both 'user_id' and 'id' for session
if (!isset($_SESSION['user_id'])) {
    if (isset($_SESSION['id'])) {
        $_SESSION['user_id'] = $_SESSION['id'];
    } else {
        header('Location: /login-form');
        exit;
    }
}

require './includes/header.php';
require './database/connection.php';

$userId = $_SESSION['user_id'];


// Fetch user info (only email and role)
$query = $conn->prepare("SELECT email, role FROM account WHERE id = ?");
$query->execute([$userId]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $passwordChanged = false;

    if (!empty($_POST['password']) && trim($_POST['password']) !== '') {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE account SET email = ?, password = ? WHERE id = ?");
        $update->execute([$email, $password, $userId]);
        $passwordChanged = true;
    } else {
        $update = $conn->prepare("UPDATE account SET email = ? WHERE id = ?");
        $update->execute([$email, $userId]);
    }

    $redirectUrl = 'account-info.php?updated=true';
    if ($passwordChanged) {
        $redirectUrl .= '&pwchanged=1';
    }
    header('Location: ' . $redirectUrl);
    exit;
}
?>

<main>
    <div class="profile-container white-background" style="max-width: 500px; margin: 2em auto; box-shadow: 0 4px 16px rgba(0,0,0,0.07);">
        <h2 style="margin-bottom: 1.5em;">Mijn Profiel</h2>

        <?php if (isset($_GET['updated'])): ?>
            <p class="succes-message">✅ Profiel succesvol bijgewerkt!</p>
        <?php endif; ?>
        <?php if (isset($_GET['pwchanged'])): ?>
            <p class="succes-message">🔒 Wachtwoord succesvol gewijzigd!</p>
        <?php endif; ?>

        <form method="POST" class="account-form">
            <label for="email">E-mail</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="password">Nieuw wachtwoord <span style="color:#90A3BF;font-size:0.9em;">(optioneel)</span></label>
            <input type="password" name="password" placeholder="Laat leeg om niet te wijzigen">

            <input type="submit" value="Opslaan" class="button-primary" style="margin-top:1em;">
        </form>
    </div>
</main>

<?php require_once './includes/footer.php'; ?>
