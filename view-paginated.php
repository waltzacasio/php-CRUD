<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
        <head>  
                <title>View Records</title>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        </head>
        <body>
                
                <h1>View Records</h1>
                
                <?php
                        // connect to the database
                        include('connect-db.php');
						include('search.php');
                        
                        // number of results to show per page
				        $per_page = 20;
				        
				        // figure out the total pages in the database
				        if ($result = $mysqli->query("SELECT * FROM gpinoy ORDER BY lastName, firstName asc"))
				        {
				        	if ($result->num_rows != 0)
				        	{
				        		$total_results = $result->num_rows;
				        		// ceil() returns the next highest integer value by rounding up value if necessary
					        	$total_pages = ceil($total_results / $per_page);
					        	
		        				// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
						        if (isset($_GET['page']) && is_numeric($_GET['page']))
						        {
						                $show_page = (int) $_GET['page'];
						                
						                // make sure the $show_page value is valid
						                if ($show_page > 0 && $show_page <= $total_pages)
						                {
						                        $start = ($show_page -1) * $per_page; 
						                        $end = $start + $per_page;  
						                }
						                else
						                {
						                        // error - show first set of results, ***this is records 0-2 (zero based) or records 1-3
						                        $start = 0;
						                        $end = $per_page; 
												$show_page = 1;
												
						                }               
						        }
						        else
						        {
						                // if page isn't set, show first set of results
						                $start = 0;
						                $end = $per_page; 
										$show_page = 1;
									
						        }
						        
								/*
						        // display pagination
						        echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";
						        
								
								for ($i = 1; $i <= $total_pages; $i++)
						        {
						        	if (isset($_GET['page']) && $_GET['page'] == $i)
						        	{
						        		echo $i . " ";
						        	}
						        	else
						        	{
						        		echo "<a href='view-paginated.php?page=$i'> $i </a> ";
						        	}
						        }
								*/
								
								echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";

								$range = 5;

								
								if ($show_page > 1) {
									// show << link to go back to page 1
									echo " <a href='{$_SERVER['PHP_SELF']}?show_page=1'>First Page</a> "  . "|";
								} // end if

							for ($x = ($show_page - $range); $x < ($show_page + $range); $x++) {
									// if it's a valid page number...
									if (($x > 0) && ($x <= $total_pages)) {
									// if we're on current page...
									if ($x == $show_page) {
										// 'highlight' it but don't make a link
										echo " [<b>$x</b>] ";
									// if not current page...
									} else {
										// make it a link
										echo " <a href='{$_SERVER['PHP_SELF']}?page=$x'>$x</a> ";
									} // end else
									} // end if 
								} // end for

								// if not on last page, show forward and last page links        
								if ($show_page != $total_pages) {
									// get next page 
									$nextpage = $show_page + 1;
									// echo forward link for next page 
									//echo " <a href='{$_SERVER['PHP_SELF']}?show_page=$nextpage'>Next</a> " . "|";
									// echo forward link for lastpage
									echo "|" . " <a href='{$_SERVER['PHP_SELF']}?page=$total_pages'>Last Page</a> ";
								} // end if
								/****** end build pagination links ******/


								/******  build the pagination links ******/
								// if not on page 1, don't show back links
								
								/*
								if ($page > 1) {
									// show << link to go back to page 1
									echo " <a href='{$_SERVER['PHP_SELF']}?show_page=1'>First Page</a> "  . "|";
									// get previous page num
									$prevpage = $page - 1;
									// show < link to go back to 1 page
									//echo " <b><a href='{$_SERVER['PHP_SELF']}?show_page=$prevpage'>Previous Page</a></b> ";
								} // end if

								// loop to show links to range of pages around current page
								$range = 5;
								
								for ($x = ($page - $range); $x < (($page + $range)  + 1); $x++) {
									// if it's a valid page number...
									if (($x > 0) && ($x <= $total_pages)) {
									// if we're on current page...
									if ($x == $page) {
										// 'highlight' it but don't make a link
										echo " [<b>$x</b>] ";
									// if not current page...
									} else {
										// make it a link
										echo " <a href='{$_SERVER['PHP_SELF']}?pagee=$x'>$x</a> ";
									} // end else
									} // end if 
								} // end for

								// if not on last page, show forward and last page links        
								if ($page != $total_pages) {
									// get next page
									$nextpage = $page + 1;
									// echo forward link for next page 
									//echo " <a href='{$_SERVER['PHP_SELF']}?show_page=$nextpage'>Next</a> " . "|";
									// echo forward link for lastpage
									echo "|" . " <a href='{$_SERVER['PHP_SELF']}?pagee=$total_pages'>Last Page</a> ";
								} // end if
								/****** end build pagination links ******/




						        echo "</p>";
						        
						        // display data in table
						        echo "<table border='1' cellpadding='10'>";
						        echo "<tr> <th>Last Name</th><th>First Name</th><th>Address</th><th>Box Number</th><th>Remark</th><th>Date of Purchase</th><th>Contact</th><th>Installer</th><th></th><th></th> </tr>";
						
						        // loop through results of database query, displaying them in the table 
						        for ($i = $start; $i < $end; $i++)
						        {
						        	// make sure that PHP doesn't try to show results that don't exist
					                if ($i == $total_results) { break; }
					                
						        	// find specific row
						        	$result->data_seek($i);
   	 								$row = $result->fetch_row();
   	 								
   	 								// echo out the contents of each row into a table
					                echo "<tr>";
					                echo '<td>' . $row[1] . '</td>';
					                echo '<td>' . $row[2] . '</td>';
					                echo '<td>' . $row[3] . '</td>';
									echo '<td>' . $row[4] . '</td>';
									echo '<td>' . $row[5] . '</td>';
									echo '<td>' . $row[6] . '</td>';
									echo '<td>' . $row[7] . '</td>';
									echo '<td>' . $row[8] . '</td>';
					                echo '<td><a href="edit.php?id=' . $row[0] . '">Edit</a></td>';
					                echo '<td><a href="delete.php?id=' . $row[0] . '">Delete</a></td>';
					                echo "</tr>";
						        }

						        // close table>
						        echo "</table>";
				        	}
				        	else
				        	{
				        		echo "No results to display!";
				        	} 
				        }
				        // error with the query
				        else
				        {
				        	echo "Error: " . $mysqli->error;
				        }
                                                
                        // close database connection
                        $mysqli->close();
                
                ?>
                
                <a href="records.php">Add New Record</a>
        </body>
</html>

