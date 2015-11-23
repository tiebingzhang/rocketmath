<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Rocket Math Generator</h1>
        <p>Select a level and we will generate a printable Rocket Math exercise sheet for you.</p>
      </div>


      <div class="page-header">
        <h1>Pick a Level</h1>
		<?php
		$count=0;
		for ($i=65;$i<(65+26);$i++){
			if ($count>0 && $count%8==0){
				echo "<br><br>";
			}
			$count++;
        	echo '<a role="button" href="./generate.php?level='.chr($i).'" class="btn btn-lg btn-primary" style="width:100px"> Level '. chr($i) .'</a> &nbsp;&nbsp;';
		}
		?>
      </div>
      <p>
      </p>
</div>
</body>
</html>
