<?php

pear::attach('e',function($string) {
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
});
