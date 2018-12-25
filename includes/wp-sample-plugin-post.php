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
		$db = new Sample_Plugin_Admin_Db();

		$options = array(
			'id'                   => '',
			'image_url'            => '',
			'image_alt'            => '',
			'link_url'             => '',
			'open_new_tab'         => 0,
			'insert_element_class' => '',
			'insert_element_id'    => '',
			'how_display'          => 'post_bottom',
			'filter_category'      => '',
			'category_id'          => 0
		);

		if ( isset( $_GET['id'] ) && is_numeric( $_GET['id'] ) ){
			$options['id'] = $_GET['id'];
		}


		if ( isset( $POST['sample_id'] ) && is_numeric( $POST['sample_id'] ) ){
			$db->update_options( $_POST );
			$options['id'] = $_POST['sample_id'];
		}else{
			if ( isset( $_POST['sample_id'] ) && $_POST['sample_id'] === '' ){
				$options['id'] = $db->insert_options( $_POST );
			}
		}
		$args = $db->get_options( $options['id'] );
		$options = array_merge( $options, $args );



		$this->page_render( $options );
	}

	/**
	*Rendaring Page
	*
	*@version 1.0.0
	*@since   1.0.0
	*@param   array 1.0.0
	*/
	private function page_render( $args ) {
		$html  ='<div class="wrap">';
		$html .='<h1 class="wp-heading-inline">サンプル登録</h1>';


		echo $html;

		$html  = '<form method="post" action="">';
		$html .='<input type="hidden" name="sample_id" value="' . $args['id'] . '">';

		$html .='<h2>バナー設定</h2>';
		$html .='<table class="form-table">';

		$html .='<tr>';
		$html .='<th>画像のURL（必須）</th>';
		$html .='<td>';

		if ( isset( $args['image_url'] ) ) {
			$image_src = $args['image_url'];
		}else{
			$image_src = plugins_url('../images/no-image.png', __FILE__ );
		}

		$html .='<img id="banner-image-view" src=' . $image_src . ' width="200">';
		$html .='<input id="banner-image-url" type="text" class="large-text" name="sample-image-url" required value="' . $args['image_url'] . '" >';
		$html .='<button id="media-upload" class="button">画像を選択</button>';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>画像Alt属性</th>';
		$html .='<td>';

		$html .='<input id="banner-image-alt" type="text" class="regular-text" name="sample-image-alt" value="' . $args['image_alt'] . '">
		<p class="description">alt属性のテキストを入力します。</p>';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>リンクURL</th>';
		$html .='<td>';
		$html .='<input type="text" class="large-text" name="sample-image-link" value="' . $args['link_url'] . '">';
		$html .='<p class="description">URLを入力すると、バナー画像にリンクを設定することができます。</p>';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>新規タブで開く</th>';

		if ( $args['open_new_tab'] === "1" ) {
			$open_new_tab_checked = ' checked';
		}else{
			$open_new_tab_checked = '';
		}
		$html .='<td>';
		$html .='<input type="checkbox" name="sample-image-target" value="1" ' . $open_new_tab_checked . '>';
		$html .='リンクを新規タブで開く';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>Class名</th>';
		$html .='<td>';
		$html .='<input type="text" class="large-text"  name="sample-element-class" value="' . $args['insert_element_class'] . '">';
		$html .='<p class="description">バナー画像にクラス（複数可）を追加することができます。「class=""」は不要です。
		<br>複数設定する場合は、半角スペースで区切ります。';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>ID名</th>';
		$html .='<td>';
		$html .='<input type="text" class="large-text" name="sample-element-id" value="' . $args['insert_element_id'] . '">';
		$html .='<p class="description">バナー画像にIDを追加することができます。「id=""」は不要です。';
		$html .='</td>';
		$html .='</tr>';
		$html .='</table>';

		$html .='<h2>表示設定</h2>';
		$html .='<table class="form-table">';
		$html .='<tr>';
		$html .='<th>表示方法（必須）</th>';
		$html .='<td>';

		$how_display_checked = array('','');
		switch ($args['how_display']) {
			case 'post_bottom':
				$how_display_checked[0] = ' checked';
				break;
			case 'shortcode':
				$how_display_checked[1] = ' checked';
				break;
			default:
				break;
		}

		$html .='<input type="radio" name="sample-how-display"　value ="post_bottom" ' . $how_display_checked[0] . '>記事の下に表示<br>';
		$html .='<input type="radio" name="sample-how-display" value ="shortcode" ' . $how_display_checked[1] . '>ショートコードで表示';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>絞り込み</th>';
		$html .='<td>';

		if ( $args['open_new_tab'] === "1" ) {
			$filter_category_checked = ' checked';
		}else{
			$filter_category_checked = '';
		}

		$html .='<input type="checkbox" name="sample-filter-category" value="1" ' . $open_new_tab_checked . '>';
		$html .='カテゴリーで絞り込み';
		$html .='<p class="description">チェックされていない場合は、すべて無条件に表示され、「表示するカテゴリ」項目の設定は無視されます';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>表示するカテゴリ（必須）</th>';
		$html .='<td>';

		echo $html;

		$param = array(
			'name' => 'sample-display-category',
			'hierarchical' => 1,
			'selected' => $args['category_id']
		);
		wp_dropdown_categories( $param );

		$html  ='<p class="description">選択したカテゴリーが投稿に紐づいている場合のみ画像が表示されます。';
		$html .='</td>';
		$html .='</tr>';

		$html .='</table>';

		echo $html;

		submit_button();

		$html  = '</form>';
		$html .='</div>';

		echo $html;

		require_once( plugin_dir_path( __FILE__ ) . 'wp-sample-plugin-upload.php' );
	}



}
