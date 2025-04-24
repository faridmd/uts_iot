<?php include "db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Suhu & Kelembapan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>📊 Data Sensor DHT11</h1>

    <!-- fetch data terbaru -->
    <div class="latest-box">
      <h2>Data Terbaru</h2>
      <?php
        $latest = $conn->query("SELECT * FROM dht11 ORDER BY id DESC LIMIT 1");
        if ($latest->num_rows > 0) {
          $row = $latest->fetch_assoc();
          echo "<p><strong>Datetime:</strong> " . $row["datetime"] . "</p>";
          echo "<p><strong>Suhu:</strong> " . $row["temperature"] . " °C</p>";
          echo "<p><strong>Kelembapan:</strong> " . $row["humidity"] . " %</p>";
        } else {
          echo "<p>Belum ada data</p>";
        }
      ?>
    </div>

    <!-- toggle riwayat -->
    <button class="btn" onclick="toggleTable()">Tampilkan Riwayat</button>

    <!-- tabel riwayat -->
    <div id="table-section">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Waktu</th>
            <th>Suhu (°C)</th>
            <th>Kelembapan (%)</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM dht11 ORDER BY id DESC LIMIT 10";
          $result = $conn->query($sql);
          $no = 1;

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>".$no++."</td>
                      <td>".$row["datetime"]."</td>
                      <td>".$row["temperature"]."</td>
                      <td>".$row["humidity"]."</td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='4'>Belum ada data</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function toggleTable() {
      const tableSection = document.getElementById("table-section");
      tableSection.style.display = tableSection.style.display === "none" ? "block" : "none";
    }
  </script>
</body>
</html>
