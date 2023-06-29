<?php 
    require_once "config.php";

    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
   
    if($db->connect_errno) {
        exit("Database connection failed: " . $db->connect_error . " (" . $db->connect_errno . ")");
    }
?>

<?php 
    $sql = "SELECT * FROM tbl_94_books ORDER BY name";
    $res = $db->query($sql);
    if(!$res) {
        exit("Database query failed.");
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
          <!-- Logo -->
          <div class="col-md-4">
            <a href="#" class="logo"><span> Flourish </span>&<span> Blotts </span></a>
          </div>

          <div class="col-md-4 col-md-offset-4">
            <!-- Search -->
            <div class="catalog-search">
              <input class="shuffle-search input_field " type="search" autocomplete="off" value="" maxlength="128" placeholder="Search Book" id="input-search"/>
              <button type="button" name="button"  id='clickMe'><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>

          </div>
        </div>
      
    </header>

    <main>
  <div class="filter-dropdown">
  <label class="category-list" for="category-select">Filter by Category:</label>
  <select id="category-select">
      <option value="all">All</option>
      <?php
      foreach ($categories['category'] as $category) {
          echo '<option value="' . $category['name'] . '">' . $category['name'] . '</option>';
      }
      ?>
  </select>
</div>
<?php
if ($res->num_rows > 0) {
    $outputBooks = '<div class="rows" id="books">';
    
    while ($data = $res->fetch_assoc()) {
        $bookId = $data['id'];
        $bookName = $data['name'];
        $bookDescription = $data['description'];
        $bookPrice = $data['price'];
        $bookAuthor = $data['author'];
        $bookImage = $data['photo'];
        $bookCategory = $data['category'];

        $bookCol = '<div class="col-md-6" id="books-img-info' . $bookId . '" data-category="' . $bookCategory . '">';
        $bookCol .= '<div class="book-image"><img src="' . $bookImage . '"/></div>';
        $bookCol .= '<div class="book-info" id="book-info">';
        $bookCol .= '<h3>' . $bookName . '</h3><p class="author">by ' . $bookAuthor . '</p>';
        $bookCol .= '<p class="description">' . $bookDescription . '</p>';
        if (!empty($bookPrice)) {
            $bookCol .= '<p class="price">Price: ' . $bookPrice . '$</p>';
        }
        $bookCol .= '<a href="book.php?id=' . $bookId . '" class="view">View Details</a></div></div>';

        $outputBooks .= $bookCol;
    }

    $outputBooks .= '</div>';
    echo '<div class="container" id="title"></div>';
    echo $outputBooks;
    echo '<br>';
} else {
    echo "No data found.";
}
?>
</main>
</body>
</html>

<?php
$db->close();
?>