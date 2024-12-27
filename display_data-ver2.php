<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datamahasiswa";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk menghitung median
function calculateMedian($data) {
    $count = count($data);
    $middle = floor($count / 2);

    if ($count % 2 == 0) {
        return ($data[$middle - 1] + $data[$middle]) / 2;
    } else {
        return $data[$middle];
    }
}

// Fungsi untuk menghitung lima serangkai
function calculateFiveSummary($data) {
    $count = count($data);
    $min = min($data);
    $max = max($data);
    $median = calculateMedian($data);
    $q1 = calculateMedian(array_slice($data, 0, floor($count / 2)));
    $q3 = calculateMedian(array_slice($data, ceil($count / 2)));

    return [
        "Minimum" => $min,
        "Q1" => $q1,
        "Median" => $median,
        "Q3" => $q3,
        "Maximum" => $max
    ];
}

// Fungsi untuk menghitung pencilan
function calculateOutliers($data) {
    $fiveSummary = calculateFiveSummary($data);
    $iqr = $fiveSummary["Q3"] - $fiveSummary["Q1"];
    $lowerBound = $fiveSummary["Q1"] - 1.5 * $iqr;
    $upperBound = $fiveSummary["Q3"] + 1.5 * $iqr;

    return array_filter($data, function ($value) use ($lowerBound, $upperBound) {
        return $value < $lowerBound || $value > $upperBound;
    });
}

// Fungsi untuk menghitung standar deviasi
function calculateStandardDeviation($data) {
    $mean = array_sum($data) / count($data);
    $sumSquaredDifferences = array_reduce($data, function ($carry, $item) use ($mean) {
        return $carry + pow($item - $mean, 2);
    }, 0);

    return sqrt($sumSquaredDifferences / count($data));
}

// Variabel untuk menyimpan hasil
$statisticsResult = "";
$data = [];

// Query untuk mengambil data UKT
$sql = "SELECT ukt FROM students WHERE ukt IS NOT NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = (float)$row['ukt'];
    }
    sort($data); // Urutkan data
}

// Proses tombol yang diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    if (!empty($data)) {
        switch ($action) {
            case "minimum":
                $statisticsResult = "Minimum: " . min($data);
                break;
            case "q1":
                $statisticsResult = "Kuartil Bawah (Q1): " . calculateFiveSummary($data)["Q1"];
                break;
            case "median":
                $statisticsResult = "Median: " . calculateFiveSummary($data)["Median"];
                break;
            case "q3":
                $statisticsResult = "Kuartil Atas (Q3): " . calculateFiveSummary($data)["Q3"];
                break;
            case "maximum":
                $statisticsResult = "Maksimum: " . max($data);
                break;
            case "outliers":
                $outliers = calculateOutliers($data);
                if (empty($outliers)) {
                    $statisticsResult = "Tidak ada pencilan.";
                } else {
                    $statisticsResult = "Pencilan: " . implode(", ", $outliers);
                }
                break;
            case "std_dev":
                $statisticsResult = "Standar Deviasi: " . calculateStandardDeviation($data);
                break;
        }
    } else {
        $statisticsResult = "Tidak ada data untuk dihitung.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik UKT Mahasiswa</title>
    <link rel="stylesheet" href="public/styles2.css">
</head>
<body>
    <h1>Data Mahasiswa FMIPA UNJ</h1>
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
            $sql = "SELECT * FROM students";
            $result = $conn->query($sql);
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
            ?>
        </tbody>
    </table>

    <h2 class="statistik">Statistik UKT</h2>
    <form method="post">
        <button type="submit" name="action" value="minimum">Minimum</button>
        <button type="submit" name="action" value="q1">Kuartil Bawah (Q1)</button>
        <button type="submit" name="action" value="median">Median</button>
        <button type="submit" name="action" value="q3">Kuartil Atas (Q3)</button>
        <button type="submit" name="action" value="maximum">Maksimum</button>
        <button type="submit" name="action" value="outliers">Pencilan</button>
        <button type="submit" name="action" value="std_dev">Standar Deviasi</button>
    </form>

    <h3 class="titlehasil">Hasil:</h3>
    <p class="hasil"><?php echo $statisticsResult; ?></p>

    <a href="index.html" class="back-link">
            <button class="back-btn">
                &larr; Go Back
            </button>
    </a>
</body>
</html>

</body>
</html>