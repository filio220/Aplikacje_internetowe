<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły rekordu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="details-container">
        <?php if ($details): ?>
            <h3>Dane:</h3>
            <p>ID: <?php echo htmlspecialchars($details['id']); ?><br>
            Imię i nazwisko: 
            <?php 
                foreach ($details as $key => $value) {
                    if ($key == 'id') continue;
                    echo htmlspecialchars($value) . ' ';
                }
            ?></p>
        <?php else: ?>
            <p>Brak szczegółów do wyświetlenia.</p>
        <?php endif; ?>
    </div>
</body>
</html>
