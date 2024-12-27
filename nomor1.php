<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "datamahasiswa"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL CalculateStatistics();";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik 5 Serangkai</title>
    <link rel="stylesheet" href="public/styles.css">
</head>
<body>
    <div class="statistics-container">
        <h1>Hasil Statistik</h1>
        
        <?php if ($result->num_rows > 0) : ?>
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
                                <td>Minimum</td>
                                <td>" . $row['Minimum'] . "</td>
                              </tr>
                              <tr>
                                <td>Maximum</td>
                                <td>" . $row['Maximum'] . "</td>
                              </tr>
                              <tr>
                                <td>Q1</td>
                                <td>" . $row['Q1'] . "</td>
                              </tr>
                              <tr>
                                <td>Median</td>
                                <td>" . $row['Median'] . "</td>
                              </tr>
                              <tr>
                                <td>Q3</td>
                                <td>" . $row['Q3'] . "</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
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
