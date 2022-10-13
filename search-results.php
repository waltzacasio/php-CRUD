<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>
<body>
    
<?php
                        // connect to the database
						include('search.php');

                        if ($result_count > 0) {

                        echo "<table border='1' cellpadding='10'>";
						        echo "<tr> <th>Last Name</th><th>First Name</th><th>Address</th><th>Box Number</th><th>Remark</th><th>Date of Purchase</th><th>Contact</th><th>Installer"; /*</th><th></th><th></th> </tr>";*/

                                while ($row = mysqli_fetch_assoc($query)){



   	 								
   	 								// echo out the contents of each row into a table
					                echo "<tr>";
					                echo '<td>' . $row['lastName'] . '</td>';
					                echo '<td>' . $row['firstName'] . '</td>';
					                echo '<td>' . $row['address'] . '</td>';
									echo '<td>' . $row['boxNumber'] . '</td>';
									echo '<td>' . $row['remark'] . '</td>';
									echo '<td>' . $row['date'] . '</td>';
									echo '<td>' . $row['contact'] . '</td>';
									echo '<td>' . $row['installer'] . '</td>';
					                /*echo '<td><a href="edit.php?id=' . $row[0] . '">Edit</a></td>';
					                echo '<td><a href="delete.php?id=' . $row[0] . '">Delete</a></td>';*/
					                echo "</tr>";
                                }


						        // close table>
						        echo "</table>";

                            }
                            else
                                echo 'There were no results for your search. Try searching for something else.';



?>


</body>
</html>