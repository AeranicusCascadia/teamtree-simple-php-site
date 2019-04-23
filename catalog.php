<?php 
include("inc/data.php");
include("inc/functions.php");

$pageTitle = "Full Catalog";
$section = null;

if (isset($_GET["cat"])) {

if ($_GET["cat"] == "books") {
		$pageTitle = "Book Catalog";
		$section = "books";
	} elseif ($_GET["cat"] == "music") {
		$pageTitle = "Music Catalog";
		$section = "music";
	} elseif ($_GET["cat"] == "movies") {
		$pageTitle = "Movie Catalog";
		$section = "movies";
	}
}
 
include("inc/header.php"); 


?>

<div class="section catalog page">
	
	<div class="wrapper">
		
		<h1><?php echo $pageTitle; ?></h1>
		
		<ul class="items">
			<?php
				foreach ($catalog as $id => $item) {
					echo get_item_html($id, $item);
				}
			?>
		</ul>
		
	</div>
	
</div>

<?php include("inc/footer.php"); ?>

