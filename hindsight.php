<?php
// Read CSV file and process data
$cancer_data = [];
$file = fopen("csv/cancer_data.csv", "r");

// Skip the first row if it contains headers
$headers = fgetcsv($file);

while (($row = fgetcsv($file)) !== false) {
    $year = $row[2];  // Assuming Year is in the 3rd column (0-based index 2)
    $sex = $row[3];    // Assuming Sex is in the 4th column (index 3)
    $count = (int)$row[6]; // Assuming Count is in the 7th column (index 6)

    if (!isset($cancer_data[$year])) {
        $cancer_data[$year] = ["Male" => 0, "Female" => 0];
    }
    
    if ($sex == "Males") {
        $cancer_data[$year]["Male"] += $count;
    } elseif ($sex == "Females") {
        $cancer_data[$year]["Female"] += $count;
    }
}
fclose($file);

// Convert data to JSON for Chart.js
$years = array_keys($cancer_data);
$male_cases = array_column($cancer_data, "Male");
$female_cases = array_column($cancer_data, "Female");
$chart_data = json_encode(["years" => $years, "male" => $male_cases, "female" => $female_cases]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Yearly Cancer Cases Trend</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    
    <h1>Yearly Cancer Cases Trend (Males vs Females)</h1>
    
    <canvas id="cancerTrendChart"></canvas>

    <script>
        let chartData = <?php echo $chart_data; ?>;
        
        let ctx = document.getElementById('cancerTrendChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.years,
                datasets: [
                    {
                        label: 'Male Cases',
                        data: chartData.male,
                        borderColor: 'blue',
                        backgroundColor: 'rgba(0, 0, 255, 0.2)',
                        borderWidth: 2,
                        fill: true
                    },
                    {
                        label: 'Female Cases',
                        data: chartData.female,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        borderWidth: 2,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

</body>
</html>