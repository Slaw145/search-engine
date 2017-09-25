
<?php
require_once "connect.php";
								
mysqli_report(MYSQLI_REPORT_STRICT);
		
$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			
if(isset($_POST['przycisk']))
{
		$plik_tmp = $_FILES['plik']['tmp_name']; 
		$plik_nazwa = $_FILES['plik']['name']; 
		$plik_rozmiar = $_FILES['plik']['size']; 

if(is_uploaded_file($plik_tmp)) 
{ 

	 move_uploaded_file($plik_tmp, "$plik_nazwa"); 
				 
	$tablica = explode(".zip", $plik_nazwa);
	
	$zip = new ZipArchive();
	if ($zip->open($plik_nazwa) !== TRUE)
	{
		 die ('Błąd rozpakowywania archiwum.');
		 $zip->close();
	}
	else
	{
		echo '<h1>Pliki rozpakowane poprawnie.</h1>';
		 $zip->extractTo("Steamjety");
		 $zip->close();
		 
	}
	
				
				
			$docelowy = 'Steamjety/'.$tablica[0].'/data';
			$nowy = "wszystkiedane";
								 
			$kat = opendir($docelowy);
			$kat1 = opendir($nowy);
			if($kat)
			{
								 
				while($plik = readdir($kat))
			{
				if(($plik != '.') AND ($plik != '..'))
				{
					copy_directory('Steamjety/'.$tablica[0].'/data/',$nowy);
				}
			}
								
					$polaczenie->query("DELETE FROM `data` WHERE `data`.`id` > 0");
					$licz=2;
					$files = array_diff(scandir($nowy), array('..', '.'));

		foreach($files as $file) {
			$files_1 = array_diff(scandir($nowy.'/'.$files[$licz]), array('..', '.'));
												
				foreach($files_1 as $file_1) {
						$files_2 = array_diff(scandir($nowy.'/'.$files[$licz].'/'.$file_1), array('..', '.'));
												
							foreach($files_2 as $file_2) {
														
								$polaczenie->query("INSERT INTO `data` (`id`, `maszyna`, `daty`, `pliki`) VALUES (NULL, '$file', '$file_1', '$file_2')");
								$polaczenie->query("SELECT * FROM `data` ORDER BY daty ASC");
							}
						}
					 $licz++;
				}
									
			}
			}

			$sqlite='Steamjety/'.$tablica[0].'/Processes.sqlite';

			if (file_exists($sqlite)) {
				try{
					  $db = new PDO('sqlite:'.$sqlite); 
					  
					  $db->exec("CREATE TABLE IF NOT EXISTS Process (id INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , date DATETIME, processId INTEGER, processType INTEGER, processStatus INTEGER, machine STRING, errorId INTEGER, note TEXT)");

					  $select = $db->prepare('SELECT * FROM Process ORDER BY id');
					  

					  $select->execute();

					  $pdo = new PDO('mysql:host=94.23.200.25;dbname=Steamjet_serwis', 'lchojnicki', 'Zpf68WFs@');
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
			}
			closedir($kat1);
			closedir($kat);


			
			
							header('Location: apka');
}
	
   function copy_directory( $source, $destination ) {
        if ( is_dir( $source ) ) {
        @mkdir( $destination );
        $directory = dir( $source );
        while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
            if ( $readdirectory == '.' || $readdirectory == '..' ) {
                continue;
            }
            $PathDir = $source . '/' . $readdirectory; 
            if ( is_dir( $PathDir ) ) {
                copy_directory( $PathDir, $destination . '/' . $readdirectory );
                continue;
            }
            copy( $PathDir, $destination . '/' . $readdirectory );
        }

        $directory->close();
        }else {
        copy( $source, $destination );
        }
    }
	
?>

