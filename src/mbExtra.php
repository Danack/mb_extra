<?php

// mb_string - the missing functions.
// all these functions are meant to be the mb_ equivalent of their non-multi-byte-safe versions.

function mb_ucfirst($string){
	return mb_convert_case($string, MB_CASE_UPPER);
}

function mb_ucwords($string){
	return mb_convert_case($string, MB_CASE_TITLE);
}

function mb_str_split($str, $l = 0) {
	if ($l > 0) {
		$ret = array();
		$len = mb_strlen($str, "UTF-8");
		for ($i = 0; $i < $len; $i += $l) {
			$ret[] = mb_substr($str, $i, $l, "UTF-8");
		}
		return $ret;
	}
	return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

function mb_strcasecmp($str1, $str2, $encoding = null) {
	if (null === $encoding) {
		$encoding = mb_internal_encoding();
	}

	return strcmp(mb_strtoupper($str1, $encoding), mb_strtoupper($str2, $encoding));
}

function mb_strrev($str){
	preg_match_all('/./us', $str, $ar);
	return join('',array_reverse($ar[0]));
}

//Taken from http://www.php.net/manual/en/function.substr-replace.php#90146
function mb_substr_replace($string, $replacement, $start, $length = null, $encoding = null)
{
	$string_length = (is_null($encoding) === true) ? mb_strlen($string) : mb_strlen($string, $encoding);

	if ($start < 0)
	{
		$start = max(0, $string_length + $start);
	}
	else if ($start > $string_length)
	{
		$start = $string_length;
	}

	if ($length < 0)
	{
		$length = max(0, $string_length - $start + $length);
	}
	else if ((is_null($length) === true) || ($length > $string_length))
	{
		$length = $string_length;
	}

	if (($start + $length) > $string_length)
	{
		$length = $string_length - $start;
	}

	if (is_null($encoding) === true)
	{
		return mb_substr($string, 0, $start) . $replacement . mb_substr($string, $start + $length, $string_length - $start - $length);
	}

	return mb_substr($string, 0, $start, $encoding) . $replacement . mb_substr($string, $start + $length, $string_length - $start - $length, $encoding);
}

function mb_wordwrap($string, $width=75, $break="\n", $cut=false)
{
	$width = intval($width); //Used in match - don't trust input

	if($cut) {
		// Match anything 1 to $width chars long followed by whitespace or EOS,
		// otherwise match anything $width chars long
		$search = '/(.{1,'.$width.'})(?:\s|$)|(.{'.$width.'})/uS';
		$replace = '$1$2'.$break;
	} else {
		// Anchor the beginning of the pattern with a lookahead
		// to avoid crazy backtracking when words are longer than $width
		$pattern = '/(?=\s)(.{1,'.$width.'})(?:\s|$)/uS';
		$replace = '$1'.$break;
	}
	return preg_replace($search, $replace, $string);
}



?>