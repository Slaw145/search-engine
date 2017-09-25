
<?php
										
if(isset($_POST['przycisk']))
{
		$plik_tmp = $_FILES['plik']['tmp_name']; 
		$plik_nazwa = $_FILES['plik']['name']; 
		$plik_rozmiar = $_FILES['plik']['size']; 

	if(is_uploaded_file($plik_tmp)) 
	{ 

		 move_uploaded_file($plik_tmp, "$plik_nazwa"); 
					 
					
	}
	
	
		try {
	  $db = new PDO('sqlite:'.$plik_nazwa); 
	  
	  $db->exec("CREATE TABLE IF NOT EXISTS Process (id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , date DATETIME, processId INTEGER, processType INTEGER, processStatus INTEGER, machine STRING, errorId INTEGER, note TEXT)");

	  $select = $db->prepare('SELECT * FROM Process ORDER BY id');
	  

	  $select->execute();

	  $pdo = new PDO('mysql:host=localhost;dbname=slawe_daneklient', 'slawe', '8W5pcQA0jK');
	  $pdo -> query ('SET NAMES utf8');
	  $pdo -> query ('SET CHARACTER_SET utf8_unicode_ci');
	  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  
		  
	  foreach($select as $row)
	  {
		$date=$row['date'];
		$processId=$row['processId'];
		$processType=$row['processType'];
		$processStatus=$row['processStatus'];
		$machine=$row['machine'];
		$errorId=$row['errorId'];
		$note=$row['note'];
		
		$pdo->query("INSERT INTO Process VALUES (NULL,'$date','$processId','$processType','$processStatus','$machine','$errorId','$note')");
		
	  }
	  
	  //$pdo->query("SELECT * FROM Process ORDER BY date ASC");

	  $db = NULL;
	  
	}
	catch (PDOException $e) {
	  print 'Exception : ' . $e->getMessage();
	}
	
	header('Location: apka/#/sqlite');
}

?>
