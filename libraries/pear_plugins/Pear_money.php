<?php

pear::attach('money',function($number) {
	return money_format('$%i',$number);
});
