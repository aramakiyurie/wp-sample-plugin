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

		$html  = '<form method="post" action="">';
		$html .='<input type="hidden" name="sample_id" value="">';

		$html .='<h2>バナー設定</h2>';
		$html .='<table>';

		$html .='<tr>';
		$html .='<th>画像のURL（必須）</th>';
		$html .='<td>';
		$html .='<img src="' . plugins_url('../images/no-image.png', __FILE__ ) . '" width="200"' . '>';
		$html .='<input type="text">';
		$html .='<button>画像を選択</button>';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>画像Alt属性（必須）</th>';
		$html .='<td>';
		$html .='<input type="text">alt属性のテキストを入力します。';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>リンクURL</th>';
		$html .='<td>';
		$html .='<input type="text">URLを入力すると、バナー画像にリンクを設定することができます。';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>新規タブで開く</th>';
		$html .='<td>';
		$html .='<input type="checkbox">リンクを新規タブで開く';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>Class名</th>';
		$html .='<td>';
		$html .='<input type="text">バナー画像にクラス（複数可）を追加することができます。「class=""」は不要です。
		<br>複数設定する場合は、半角スペースで区切ります。';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>ID名</th>';
		$html .='<td>';
		$html .='<input type="text">バナー画像にIDを追加することができます。「id=""」は不要です。';
		$html .='</td>';
		$html .='</tr>';
		$html .='</table>';

		$html .='<h2>表示設定</h2>';
		$html .='<table>';
		$html .='<tr>';
		$html .='<th>表示設定（必須）</th>';
		$html .='<td>';
		$html .='<input type="radio">記事の下に表示';
		$html .='<input type="radio">ショートコードで表示';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>絞り込み</th>';
		$html .='<td>';
		$html .='<input type="checkbox">カテゴリーで絞り込み';
		$html .='チェックされていない場合は、すべて無条件に表示され、「表示するカテゴリ」項目の設定は無視されます';
		$html .='</td>';
		$html .='</tr>';

		$html .='<tr>';
		$html .='<th>表示するカテゴリ（必須）</th>';
		$html .='<td>';
		$html .='<input type="checkbox">カテゴリーで絞り込み';
		$html .='選択したカテゴリーが投稿に紐づいている場合のみ画像が表示されます。';
		$html .='</td>';
		$html .='</tr>';

		$html .='</table>';

		$html .= '</form>';

		echo $html;
	}


}
