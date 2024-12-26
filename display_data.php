<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "datamahasiswa"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa FMIPA UNJ</title>
    <link rel="stylesheet" href="public/styles.css">
</head>
<body>
        <h1>Data Mahasiswa</h1>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Alamat</th>
                    <th>Prodi</th>
                    <th>UKT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Make sure this PHP code generates rows dynamically
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["nama"] . "</td>
                                <td>" . $row["nim"] . "</td>
                                <td>" . $row["alamat"] . "</td>
                                <td>" . $row["prodi"] . "</td>
                                <td>" . $row["ukt"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No data found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <a href="index.html" class="back-link">
            <button class="back-btn">
                &larr; Go Back
            </button>
        </a>

</body>
</html>
