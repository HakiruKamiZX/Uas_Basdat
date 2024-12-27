<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "datamahasiswa"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    <!-- <div id="container"> -->
        <h1>Data Mahasiswa</h1>
        <div id="container-btn">
        <a href="nomor1.php">
            <button type="button" class="submit-btn">Calculate Statistics</button>
        </a>
        <a href="nomor3verA.php">
            <button type="button" class="submit-btn">Calculate Statistics</button>
        </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Alamat</th>
                    <th>Prodi</th>
                    <th>UKT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
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
    <!-- </div> -->


        <a href="index.html" class="back-link">
            <button class="back-btn">
                &larr; Go Back
            </button>
        </a>

</body>
</html>
