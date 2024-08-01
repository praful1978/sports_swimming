<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GFG User Details</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
            border-collapse: collapse;
        }

        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', 'sans-serif';
        }

        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }

        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        td {
            font-weight: lighter;
        }
    </style>
</head>

<body>
    <section>
        <h1>Details of Addmission</h1>
        <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>sr.no.</th>
                <th>uid number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile Number</th>
                <th>Registration Fee</th>
                <th>Payment Date</th>
                <th>Payment ID</th>
                <th>Batch Time</th>
                <th>Batch Fee</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
            include 'connection.php';

            // SQL query to select data from both registration and final_payment tables
            $sql = "
                SELECT 
                    registration.*, 
                    final_payment.*
                FROM 
                    registration
                INNER JOIN 
                    final_payment
                ON 
                    registration.uid = final_payment.uid
            ";

            // Execute the query
            $result = $conn->query($sql);

            // Check for query execution errors
            if (!$result) {
                die("Query failed: " . $conn->error);
            }

            // Fetch and process the results
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
                    <td><?php echo htmlspecialchars($row['sr_num']); ?></td>
                    <td><?php echo htmlspecialchars($row['uid']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobile_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['transaction_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['batch_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['batch_fee']); ?></td>
                </tr>
                <?php
            }

            // Close the connection
            $conn->close();
            ?>
        </table>
    </section>
</body>

</html>
