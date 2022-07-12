function SubStrChar($input,$len) {
	return substr($input,0,$len).( strlen($input) > $len ? '...' : '' );
}