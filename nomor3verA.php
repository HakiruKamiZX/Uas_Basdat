<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "datamahasiswa"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL DeviasiStandarManual();"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standard Deviation Calculation</title>
    <link rel="stylesheet" href="public/styles.css">
</head>
<body>
    <div class="statistics-container">
        <h1>Standar Deviasi</h1>

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Statistic</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>Standard Deviation (Manual)</td>
                                <td>" . round($row['standard_deviation'], 7) . "</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php elseif ($result && $result->num_rows == 0): ?>
            <p>No statistics available.</p>
        <?php endif; ?>
    </div>

    <a href="display_data.php" class="back-link">
        <button class="back-btn">
            &larr; Go Back
        </button>
    </a>
</body>
</html>

<?php
$conn->close();
?>
