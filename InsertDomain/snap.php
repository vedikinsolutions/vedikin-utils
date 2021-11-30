<?php


/*snapname site domain script start */

$directory = "../domain-snap/*"; // CSV Files Directory Path

$data = array(); // Empty Data

foreach(glob($directory) as $file) {
    if (strpos($file, '.csv') !== false) {
        if (($handle = fopen($file, 'r')) !== false) {
            $isFirstRecord = true;
            while (($dataValue = fgetcsv($handle)) !== false) {
                if(!$isFirstRecord)
                    $data[] = $dataValue;
                else {
                    $isFirstRecord = false;
                }
            }
        }
        fclose($handle);
    } else {
        echo "[$file] is not a CSV file.";
    }

}
// print_r($data);exit;
snapnameinsertdomain($data);

function snapnameinsertdomain($row){

    require 'connect.php';

    if(is_array($row) != '' && is_array($row)){

        $sql = "";
        
        $counter = 0;
        for ($i=0; $i < (int)(count($row)/10000); $i++) { 
            $sql = "INSERT INTO thctools_whois (`domain`, `domain_tld`, `domain_expiration_date`) VALUES ";
            $counter++;
            for ($j=0; $j < 10000; $j++) { 
                
                $tlds = substr($row[$i*10000 + $j][0], strpos($row[$i*10000 + $j][0], ".") + 1);
                
                $date_create = date_create($row[$i*10000 + $j][3]);
                $date = date_format($date_create,"Y-m-d");
                
                $sql .= " ('".$row[$i*10000 + $j][0]."','$tlds','$date'),";

            }
            $final_query = rtrim($sql,',');
           // echo $final_query;exit;
            if ($conn->query($final_query) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $final_query . "<br>" . $conn->error;
            }
              
            $conn->close();
        }

        // To handle remainder
        $sql = "INSERT INTO thctools_whois (`domain`, `domain_tld`, `domain_expiration_date`) VALUES ";
        for ($j=$counter; $j < count($row); $j++) { 
            
            $tlds = substr($row[$i*10000 + $j][0], strpos($row[$i*10000 + $j][0], ".") + 1);
            
            $date_create = date_create($row[$i*10000 + $j][3]);
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

/*snapname site domain script end */

?>