<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "agrimanagement";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['search'])) {
    $searchItem = $_GET['search'];
    

    $sql = "SELECT item_description, item_type, harvest, disorder FROM farmingitems WHERE item_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchItem);
    $stmt->execute();
    $result = $stmt->get_result();
   
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $itemDescription = $row['item_description'];
        $itemType = $row['item_type'];
        $harvest = $row['harvest'];
        $disorder = $row['disorder'];
    } else {
        echo "No results found.";
    }
    
    $stmt->close();
}

$conn->close();
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriManagement</title>
    <link rel="stylesheet" href="style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container1">
        <div class="navbar">
            <img src="images/seedling.png" class="logo">
            <nav>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Profile</a></li>
                </ul>
            </nav>
            <form class="search-form" action="#" method="get">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit">Search</button>
            </form>
            <img src="images/menu.png" class="menu-icon">
        </div>
        
        <div class="row">
            <div class="col">
                <h1><?php echo isset($searchItem) ? $searchItem :""; ?></h1>
                <h3><?php echo isset($itemType) ? $itemType :"" ; ?></h3>
                <p><?php echo isset($itemDescription) ? $itemDescription :"" ; ?></p>
            </div>
            
            <div class="col">
                <div class="card card1">
                    <h4><b>Harvesting</b></h4>
                    <p><?php echo isset($harvest) ? $harvest : ""; ?></p>
                </div>
                <div class="card card2">
                    <h4><b>Disorder</b></h4>
                    <p><?php echo isset($disorder) ? $disorder : ""; ?></p>
                </div>
                <div class="card card3">
                    <h4><b>Characteristics</b></h4>
                    <p>Strawberries (*Fragaria* genus) are herbaceous perennials with compound leaves, stolons for asexual reproduction, a fibrous root system.</p>
                </div>
                <div class="card card4">
                    <h4><b>Nutritional Benefits</b></h4>
                    <p>Strawberries are rich in vitamin C, manganese, antioxidants, and dietary fiber while being low in calories and free of fat and cholesterol.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
