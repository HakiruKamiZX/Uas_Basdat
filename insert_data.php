<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "datamahasiswa"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $alamat = $_POST["alamat"];
    $prodi = $_POST["prodi"];
    $ukt = $_POST["ukt"];

    $sql = "INSERT INTO students (nama, nim, alamat, prodi, ukt) 
            VALUES ('$nama', '$nim', '$alamat', '$prodi', '$ukt')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
