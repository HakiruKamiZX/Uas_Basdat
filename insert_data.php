<?php
$servername = "localhost";
$username = "root"; 
$password = "";     
$dbname = "datamahasiswa"; 
$nimError = "";
$uktError = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"]; 
    $nim = $_POST["nim"];
    $alamat = $_POST["alamat"];
    $prodi = $_POST["prodi"];
    $ukt = $_POST["ukt"];
    
    $valid = true;
    
    if (!preg_match('/^\d{10}$/', $nim)) {
        $nimError = "NIM must be exactly 10 digits.";
        $valid = false;
    }

    if (!preg_match('/^\d{6,8}$/', $ukt)) {
        $uktError = "UKT must be between 6 and 8    .";
        $valid = false;
    }

    if ($valid) {
        $sqlCheckNIM = "SELECT * FROM students WHERE nim = '$nim'";
        $result = $conn->query($sqlCheckNIM);

        if ($result->num_rows > 0) {
            $nimError = "NIM sudah terdaftar";
            $valid = false;
        }
    }

    if ($valid) {
        $sql = "INSERT INTO students (nama, nim, alamat, prodi, ukt) 
                VALUES ('$nama', '$nim', '$alamat', '$prodi', '$ukt')";

        if ($conn->query($sql) === TRUE) {
            header("Location: display_data.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('NIM: $nimError \\nUKT: $uktError');</script>";
    }
}

$conn->close();
?>
