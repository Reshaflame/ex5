<?php 
    require_once "config.php";
    $connect = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
   
    if($connect->connect_errno) {
        exit("Failed to connect to DB: " . $connect->connect_error . " (" . $connect->connect_errno . ")");
    }
?>

<?php 
    $sql    = "SELECT * FROM tbl_94_books ORDER BY name";
    $data = $connect->query($sql);
    if(!$data) {
        exit("Query execution failed.");
    }
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/style.css">
<script src="includes/getbookslist.js" defer></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>books list</title>
</head>

<body>
    <header id="header" class="page-header">
        <div class="page-header row">      
            <div class="col-md-4">
                 <a href="#" class="logo"><span> Flourish </span>&<span> Blotts </span></a>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="catalog-search">
                    <input class="shuffle-search input_field " type="search" autocomplete="off" value="" maxlength="128" placeholder="Search Book" id="input-search"/>
                    <button type="button" name="button"  id='clickMe'><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>

            </div>
        </div>
    </header>

    <main>
   
    <?php
    if (isset($_GET['id'])) {
        $bookId = $_GET['id'];

        $sql = "SELECT * FROM tbl_94_books WHERE id = $bookId";
        $data = $connect->query($sql);

        if ($data) {
            if ($data->num_rows > 0) {
                $row = $data->fetch_assoc();
                $id = $row['id'];
                $bookName = $row['name'];
                $details = $row['description'];
                $cost = $row['price'];
                $writer = $row['author'];
                $coverImage = $row['photo'];
                $backImage = $row['secphoto'];
                $genre = $row['category'];

                echo '<div class="book-details">';
                echo '<div class="book-info">';
                echo '<h1>' . $bookName . '</h1>';
                echo '<p class="author">Author: ' . $writer . '</p>';
                echo '<p>Category: ' . $genre . '</p>';
                echo '<p>Description: ' . $details . '</p>';
                echo '<p>Price: ' . $cost .' $'. '</p>';
                echo '</div>';
                
                echo '<div class="book-images">';
                echo '<img src="' . $coverImage . '" alt="Book Cover">';
                echo '<img src="' . $backImage . '" alt="Book back">';
                echo '</div>';
                echo '</div>';

            } else {
                echo "Book not found.";
            }
        } else {
            echo "Error executing the query.";
        }
    }
    ?>

    </main> 
</body>
</html>

<?php
$connect->close();
?>