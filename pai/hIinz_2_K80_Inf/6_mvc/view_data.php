<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz danych</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Dane</th>
            <th>Akcje</th>
        </tr>
        <?php foreach ($data as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['firstName']); ?></td>
            <td>
                <form action="index.php?action=details&id=<?php echo $row['id']; ?>" method="post">
                    <input type="submit" value="Szczegóły" />
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
