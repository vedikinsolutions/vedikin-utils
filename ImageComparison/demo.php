<?php
function get_images($image1,$image2)
{
    $image1 = createImage($image1);


    $image2 = createImage($image2);
    
    //convert images in bits
    $width = imagesx($image1);
    $height = imagesy($image1);
    
    $width1 = imagesx($image2);
    $height1 = imagesy($image2);
    //compare two images pixels
    $map = [];
    if($width != $width1 && $height != $height1){ return false;}
    $counter=0;
    for ($y = 0; $y < $height; $y++) {
        $map[$y] = [];
    
        for ($x = 0; $x < $width; $x++) {
            $color = imagecolorat($image1, $x, $y);
            $color1 = imagecolorat($image2, $x, $y);
    
            if($color == $color1)
            {
                $counter++;
            }
          
        }
    }
    //increment counts of difference
    
    $result=$counter/($width*$height)*100;
  
    //get percentage of differences
    echo "<pre>";print_r($result);
}
function mimeType($i)
	{
		/*returns array with mime type and if its jpg or png. Returns false if it isn't jpg or png*/
		$mime = getimagesize($i);
		$return = array($mime[0],$mime[1]);
      
		switch ($mime['mime'])
		{
			case 'image/jpeg':
				$return[] = 'jpg';
				return $return;
			case 'image/png':
				$return[] = 'png';
				return $return;
			default:
				return false;
		}
    }
        function createImage($i)
        {
            /*retuns image resource or false if its not jpg or png*/
            $mime = mimeType($i);
          
            if($mime[2] == 'jpg')
            {
                return imagecreatefromjpeg ($i);
            } 
            else if ($mime[2] == 'png') 
            {
                return imagecreatefrompng ($i);
            } 
            else 
            {
                return false; 
            } 
        }
get_images('desktop.png','desktop1.png');