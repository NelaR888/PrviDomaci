<?php
    require '../broker.php';
    $broker=Broker::getBroker();
   
    $naziv=$_POST['naziv'];
    if(!preg_match('/^[a-zA-Z\s]*$/',$naziv)){
        echo json_encode([
            'status'=>false,
            'error'=>'Naziv vrste pice sme da se sastoji samo od slova!'
        ]);
    }else{
        $rezultat=$broker->izmeni("insert into vrsta_pice(naziv) values ('".$naziv."') ");
       echo json_encode($rezultat);
    }

?>