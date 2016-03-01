<?php

// count words
function words(ContentIterator $content) {
	$text = strip_tags($content->html);

	return count(preg_split('#\s+#', $text));
}

// from wiki
function ordinal($num) {
	$ends = ['th','st','nd','rd','th','th','th','th','th','th'];

	if (($num % 100) >= 11 && ($num % 100) <= 13) {
		return $num . 'th';
	}

	return $num . $ends[$num % 10];
}

// nth article
function nth(ContentIterator $content) {
	global $app;

	return $app['posts']->where('status', '=', 'published')->where('created', '<', $content->created)->count() + 1;
}

// fallback to first valid argument
function fallback() {
	foreach(func_get_args() as $arg) {
		if($arg or is_array($arg)) return $arg;
	}

	return false;
}