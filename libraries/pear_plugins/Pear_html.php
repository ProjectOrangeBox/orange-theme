<?php

pear::attach('html_list',function($type='ul',$list=[],$attr=[],$indent='') {
		foreach ($list as $key => $value) {
			if (!is_array($value)) {
				$output .= $indent.chr(9).pear::html_tag('li', null, $value).PHP_EOL;
			} else {
				$output .= $indent.chr(9).pear::html_tag('li', null, pear::html_list($type,$value,null,$indent.chr(9).chr(9))).PHP_EOL;
			}
		}

		return $indent.html_tag($type, $attr, PHP_EOL.$output.$indent).PHP_EOL;
});

pear::attach('html_tag',function($tag,$attr=[],$content=false) 	{
	if (!empty($tag)) {
		/* list of void elements (tags that can not have content) */
		$void_elements = [
			/* html4 */
			"area","base","br","col","hr","img","input","link","meta","param",
			/* html5 */
			"command","embed","keygen","source","track","wbr",
			/* html5.1 */
			"menuitem",
		];

		/* construct the HTML */
		$html = '<'.$tag;
		$html .= (!empty($attr)) ? (is_array($attr) ? ci('page')->convert2attributes($attr) : ' '.$attr) : '';

		/* a void element? */
		if (in_array(strtolower($tag), $void_elements)) {
			/* these can not have content */
			$html .= ' />';
		} else {
			/* add the content and close the tag */
			$html .= '>'.$content.'</'.$tag.'>';
		}
	} else {
		$html = $content;
	}

	return $html;
}
