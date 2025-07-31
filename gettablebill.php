<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/html');

include_once('../core/initialize1.php');

$result = $post->read();

if ($result) {
    $num = $result->num_rows;

    if ($num > 0) {
        // Start HTML table
        echo "<table border='1'>";
        echo "<tr>
                <th>ID</th>
                <th>From Location</th>
                <th>To Location</th>
                <th>Consignee</th>
                <th>Consigner</th>
                <th>No of Pieces</th>
                <th>Weight</th>
                <th>Rate</th>
                <th>Total Bill</th>
                <th>Status</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            extract($row);
            echo "<tr>
                    <td>{$id}</td>
                    <td>{$from_location}</td>
                    <td>{$to_location}</td>
                    <td>{$consignee}</td>
                    <td>{$consigner}</td>
                    <td>{$no_of_pieces}</td>
                    <td>{$weight}</td>
                    <td>{$rate}</td>
                    <td>{$total_bill}</td>
                    <td>{$status}</td>
                  </tr>";
        }

        // End HTML table
        echo "</table>";
    } else {
        echo "<p>No Bills found</p>";
    }
} else {
    echo "<p>Error executing query</p>";
}
?>
