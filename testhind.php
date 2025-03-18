<?php
// Define available city files
$city_files = [
    "Adelaide" => "csv/uv-adelaide-2023.csv",
    "Brisbane" => "csv/uv-brisbane-2023.csv",
    "Canberra" => "csv/v-canberra-2023.csv",
    "Darwin" => "csv/uv-darwin-2023.csv",
    "Gold Coast" => "csv/uv-gold-coast-2023.csv",
    "Melbourne" => "csv/uv-melbourne-2023.csv",
    "Newcastle" => "csv/uv-newcastle-2023.csv",
    "Perth" => "csv/uv-perth-2023.csv",
    "Sydney" => "csv/uv-sydney-2023.csv"
];

// Get selected city from the dropdown (default to Brisbane)
$selected_city = $_GET['city'] ?? "Brisbane";
$file_path = $city_files[$selected_city] ?? "uv-brisbane-2023.csv";

// Read CSV file
$data = [];
$dates = [];
$uv_values = [];
if (($handle = fopen($file_path, "r")) !== false) {
    $headers = fgetcsv($handle); // Read headers
    while (($row = fgetcsv($handle)) !== false) {
        $data[] = $row;
        $dates[] = $row[0]; // Assuming Date-Time is the first column
        $uv_values[] = $row[3]; // Assuming UV_Index is in the fourth column
    }
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>UV Index Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .uv-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        .uv-table th, .uv-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .uv-table th {
            background-color: #f4a261;
            color: white;
        }
        .uv-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <h1>UV Index Data for <?php echo $selected_city; ?></h1>

    <!-- City Dropdown -->
    <form method="GET">
        <label>Select City:</label>
        <select name="city" onchange="this.form.submit()">
            <?php foreach ($city_files as $city => $file) { ?>
                <option value="<?php echo $city; ?>" <?php if ($city == $selected_city) echo "selected"; ?>>
                    <?php echo $city; ?>
                </option>
            <?php } ?>
        </select>
    </form>

    <!-- UV Index Table -->
    <table class="uv-table">
        <tr>
            <?php foreach ($headers as $header) { echo "<th>$header</th>"; } ?>
        </tr>
        <?php foreach ($data as $row) { ?>
            <tr>
                <?php foreach ($row as $cell) { echo "<td>$cell</td>"; } ?>
            </tr>
        <?php } ?>
    </table>

    <!-- UV Index Trend Graph -->
    <h2>UV Index Trend Over Time</h2>
    <canvas id="uvChart"></canvas>

    <script>
        let ctx = document.getElementById('uvChart').getContext('2d');
        let uvChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'UV Index',
                    data: <?php echo json_encode($uv_values); ?>,
                    borderColor: 'orange',
                    backgroundColor: 'rgba(255, 165, 0, 0.2)',
                    borderWidth: 2,
                    fill: true
                }]
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
