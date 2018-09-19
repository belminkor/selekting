<?php
function Insert($tabela, $polja, $vrijednosti){
	include "dbkon.php";

	$sql = "INSERT INTO $tabela ($polja)
			VALUES ($vrijednosti)";

	if ($conn->query($sql) === TRUE){
    	return $conn->insert_id;
    }else{
    	return $conn->error;
    }	
}

function Update($tabela, $postavke, $id){
	include "dbkon.php";

	$sql = "UPDATE $tabela
			SET $postavke
			WHERE id='$id'";

	if ($conn->query($sql) === TRUE){
    	return "spaseno";
    }else{
    	return $conn->error;
    }
}

function UpdatePoSifri($tabela, $postavke, $sifra){
	include "dbkon.php";

	$sql = "UPDATE $tabela
			SET $postavke
			WHERE sifra='$sifra'";

	if ($conn->query($sql) === TRUE){
    	return "spaseno";
    }else{
    	return $conn->error;
    }
}

function Remove($tabela, $id){
	include "dbkon.php";

	$sql = "DELETE FROM $tabela WHERE id='$id'";

	if ($conn->query($sql) === TRUE){
    	return "obrisano";
    }else{
    	return $conn->error;
    }
}

function TruncateTable($tabela){
	include "dbkon.php";

	$sql = "TRUNCATE $tabela";
	if ($conn->query($sql) === TRUE){
    	return "obrisano";
    }else{
    	return $conn->error;
    }
}

function Select($tabela, $filter="", $redanje="" , $limit=""){
	include "dbkon.php";

	$return = array();

	$sql = "SELECT * FROM $tabela";
	if($filter!=""){
		$sql .= " ".$filter;
	}
	if($redanje!=""){
		$sql .= " ".$redanje;
	}
	if($limit!=""){
		$sql .= " ".$limit;
	}
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
      	array_push($return, $row);
      }
    }

    return $return;
}

function SelectTotal($tabela, $filter="", $redanje=""){
	include "dbkon.php";

	$sql = "SELECT COUNT(*) AS total FROM $tabela";
	if($filter!=""){
		$sql .= " ".$filter;
	}
	if($redanje!=""){
		$sql .= " ".$redanje;
	}

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
      	$total = $row['total'];
      }
    }

    return $total;
}

function Slike($input, $folder, $id, $file, $multiple=false){

	$lokacija = $folder."/".$id;

	if(!is_dir($lokacija)){
		mkdir($lokacija,0777,true);
	} 

	if($multiple==false){
		move_uploaded_file($_FILES[$input]['tmp_name'], $lokacija."/".$file);
		Kompresuj($lokacija."/".$file, $lokacija."/".$file, 90);
	}else{
		for ($i=0; $i < count($_FILES[$input]['tmp_name']) ; $i++) { 
          $random = uniqid();
          $ostaleslike = $lokacija."/".$random.".png";
          
          if(file_exists($ostaleslike)){
            $random = uniqid();
            $ostaleslike = $lokacija."/".$random.".png";  
          }

          move_uploaded_file($_FILES[$input]['tmp_name'][$i], $ostaleslike);
          Kompresuj($lokacija."/".$file, $lokacija."/".$file, 90);
        }
	}
}

function Kompresuj($izvorniUrl, $destinacija, $kvalitet) {
	$info = getimagesize($izvorniUrl);
 
	if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($izvorniUrl);
	elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($izvorniUrl);
	elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($izvorniUrl);	

	imagejpeg($image, $destinacija, $kvalitet);
 
	return $destinacija;
}

function Cijena($mpc, $vpc, $klijent=""){
	include "dbkon.php";

	if($klijent==""){
		if(isset($_SESSION['klijent'])){
			$idklijenta = $_SESSION['klijent'];

			$sql = "SELECT popust FROM klijenti WHERE id='$idklijenta' LIMIT 1";		
		    $result = $conn->query($sql);

		    if ($result->num_rows > 0) {
		      while($row = $result->fetch_assoc()) {
		      	$popust = $row['popust'];
		      }
		    }

		    $krajnja = round($vpc * ((100-$popust) / 100), 2);

		    return $krajnja;
		}else{
			return $mpc;
		}
	}else{
		$sql = "SELECT popust FROM klijenti WHERE id='$klijent' LIMIT 1";		
	    $result = $conn->query($sql);

	    if ($result->num_rows > 0) {
	      while($row = $result->fetch_assoc()) {
	      	$popust = $row['popust'];
	      }
	    }

	    $krajnja = round($vpc * ((100-$popust) / 100), 2);

	    return $krajnja;
	}	
}

?>