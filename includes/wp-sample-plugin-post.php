<?php

/**
* Class Post Page
*
*@author Yurie Aramaki
*@version 1.0.0
*@since   1.0.0
*/
class Sample_Plugin_Post {
	/**
	*Constructer
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function __construct() {
		$this->page_render();
	}

	/**
	*Rendaring Page
	*
	*@version 1.0.0
	*@since   1.0.0
	*/
	private function page_render() {
		$html  ='<div class="wrap">';
		$html .='<h1 class="wp-heading-inline">サンプル登録</h1>';

		$html .='</div>';

		echo $html;
	}



}
