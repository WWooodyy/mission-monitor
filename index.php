<?php
$missions = include 'data.php';

define('HEALTH_OK',         0b1);
define('HEALTH_LOW_BATT',   0b10);
define('HEALTH_COMM_FAULT', 0b100);

function interpretHealth($flags) {
    $statuses = [];
    if ($flags & HEALTH_OK)         $statuses[] = "OK";
    if ($flags & HEALTH_LOW_BATT)   $statuses[] = "Low Battery";
    if ($flags & HEALTH_COMM_FAULT) $statuses[] = "Coms Fault";

    return implode(', ', $statuses) ?: "❓ Unknown";
}

function composeHealthFlag($statuses) {
    $flag = 0;

    foreach ($statuses as $status) {
        switch (strtolower(trim($status))) {
            case 'ok':
                $flag |= HEALTH_OK;
                break;
            case 'low battery':
                $flag |= HEALTH_LOW_BATT;
                break;
            case 'coms fault':
                $flag |= HEALTH_COMM_FAULT;
                break;
        }
    }

    return $flag;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Satellite Mission Monitor</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Satellite Mission Monitor</h1>

        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Name</th>
                <th>Altitude (km)</th>
                <th>Battery (%)</th>
                <th>Velocity (km/s)</th>
                <th>Status</th>
            </tr>
            <?php foreach ($missions as $mission): ?>
                <tr>
                    <td><?= htmlspecialchars($mission['name']) ?></td>
                    <td><?= $mission['altitude'] ?></td>
                    <td><?= $mission['battery'] ?>%</td>
                    <td><?= $mission['velocity'] ?></td>
                    <td><?= interpretHealth($mission['health']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <hr>
        <h2>Health Flag Generator</h2>
        <form method="post">
            <label><input type="checkbox" name="statuses[]" value="ok"> OK</label><br>
            <label><input type="checkbox" name="statuses[]" value="low battery"> Low Battery</label><br>
            <label><input type="checkbox" name="statuses[]" value="coms fault"> Coms Fault</label><br><br>
            
            <button type="submit">Generate Health Flag</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['statuses'])):
            $statuses = $_POST['statuses'];
            $flag = composeHealthFlag($statuses);
        ?>
            <h3>Generated Health Flag</h3>
            <div style="margin-top: 1em; padding: 1em; background: #f0f0f0; border: 1px solid #ccc;">
                <p><strong>Bitwise Flag:</strong> <?= $flag ?></p>
                <p><strong>Binary:</strong> <?= sprintf("0b%04b", $flag) ?></p>
                <p><strong>Interpreted:</strong> <?= interpretHealth($flag) ?></p>
            </div>
        <?php endif; ?>
    </body>
</html>