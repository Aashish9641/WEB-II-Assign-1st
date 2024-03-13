<?php
// beginning of the session
session_start();
require 'data.php';  // connecting with the database
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Carbuy Auctions</title>
		<!-- linkning with the css with the help of this structure -->
		<link rel="stylesheet" href="carbuy.css" /> 
	</head>
	
	<style>
		/* added style for login and logout */
    .categoryLink {
        color:  black;
        text-decoration: none;
    }
/* adding for hover effect */
    .categoryLink:hover {
        color: black; 
        text-decoration: underline;
    }
	/* adding style for login and logout   */
	.logoutt{
		text-align: right;
        padding-right:20px;		
        margin-left:none;
	}
	.logoutt:hover{
		color: red  !important;
		text-decoration: bold ;
	    
	
	}
	/* making css for logout option */
	.usd{
		font-size: 24px;
		color: black;
		border: black solid 4px;
		backgroud-color: powderblue;
		padding: 10px;
		margin-right: 14px;
		display: inline-block;
		border-radius: 70px;
		font-weight: bold;
	

	}
	.Co{
		display:flex;
		align-items:center;
		text-align: center;
		justify-content:center
	}
         /* hover effect on logout section */
	.ops:hover{
	
    background-color: skyblue;
    color: white;
    text-decoration: none; /* Optional: Remove underline on hover */
	}

.ops {
    float: right; /* align to the right side of rhe scree */
    color: black;
    text-decoration: none;
    padding: 11px;
    margin: 16px auto;
    display: inline-block;
    border: solid black 2px;
    border-radius: 15px;
}
 /* tgis is for added categoiry items */

	/* Style for the dropdown menu */
.dropdown {
    display: inline-block;
    position: relative;
}

/* Dropdown button styling */
.dropbtn {
    color: black;
    padding: 14px;
    font-size: 16px;
    border: none;
    cursor: pointer; /* Add cursor pointer */
	font-size: 25px;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color:white; /* Change the background color as needed */
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
	font-size: 24px;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: aqua; /* Change the hover background color as needed */
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
    display: block;
}
/* using marquee effect for 600px sizw*/
.marquee{

	width:600px;
}
/* making the items in center  */
h1{
	align-items:center;
	text-align:center;
}

	
</style>

<body>
<?php
// Checking if the user is logged on or not
if (isset($_SESSION['userLog'])) {
    $userLog = $_SESSION['userLog'];
    
    // Checking if the 'name' key exists and is not empty
    if (!empty($userLog['name'])) {
        // Showing the first letter of the logged-on user
        echo '<div class="Co">';
        echo '<div class="usd">' . strtoupper(substr($userLog['name'], 0, 1)) . '</div>';
		// for login user to see the name and first letter of the name 
        echo '<p> Hey , ' . $userLog['name'] .  'Wasssup !</p>';
		echo '<div class="marquee">';
		// with the help of marqe showing the welcome message to users
		echo '<marquee direction="right">Welcome  @ ' . $userLog['name'] . '</marquee>';

        echo '</div>';
        echo '</div>';

		echo '<div class="ops">';
		// after logout user id disappear 
        echo '<a href="logout.php">Wanna logout</a>';
        echo '</div>';
		echo '</br>';
		// user can create the auction after login

		echo '<a href="addAuction.php" style="background-color: black;color:white; border-radius: 8px; padding: 8px 19px; margin:20px;text-decoration: underline;transition:background-color 0.43s;">Add Auction</a>';
		
		
		
		echo '<a href="editAuction.php" style="background-color: aqua;color:black; border-radius: 8px; padding: 8px 12px; margin-left:13px; text-decoration: underline;transition:background-color 0.3s;">Edit Auction</a>';
		
    } 
}
    ?>

</div>
		<header>
			<h1><span class="C">C</span>
 			<span class="a">a</span>
			<span class="r">r</span>
			<span class="b">b</span>
			<span class="u">u</span>
			<span class="y">y</span></h1>

			<form action="#">
				<input type="text" name="search" placeholder="Search for a car" />
				<input type="submit" name="submit" value="Search" />

			</form>
		</header>
<?php
		
// Fetch and display the categories using prepared statement in index
$disp = $connection->prepare("SELECT * FROM aCategories");
$disp->execute();
$caa = $disp 	->fetchAll(PDO::FETCH_ASSOC);

?>
		
			<nav>
			<ul>
				<li><a class="categoryLink" href="updateCate.php">Estate</a></li>
				<li><a class="categoryLink" href="updateCate.php">Electric</a></li>
				<li><a class="categoryLink" href="updateCate.php">Coupe</a></li>
				<li><a class="categoryLink" href="updateCate.php">Saloon</a></li>
				<li><a class="categoryLink" href="updateCate.php">4x4</a></li>
				<li><a class="categoryLink" href="updateCate.php">Sports</a></li>
				<li><a class="categoryLink" href="updateCate.php">Hybrid</a></li>

				
  <!-- Displaying categories dynamically -->
  <?php if (!empty($caa)) : ?>
            <li class="dropdown">
                <a href="#" class="dropbtn">More</a>
                <div class="dropdown-content">
                    <?php foreach ($caa as $category) : ?>
                        <a href="#" class="categoryLink"><?php echo htmlspecialchars($category['name']); ?></a>
                    <?php endforeach; ?>
                </div>
            </li>
        <?php endif; ?>
				<li><a class="categoryLink" href="new.php" >Login</a></li>   <!-- created login page for user or admin  -->

			</ul>
</nav>




		<main>
			<h1>Latest Car Listings / Search Results / Category listing</h1>

<?php

// Retrieve the data from the database
$sql = "SELECT * FROM auction";
$stmt = $connection->prepare($sql);
$stmt->execute();
$auctions= $stmt->fetchAll(PDO::FETCH_ASSOC);








// createing for auction and displyaing the adding for users 
		foreach ($auctions as $auction) : ?>
			<div>
				<h2><?php echo htmlspecialchars($auction['title']); ?></h2>
				<p>Description: <?php echo htmlspecialchars($auction['description']); ?></p>
				<p>Category: <?php echo htmlspecialchars($auction['categoryName']); ?></p>
				<p> Current Bid Amount: $ <?php echo htmlspecialchars($auction['bid']); ?></p>
				<p>End Date: <?php echo htmlspecialchars($auction['endDate']); ?></p>
				<a href ="estate.php" style="margin-right:20px; color:blue;">Add Review</a>
<?php
// this is for user review(user can add ther review)
				$ac = 'SELECT * FROM review';
$reviews = $connection->prepare($ac);
$reviews->execute();
$reee = $reviews->fetchAll(PDO::FETCH_ASSOC); // fetching and displaying
?>
<?php foreach ($reee as $review) : ?> <!-- using for each loop-->
    <div>
        <p>User review:
		 <?php echo htmlspecialchars($review['desc']); ?></p>
        <!-- Add more review details as needed -->
    </div>
<?php endforeach; ?>


				
				
				<li>

				
				
			</div> 
		<?php endforeach; ?>
					<li>


					<footer>
				&copy; Carbuy 2024
			</footer>