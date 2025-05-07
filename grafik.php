<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "survey_db");

// Ambil data survei
$data = $conn->query("SELECT pilihan, COUNT(*) as jumlah FROM survei GROUP BY pilihan");

// Siapkan data untuk grafik
$labels = [];
$jumlah = [];
while($row = $data->fetch_assoc()) {
    $labels[] = $row['pilihan'];
    $jumlah[] = $row['jumlah'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grafik Survei</title>
    <style>
        body { font-family: Arial; text-align: center; margin-top: 50px; }
        canvas { max-width: 600px; margin: auto; }
    </style>
</head>
<body>
    <h2>Hasil Survei</h2>
    <canvas id="surveyChart"></canvas>

    <!-- Chart.js dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('surveyChart').getContext('2d');
        const surveyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($labels) ?>,
                datasets: [{
                    label: 'Jumlah Suara',
                    data: <?= json_encode($jumlah) ?>,
                    backgroundColor: ['#3498db', '#e74c3c', '#2ecc71', '#f1c40f', '#9b59b6']
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>
</body>
</html>
