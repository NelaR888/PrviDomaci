<?php
    require '../broker.php';

    $broker=Broker::getBroker();
    $naziv=$_POST['naziv'];
    $id_tip_kore=$_POST['id_tip_kore'];
    $id_vrsta_pice=$_POST['id_vrsta_pice'];
    $slika=$_FILES['slika'];
    $opis=$_POST['opis'];
    $cena=$_POST['cena'];
    $nazivSlike=$slika['name'];
    $lokacija = "../../img/".$nazivSlike;
    if(!move_uploaded_file($_FILES['slika']['tmp_name'],$lokacija)){
        $lokacija="";
      echo json_encode([
          "status"=>false,
          "error"=>"Neuspesno prebacivanje slike"
      ]);

    }else{

        $lokacija=substr($lokacija,4);
    }

    $rezultat=$broker->izmeni("insert into pica (naziv,cena,id_tip_kore,slika,opis,id_vrsta_pice) values ('".$naziv."',".$cena.",".$id_tip_kore.",'".$lokacija."','".$opis."',".$id_vrsta_pice.") ");
    echo json_encode($rezultat);

?> 