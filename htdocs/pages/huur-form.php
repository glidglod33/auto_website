<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Auto Huurformulier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fa;
            padding: 40px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin: 15px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            background: #4169e1;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #3451b2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Auto Huren</h2>
        <form action="/bedankt" method="POST">
            <label for="naam">Naam</label>
            <input type="text" id="naam" name="naam" required>

            <label for="email">E-mailadres</label>
            <input type="email" id="email" name="email" required>

            <label for="telefoon">Telefoonnummer</label>
            <input type="tel" id="telefoon" name="telefoon" required>

            <label for="auto">Auto</label>
            <select id="auto" name="auto">
                <option value="BMW 3 Serie">BMW 3 Serie</option>
                <option value="Mercedes E-Klasse">Mercedes E-Klasse</option>
                <option value="Koenigseg Jesko">Koenigseg Jesko</option>
                <option value="AUDI A4">AUDI A4</option>
                <!-- Voeg hier andere auto's toe indien nodig -->
            </select>

            <label for="startdatum">Startdatum</label>
            <input type="date" id="startdatum" name="startdatum" required>

            <label for="einddatum">Einddatum</label>
            <input type="date" id="einddatum" name="einddatum" required>

            <button type="submit">Bevestig Huur</button>
        </form>
    </div>
</body>
</html>
