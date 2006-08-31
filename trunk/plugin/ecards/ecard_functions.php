<?php
error_reporting(E_ALL);
		ini_set('display_errors', true);


function draw_card($message=false, $template=false, $image=false, $return_raw=false)
{
		$font_copyright = 'arial.ttf';
		$font = 'gapstown.ttf';
		$left = 315;
		$right = 550;
		$top = 150;
	
		
		$font_size = 20;
		$line_height = 15;
		
		if (!$return_raw)
		{
			header("Content-type: image/jpeg");
		}
		
		
		// Création de l'image
		if ($template)
		{
				$im = @imagecreatefrompng($template); /* Attempt to open */
				if (!$im)
				{
						$im = imagecreatetruecolor(600, 400);
						$grey = imagecolorallocate($im, 128, 128, 128);
						$red = imagecolorallocate($im, 255, 0, 0);
						imagefill($im, 0,0, $grey);
						/* Output an errmsg */
						imagestring($im, 1, 5, 5, "Error loading $template", $red);
				}
		}
		
		
		// Création de quelques couleurs
		$white = imagecolorallocate($im, 255, 255, 255);
		$grey = imagecolorallocate($im, 128, 128, 128);
		$black = imagecolorallocate($im, 0, 0, 0);
		$red = imagecolorallocate($im, 255, 0, 0);
		
		
		
		
		// ajout de l'image à gauche :
		if ($image)
		{
				$im2 = imagecreatefromjpeg($image);
				if (!$im2)
				{
						$im2 = imagecreatetruecolor(600, 400);
						$grey = imagecolorallocate($im2, 128, 128, 128);
						$red = imagecolorallocate($im2, 255, 0, 0);
						imagefill($im2, 0,0, $grey);
						imagestring($im2, 1, 5, 5, "Error loading $image", $red);
				}
		}
		
		
		$width = 260;
		$height = 365;
		
		$width_orig = imagesx($im2);
		$height_orig = imagesy($im2);
		
		$ratio_orig = $width_orig/$height_orig;
		
		if ($width/$height > $ratio_orig) 
		{
				$width = $height*$ratio_orig;
		}
		else
		{
				$height = $width/$ratio_orig;
		}
		
		/*
		$im2_width = imagesx($im2);
		$im2_height = imagesy($im2);
		*/
		imagecopyresampled ( $im, $im2, 30, 30, 0, 0, $width, $height, $width_orig, $height_orig);
		
		
		imageprintWordWrapped(&$im, $top, $left, $right, $font, $black, $message, $font_size, $halign="left");
		
		// si on demande return raw, on retourne le contenu de l'image plutôt que de l'envoyer au browser
		// utile pour envoyer l'image en attachment
		if (!$return_raw)
		{
				imagejpeg($im, '', 95);
		}
		else
		{
				ob_start(); // start a new output buffer
				imagejpeg($im, '', 95);
				$ImageData = ob_get_contents();
				ob_end_clean(); // stop this output buffer
				return $ImageData;
		}
}


function fixbbox($bbox)
{
		$tmp_bbox["left"] = min($bbox[0],$bbox[2],$bbox[4],$bbox[6]);
		$tmp_bbox["top"] = min($bbox[1],$bbox[3],$bbox[5],$bbox[7]);
		$tmp_bbox["width"] = max($bbox[0],$bbox[2],$bbox[4],$bbox[6]) - min($bbox[0],$bbox[2],$bbox[4],$bbox[6]);
		$tmp_bbox["height"] = max($bbox[1],$bbox[3],$bbox[5],$bbox[7]) - min($bbox[1],$bbox[3],$bbox[5],$bbox[7]);
		
		return $tmp_bbox;
}


function mb_wordwrap($txt,$font,$size,$width) 
{
		$pointer = 0;
		$this_line_start = 0;
		$this_line_strlen = 1;
		$single_byte_stack = "";
		$result_lines = array();
		while ($pointer <= mb_strlen($txt)) 
		{
				$this_char = mb_substr($txt,$pointer,1);
				$tmp_line = mb_substr($txt, $this_line_start, $this_line_strlen);
				$tmp_line_bbox = imagettfbbox($size,0,$font,$tmp_line);
				$this_line_width = $tmp_line_bbox[2]-$tmp_line_bbox[0];
				if ($this_line_width > $width) {
						// If last word is alphanumeric, put it to next line rather then cut it off
						if ($single_byte_stack != "") 
						{
								$stack_len = mb_strlen($single_byte_stack);
								$this_line_strlen -= $stack_len;
								$pointer -= $stack_len;
						}
						$result_lines[] = mb_substr($txt, $this_line_start, $this_line_strlen-1);
						$this_line_start = $pointer;
						$this_line_strlen = 1;
						$single_byte_stack = "";
				} 
				else 
				{
						// Prevent to cut off english word at the end of line
						// if this character is a alphanumeric character or open bracket, put it into stack
						if (
						(ord($this_char)>=48 && ord($this_char)<=57) ||
						(ord($this_char)>=65 && ord($this_char)<=91) ||
						(ord($this_char)>=97 && ord($this_char)<=123) ||
						ord($this_char)==40 ||
						ord($this_char)==60 ||
						($single_byte_stack=="" && (ord($this_char)==34 || ord($this_char)==39))
						) 
						{
								$single_byte_stack .= $this_char;
						}
						else
						{
								$single_byte_stack = ""; // Clear stack if met multibyte character and not line end
						}
						$this_line_strlen++;
						$pointer++;
				}
		}
		// Move remained word to result
		$result_lines[] = mb_substr($txt, $this_line_start);
		
		return $result_lines;
}


function imageprintWordWrapped(&$image, $top, $left, $right, $font, $color, $text, $textSize, $halign="left") 
{
		$maxWidth = $right - $left ;    //the trivial change
		$words = explode(' ', strip_tags($text)); // split the text into an array of single words
		$line = '';
		while (count($words) > 0) 
		{
				$dimensions = imagettfbbox($textSize, 0, $font, $line.' '.$words[0]);
				$lineWidth = $dimensions[2] - $dimensions[0]; // get the length of this line, if the word is to be included
				if ($lineWidth > $maxWidth) { // if this makes the text wider that anticipated
						$lines[] = $line; // add the line to the others
						$line = ''; // empty it (the word will be added outside the loop)
				}
				$line .= ' '.$words[0]; // add the word to the current sentence
				$words = array_slice($words, 1); // remove the word from the array
		}
		if ($line != '') 
		{ 
				$lines[] = $line; 
		} // add the last line to the others, if it isn't empty
		$lineHeight = $dimensions[1] - $dimensions[7] + 2; // the height of a single line
		$height = count($lines) * $lineHeight; // the height of all the lines total
		// do the actual printing
		$i = 0;
		//print_R($widths);
		foreach ($lines as $line) 
		{
				if($halign=="center") 
				{
						//figure out width of line
						$dimensions = imagettfbbox($textSize, 0, $font, $line);
						$lineWidth = $dimensions[2] - $dimensions[0];
						//figure out where the center is.
						$center=floor($maxWidth/2 + $left);
						$leftStart=$center-$lineWidth/2;
				}
				else if ($halign=="right")
				{
						//figure out width of line
						$dimensions = imagettfbbox($textSize, 0, $font, $line);
						$lineWidth = $dimensions[2] - $dimensions[0];
						$leftStart=$left+$maxWidth-$lineWidth;
				}
				else 
				{
						$leftStart=$left;
				} 
				imagettftext($image, $textSize, 0, $leftStart, $top + $lineHeight * $i, $color, $font, $line);
				$i++;
		}
		return $height;
}


?>
