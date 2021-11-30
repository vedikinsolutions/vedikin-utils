<?php

/*other site domain script start */
$filename = "../domain-other/*";
$lines = array();


foreach(glob($filename) as $file) {
    if (strpos($file, '.txt') !== false) {
        if (($handle = fopen($file, 'r')) !== false) {
            /* read single file text and store in variable */
            $content = fread($handle, filesize($file));
            $lines = explode("\n", $content);

            /* remove first line from single files */
            //array_shift($tmp_array);
        }
        //$lines = array_merge($lines,$tmp_array); 
        fclose($handle);

    } else {
        echo "[$file] is not a txt file.";
    }

}


// $handle = fopen($filename, 'r'); 
// /* read single file text and store in variable */
// $content = fread($handle, filesize($filename));
// $lines = explode("\n", $content);
// fclose($handle);

$space_seperated = array();
$other_final_domain = array();

foreach($lines as $single_line){
    $space_seperated = explode(",",$single_line);

    $arTemp = array();

    $arTemp[0] = trim($space_seperated[0]);
    $arTemp[1] = $space_seperated[1];

    $other_final_domain[] = $arTemp;
}
// echo "<pre>";
// print_r($other_final_domain);exit;

//otherinsertdomain($other_final_domain);

function otherinsertdomain($row){

   // require 'connect.php';

    if(is_array($row) != '' && is_array($row)){

        $sql = "";
        
        $counter = 0;
        for ($i=0; $i < (int)(count($row)/10000); $i++) { 
            $sql = "INSERT INTO thctools_whois (`domain`, `domain_tld`, `domain_expiration_date`) VALUES ";
            $counter++;
            for ($j=0; $j < 10000; $j++) { 
                
                $tlds = substr($row[$i*10000 + $j][0], strpos($row[$i*10000 + $j][0], ".") + 1);
                
                $date_create = date_create($row[$i*10000 + $j][1]);
                $date = date_format($date_create,"Y-m-d");
                
                $sql .= " ('".$row[$i*10000 + $j][0]."','$tlds','$date'),";

            }
            $final_query = rtrim($sql,',');
            //echo $final_query;exit;
            if ($conn->query($final_query) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $final_query . "<br>" . $conn->error;
            }
            // print_r($final_query);exit;
            
        }
        $conn->close();
        // To handle remainder
        $sql = "INSERT INTO thctools_whois (`domain`, `domain_tld`, `domain_expiration_date`) VALUES ";
        for ($j=$counter; $j < count($row); $j++) { 
            
            $tlds = substr($row[$i*10000 + $j][0], strpos($row[$i*10000 + $j][0], ".") + 1);
            
            $date_create = date_create($row[$i*10000 + $j][1]);
            $date = date_format($date_create,"Y-m-d");
            
            $sql .= " ('".$row[$i*10000 + $j][0]."','$tlds','$date'),";
        }
        $final_query = rtrim($sql,',');
        //echo $final_query;exit;
        if ($conn->query($final_query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $final_query . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
/*other site domain script end */

?>