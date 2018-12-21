
<head>
	<link href="../css/pagination.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
$stages = 3;

if($pagenumber){
	$start = ($pagenumber - 1) * $pagesize; 
} else{
	$start = 0;	
}	

$prev = $pagenumber - 1;
$next = $pagenumber + 1;
$lastpage = $pagecount;
$LastPagem1 = $lastpage - 1;

echo "Displaying records ".$pagedisplaycount." of ".$itemcount;

$paginate = '';
if($lastpage >= 1)
{
	$paginate .= "<div class='paginate'>";

	// Previous
	if ($pagenumber > 1){
		// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$prev'>previous</a>";
		$paginate.= "<a href='$targetpage?pagenumber=$prev&pagesize=$pagesize'>previous</a>";
	} else {
		$paginate.= "<span class='disabled'>previous</span>";
	}

	// Row of Pages
	if ($lastpage < 7 + ($stages * 2)) {
		for ($counter = 1; $counter <= $lastpage; $counter++) {
			if ($counter == $pagenumber) {
				$paginate.= "<span class='current'>$counter</span>";
			} else {
				// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$counter'>$counter</a>";
				$paginate.= "<a href='$targetpage?pagenumber=$counter&pagesize=$pagesize'>$counter</a>";
			}
		}
	}
	else {	// if ($lastpage > 5 + ($stages * 2)) {
		if($pagenumber < 1 + ($stages * 2)) {
			for ($counter = 1; $counter < 4 + ($stages * 2); $counter++) {
				if ($counter == $pagenumber) {
					$paginate.= "<span class='current'>$counter</span>";
				} else {
					// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$counter'>$counter</a>";
					$paginate.= "<a href='$targetpage?pagenumber=$counter&pagesize=$pagesize'>$counter</a>";
				}
			}

			$paginate.= "...";
			// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$LastPagem1'>$LastPagem1</a>";
			// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$lastpage'>$lastpage</a>";		
			$paginate.= "<a href='$targetpage?pagenumber=$LastPagem1&pagesize=$pagesize'>$LastPagem1</a>";
			$paginate.= "<a href='$targetpage?pagenumber=$lastpage&pagesize=$pagesize'>$lastpage</a>";		
		}
		// Middle hide some front and some back
		elseif($lastpage - ($stages * 2) > $pagenumber && $pagenumber > ($stages * 2)) {
			// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=1'>1</a>";
			// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=2'>2</a>";
			$paginate.= "<a href='$targetpage?pagenumber=1&pagesize=$pagesize'>1</a>";
			$paginate.= "<a href='$targetpage?pagenumber=2&pagesize=$pagesize'>2</a>";
			$paginate.= "...";
			for ($counter = $pagenumber - $stages; $counter <= $page + $stages; $counter++)
			{
				if ($counter == $pagenumber) {
					$paginate.= "<span class='current'>$counter</span>";
				} else {
					// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$counter'>$counter</a>";
					$paginate.= "<a href='$targetpage?pagenumber=$counter&pagesize=$pagesize'>$counter</a>";
				}
			}
			$paginate.= "...";
			// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$LastPagem1'>$LastPagem1</a>";
			// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$lastpage'>$lastpage</a>";		
			$paginate.= "<a href='$targetpage?pagenumber=$LastPagem1&pagesize=$pagesize'>$LastPagem1</a>";
			$paginate.= "<a href='$targetpage?pagenumber=$lastpage&pagesize=$pagesize'>$lastpage</a>";		
		}
		// End only hide early pages
		else {
			// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=1'>1</a>";
			// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=2'>2</a>";
			$paginate.= "<a href='$targetpage?pagenumber=1&pagesize=$pagesize'>1</a>";
			$paginate.= "<a href='$targetpage?pagenumber=2&pagesize=$pagesize'>2</a>";
			$paginate.= "...";
			for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
			{
				if ($counter == $pagenumber) {
					$paginate.= "<span class='current'>$counter</span>";
				} else {
					// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$counter'>$counter</a>";
					$paginate.= "<a href='$targetpage?pagenumber=$counter&pagesize=$pagesize'>$counter</a>";
				}
			}
		}
	}

	// Next
	if ($pagenumber < $counter - 1){ 
		// $paginate.= "<a href='$targetpage?from=".$_REQUEST["from"]."&to=".$_REQUEST["to"]."&string=".stripcslashes($_REQUEST["string"])."&page=$next'>next</a>";
		$paginate.= "<a href='$targetpage?pagenumber=$next&pagesize=$pagesize'>next</a>";
	}
	else{
		$paginate.= "<span class='disabled'>next</span>";
	}

	// string
	$paginate.= "</div>";		
}

// pagination
echo $paginate;
?>
</body>
</html>
