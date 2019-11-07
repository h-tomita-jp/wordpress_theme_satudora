<?php

$script = <<< EOF
<script type="text/javascript">

var shop_select2 = {};
{$shop_select2}

var shop_select3 = {};
{$shop_select3}

$(document).on('change', '.shop_select select', function() {

	var p = $(this).closest('div');
	$('~ *', p).remove();

	if(!$(this).val()) return false;

	if($(this).attr('name') == 'shop01') {
		var my_name = $('option:selected', this).attr('value')
		var html = '';
		html += '<div>';
		html += '<select name="shop02">';
		html += '<option value="">市町村を選択してください</option>';
		html += shop_select2[my_name];
		html += '</select>';
		html += '</div>';

		$('.shop_select').append(html);
	} else if($(this).attr('name') == 'shop02') {
		var my_name = $('option:selected', this).attr('value')
		var html = '';
		html += '<div>';
		html += '<select name="shop03">';
		html += '<option value="">店舗を選択してください</option>';
		shop_select3[my_name].forEach(function( value ) {
			html += '<option value="' + value + '">' + value + '</option>';
		});
		html += '</select>';
		html += '</div>';

		$('.shop_select').append(html);
	}
})
if($('#shopPost').attr('data-shop01')) {
	var s01 = $('#shopPost').attr('data-shop01');
	if($('select[name=shop01] option[value=' + s01 + ']').length) {
		$('select[name=shop01]').val(s01).trigger('change');

		if($('#shopPost').attr('data-shop02')) {
			var s02 = $('#shopPost').attr('data-shop02');
			if($('select[name=shop02] option[value=' + s02 + ']').length) {
				$('select[name=shop02]').val(s02).trigger('change');

				if($('#shopPost').attr('data-shop03')) {
					var s03 = $('#shopPost').attr('data-shop03');
					if($('select[name=shop03] option[value=' + s03 + ']').length) {
						$('select[name=shop03]').val(s03);
					}
				}
			}
		}
	}
}

function createOptionForBirthday(num,parentId){
	function createOptionElements(num,parentId){
	    var doc = document.createElement('option');
	    doc.value = doc.innerHTML = num;
	    document.getElementById(parentId).appendChild(doc);
	}
	var time = new Date();
	var year = time.getFullYear();
	createOptionElements("----",'birth_y');
	for (var i = year; i >= 1900; i--) {
	  createOptionElements(i,'birth_y');
	}
	createOptionElements("--",'birth_m');
	for (var i = 1; i <= 12; i++) {
	  createOptionElements(i,'birth_m');
	}
	createOptionElements("--",'birth_d');
	for (var i = 1; i <= 31; i++) {
	  createOptionElements(i,'birth_d');
	}
}

function createSelectBox(){
  //連想配列の配列
  var arr = [
    {val:"",     txt:"地域を選択してください"},
	{$shop_select1}
  ];
 
  //連想配列をループ処理で値を取り出してセレクトボックスにセットする
  for(var i=0;i<arr.length;i++){
    let op = document.createElement("option");
    op.value = arr[i].val;  //value値
    op.text = arr[i].txt;   //テキスト値
    document.getElementById("shop01").appendChild(op);
  }
};

function setShopName(){
	document.getElementsByClassName('shop_select')[0].getElementsByTagName("div")[0].firstChild.data
		= document.getElementsByName("shop03")[0].value;
}

window.onload = function() {
	if( document.getElementById('birth_y') ){
		createOptionForBirthday();
	}
	if( document.getElementById('shop01') ){
		createSelectBox();
	}else{
		setShopName();
	}
}

</script>
EOF;

echo $script;

?>