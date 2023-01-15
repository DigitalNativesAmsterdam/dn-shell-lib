<?php

define('GREEN', "\e[32m"); 
define('WHITE', "\e[97m");
define('COLOR_RESET', "\e[0m");

define('CLEAR', chr(27).chr(91).'H'.chr(27).chr(91).'J');

define('LOGO', <<<END
     .n.           .D.         
  nnnnnnnnnn.  DDDDDDDDD     \e[32m       ___       _ __        __               __  _                         
DnnnnnnnnnnDDDDDDDDDDDDDDD   \e[32m  ____/ (_)___ _(_) /_____ _/ /  ____  ____ _/ /_(_)   _____  _____            
DDDDnnnnDDDDDDDDDDDDDDDDDD   \e[32m / __  / / __ `/ / __/ __ `/ /  / __ \/ __ `/ __/ / | / / _ \/ ___/           
DDDDDDDDDDDDDDDDDDD/n\DDDD   \e[32m/ /_/ / / /_/ / / /_/ /_/ / /  / / / / /_/ / /_/ /| |/ /  __(__  )            
DDDDDDDDDDDDDDDnnnnnnnnnDD   \e[32m\__,_/_/\__, /_/\__/\__,_/_/  /_/ /_/\__,_/\__/_/ |___/\___/____/             
 DDDDDDDDDDD.  nnnnnnnnn     \e[32m       /____/                                                                    
     "D"           "n"                 
END);

function colorize($logo) {
	$logo = preg_replace('/D+/i', WHITE . '$0', $logo);
	$logo = preg_replace('/\"?\.?n+\.?\"?/i', GREEN . '$0' . WHITE, $logo);
	return $logo;
}

function replaceInColumnRange($string, $startColumn, $endColumn, $charToReplace, $replacementChar) {
    $lines = explode("\n", $string);
    for ($i = 0; $i < count($lines); $i++) {
        for ($j = $startColumn; $j <= $endColumn; $j++) {
            if ($lines[$i][$j] == $charToReplace) {
                $lines[$i] = substr_replace($lines[$i], $replacementChar, $j, 1);
            }
        }
    }
    return implode("\n", $lines);
}

function logo_animate($start=0, $end=0, $replace = "", $replace_start=0, $replace_end=100) {
	$lines = explode("\n",LOGO);
	$result = "";
	foreach ($lines as $line) {
		$result .= substr($line, $start, $end) . "\n"; 
	}

	$result = @replaceInColumnRange($result, $replace_start, $replace_end, $replace, " ");

	return $result;
}

function logo_spin($variant = 0) {
	$sleep = 1;
	$steps1 = str_split('-=-=-=-=', 1);
	$steps2 = mb_str_split("⣾⣽⣻⢿⡿⣟⣯⣷", 1);

	for ($i=0; $i < 8; $i++) {
		echo CLEAR;
		$output = str_replace("D", WHITE . $steps2[$i] . GREEN, LOGO);
		echo str_replace("nddd", GREEN . $steps1[$i], $output);
		sleep(1);
	}


}

function run() {

	$speed = 5000;

	for ($i=0;$i<60;$i++) {
		echo CLEAR;
		echo colorize(logo_animate(0, $i, "n", 0, 110));
		usleep($speed);
		
	}

	for ($i=60;$i>=0;$i--) {
		echo CLEAR;
		echo $result = colorize(logo_animate(0, 110, "n", 0, $i));
		usleep($speed);
		
	}

	//sleep(3);

	//logo_spin($result);

}

run();
echo COLOR_RESET;
