<?php
function trim_length($text, $maxLength, $trimIndicator = '...')
{
	if(strlen($text) > $maxLength) {
		
		$shownLength = $maxLength - strlen($trimIndicator);
		
		if ($shownLength < 1) {
			
			throw new \InvalidArgumentException('Second argument for ' . __METHOD__ . '() is too small.');
		}
		
		preg_match('/^(.{0,' . ($shownLength - 1) . '}\w\b)/su', $text, $matches);
		
		return (isset($matches[1]) ? $matches[1] : substr($text, 0, $shownLength)) . $trimIndicator ;
	}
	
	return $text;
}