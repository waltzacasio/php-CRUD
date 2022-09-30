<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>

    <!-- create the search engine form -->
    <form method="GET">
        <input type ="text" name="k" value="<?php echo isset($_GET['k']) ? $_GET['k'] : ''; ?>" placeholder="Enter your search keywords" />
        <input type="submit" value="Search" />
    </form>

<?php
// get the search terms from the url

$k = isset($_GET['k']) ? $_GET['k'] : '';

// create the base variables for building the search query
$search_string = "SELECT * FROM gpinoy WHERE ";
$display_words = "";

//format each of search keywords into the db query to be run
$keywords = explode(' ', $k);
foreach ($keywords as $word) {
    $search_string .= "lastName LIKE '%" . $word . "%' OR ";
    $display_words .= $word . ' ';
}
$search_string = substr($search_string, 0, strlen($search_string)-4);
$display_words = substr($display_words, 0, strlen($display_words) -1);

//connect to the database
include('connect-db.php');

//run the query in the db and search through each of the records returned
$query = mysqli_query($mysqli, $search_string);
$result_count = mysqli_num_rows($query);

//display a message to the user to display the keywords
echo '<b><u>' . number_format($result_count) . '</u></b> results found';
echo 'Your search for <i>' . $display_words . '</i><hr/>';

echo $search_string;

//CONCAT_WS('|',`lastName`,`firstName`,`address`,`boxNumber`,`remark`,`date`,`contact`,`installer`)
?>


</body>
</html>


