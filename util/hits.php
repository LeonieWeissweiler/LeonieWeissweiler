<!DOCTYPE html>
<html lang="de">
	<head>
		<!-- ================= NECESSITIES AND BOOTSTRAP ================== -->
		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
			
			<!-- Get my own stylesheet in here -->
			<link rel="stylesheet" type="text/css" href="util/css/main.css">
    <!-- =================== META INFO ======================== -->
	<title>Leonie Weißweiler</title>
	<link rel="icon" href="favicon.ico" type="util/favicon.ico" />
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	 <![endif]-->
	</head>
	
	<body>
		
		<div class="container">
		
			<h1>Hits</h1>
			
			<table class="table table-striped">
              <thead>
              	<th>Seite</th>
              	<th>Aufrufe</th>
              </thead>
			
			<?php
			
			
			$path = getcwd()."/..";
			
			function getDirContents($dir, &$results = array()){
			    $files = scandir($dir);
			
			    foreach($files as $key => $value){
			        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
			        if(!is_dir($path)) {
			            $results[] = $path;
			        } else if($value != "." && $value != "..") {
			            getDirContents($path, $results);
			            $results[] = $path;
			        }
			    }
			
			    return $results;
			}
			
			function getDirH1($dir) {
				$index = dirname($dir)."/index.php";
				$index_contents = file_get_contents($index);
				
				$d = new DOMDocument();
			    $d->loadHTML($index_contents);
			    $tagname = "h1";
			    
			    foreach($d->getElementsByTagName($tagname) as $item){
					$h1 = $item->textContent;
			    }
			    
			    if ($h1 == "") {
			    	return dirname($dir);
			    }
				return $h1;
			}
			
			foreach(getDirContents($path) as $file) {
				if (basename($file) == "hit.txt") {
					echo "<tr> \n";
					$title = getDirH1($file);
					$count = file_get_contents ($file);
					print "<td>$title</td>";
					echo "<td>$count</td>\n";
					echo "</tr>\n";
				}
			}
			
			?>
			
			</table>
			
		</div>
		
		<!-- =============== BOOTSTRAP NECESSITES ================= -->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="util/js/bootstrap.min.js"></script>
	</body>
</html>
