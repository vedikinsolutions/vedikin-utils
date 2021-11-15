<?php

/*snapname site domain script start */

// $directory = "domain-nov/*"; // CSV Files Directory Path

// $data = array(); // Empty Data

// foreach(glob($directory) as $file) {
//     if (strpos($file, '.csv') !== false) {
//         if (($handle = fopen($file, 'r')) !== false) {
//             $isFirstRecord = true;
//             while (($dataValue = fgetcsv($handle)) !== false) {
//                 if(!$isFirstRecord)
//                     $data[] = $dataValue;
//                 else {
//                     $isFirstRecord = false;
//                 }
//             }
//         }
//         fclose($handle);
//     } else {
//         echo "[$file] is not a CSV file.";
//     }

// }

// snapnameinsertdomain($data);

// function snapnameinsertdomain($row){

//     require 'connect.php';

//     if(is_array($row) != '' && is_array($row)){

//         $sql = "";
        
//         $counter = 0;
//         for ($i=0; $i < (int)(count($row)/10000); $i++) { 
//             $sql = "INSERT INTO thctools_whois (`domain`, `domain_tld`, `domain_expiration_date`) VALUES ";
//             $counter++;
//             for ($j=0; $j < 10000; $j++) { 
                
//                 $tlds = substr($row[$i*10000 + $j][0], strpos($row[$i*10000 + $j][0], ".") + 1);
                
//                 $date_create = date_create($row[$i*10000 + $j][3]);
//                 $date = date_format($date_create,"Y-m-d");
                
//                 $sql .= " ('".$row[$i*10000 + $j][0]."','$tlds','$date'),";

//             }
//             $final_query = rtrim($sql,',');
//             //echo $final_query;exit;
//             if ($conn->query($final_query) === TRUE) {
//                 echo "New record created successfully";
//             } else {
//                 echo "Error: " . $final_query . "<br>" . $conn->error;
//             }
              
//             $conn->close();
//         }

//         // To handle remainder
//         $sql = "INSERT INTO thctools_whois (`domain`, `domain_tld`, `domain_expiration_date`) VALUES ";
//         for ($j=$counter; $j < count($row); $j++) { 
            
//             $tlds = substr($row[$i*10000 + $j][0], strpos($row[$i*10000 + $j][0], ".") + 1);
            
//             $date_create = date_create($row[$i*10000 + $j][3]);
//             $date = date_format($date_create,"Y-m-d");
            
//             $sql .= " ('".$row[$i*10000 + $j][0]."','$tlds','$date'),";
//         }
//         $final_query = rtrim($sql,',');
//         //echo $final_query;exit;
//         if ($conn->query($final_query) === TRUE) {
//             echo "New record created successfully";
//         } else {
//             echo "Error: " . $final_query . "<br>" . $conn->error;
//         }
//         $conn->close();
//     }
// }

/*snapname site domain script end */

/*godaddy site domain script start */

// $filename = "domain-nov/*";
// $lines = array();
// $tmp_array = array();
// foreach(glob($filename) as $file) {
//     if (strpos($file, '.txt') !== false) {
//         if (($handle = fopen($file, 'r')) !== false) {
//             /* read single file text and store in variable */
//             $content = fread($handle, filesize($file));
//             $tmp_array = explode("\n", $content);

//             /* remove first line from single files */
//             array_shift($tmp_array);
//         }
//         $lines = array_merge($lines,$tmp_array); 
//         fclose($handle);

//     } else {
//         echo "[$file] is not a txt file.";
//     }

// }

// $space_seperated = array();
// $remove_space = array();
// $final_domain = array();

// foreach($lines as $single_line){
//     $space_seperated = explode(" ",$single_line);
//     $remove_space = array_filter($space_seperated, fn($value) => !is_null($value) && trim($value) !== '');
//     $rearrange_values = array_values($remove_space);

//     // Prepare final_domain
//     if(strpos($rearrange_values[7],"D") > 0){
//         $arTemp = array();

//         $arTemp[0] = trim($rearrange_values[0]);
//         $date  = rtrim($rearrange_values[count($rearrange_values)-2],'D');

//         $int_date = (int)$date;
//         if(is_int($int_date))
//         {
//             // $original_date = DateTime::createFromFormat('m-d-Y', date("Y/m/d"));
//             // $create_date = date_create($original_date);
//             // date_add($create_date,date_interval_create_from_date_string("$int_date days"));
//             // $final_date = date_format($create_date,"Y-m-d");
//             $NewDate=Date('Y-m-d', strtotime("+$int_date days"));

//             $arTemp[1] = $NewDate;
//         }

//         $final_domain[] = $arTemp;
//     }
// }

// godaddyinsertdomain($final_domain);

// function godaddyinsertdomain($row){

//     require 'connect.php';

//     if(is_array($row) != '' && is_array($row)){

//         $sql = "";
        
//         $counter = 0;
//         for ($i=0; $i < (int)(count($row)/10000); $i++) { 
//             $sql = "INSERT INTO thctools_whois (`domain`, `domain_tld`, `domain_expiration_date`) VALUES ";
//             $counter++;
//             for ($j=0; $j < 10000; $j++) { 
                
//                 $tlds = substr($row[$i*10000 + $j][0], strpos($row[$i*10000 + $j][0], ".") + 1);
                
//                 $date_create = date_create($row[$i*10000 + $j][1]);
//                 $date = date_format($date_create,"Y-m-d");
                
//                 $sql .= " ('".$row[$i*10000 + $j][0]."','$tlds','$date'),";

//             }
//             $final_query = rtrim($sql,',');
//             //echo $final_query;exit;
//             if ($conn->query($final_query) === TRUE) {
//                 echo "New record created successfully";
//             } else {
//                 echo "Error: " . $final_query . "<br>" . $conn->error;
//             }
              
//             $conn->close();
//         }

//         // To handle remainder
//         $sql = "INSERT INTO thctools_whois (`domain`, `domain_tld`, `domain_expiration_date`) VALUES ";
//         for ($j=$counter; $j < count($row); $j++) { 
            
//             $tlds = substr($row[$i*10000 + $j][0], strpos($row[$i*10000 + $j][0], ".") + 1);
            
//             $date_create = date_create($row[$i*10000 + $j][1]);
//             $date = date_format($date_create,"Y-m-d");
            
//             $sql .= " ('".$row[$i*10000 + $j][0]."','$tlds','$date'),";
//         }
//         $final_query = rtrim($sql,',');
//         //echo $final_query;exit;
//         if ($conn->query($final_query) === TRUE) {
//             echo "New record created successfully";
//         } else {
//             echo "Error: " . $final_query . "<br>" . $conn->error;
//         }
//         $conn->close();
//     }
// }
/*godaddy site domain script end */

/*other site domain script start */
$filename = "domain-nov/PreRelease.txt";
$lines = array();

$handle = fopen($filename, 'r'); 
/* read single file text and store in variable */
$content = fread($handle, filesize($filename));
$lines = explode("\n", $content);
fclose($handle);

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

otherinsertdomain($other_final_domain);

function otherinsertdomain($row){

    require 'connect.php';

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