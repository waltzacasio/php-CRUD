<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
        <head>  
                <title>View Records</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        <body>
                
                <h1>View Records</h1>
                
                <p><b>View All</b> | <a href="view-paginated.php">View Paginated</a> | <a href="records.php">Add New Record</a></p>
                
                <?php
                        // connect to the database
                        include('connect-db.php');
                        
                        // get the records from the database
                        if ($result = $mysqli->query("SELECT * FROM gpinoy ORDER BY lastName, firstName asc"))
                        {
                                // display records if there are records to display
                                if ($result->num_rows > 0)
                                {
                                        // display records in a table
                                        echo "<table border='1' cellpadding='10'>";
                                        
                                        // set table headers
                                        echo "<tr><th>Last Name</th><th>First Name</th><th>Address</th><th>Box Number</th><th>Remark</th><th>Date of Purchase</th><th>Contact</th><th>Installer</th><th></th><th></th></tr>";
                                        
                                        while ($row = $result->fetch_object())
                                        {
                                                // set up a row for each record
                                                echo "<tr>";
                                                echo "<td>" . $row->lastName . "</td>";
                                                echo "<td>" . $row->firstName . "</td>";
                                                echo "<td>" . $row->address . "</td>";
                                                echo "<td>" . $row->boxNumber . "</td>";
                                                echo "<td>" . $row->remark . "</td>";
                                                echo "<td>" . $row->date . "</td>";
                                                echo "<td>" . $row->contact . "</td>";
                                                echo "<td>" . $row->installer . "</td>";
                                                echo "<td><a href='records.php?id=" . $row->id . "'>Edit</a></td>";
                                                echo "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
                                                echo "</tr>";
                                        }
                                        
                                        echo "</table>";
                                }
                                // if there are no records in the database, display an alert message
                                else
                                {
                                        echo "No results to display!";
                                }
                        }
                        // show an error if there is an issue with the database query
                        else
                        {
                                echo "Error: " . $mysqli->error;
                        }
                        
                        // close database connection
                        $mysqli->close();
                
                ?>
                
        </body>
</html>