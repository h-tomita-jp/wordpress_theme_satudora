$(function() {
	$('*[data-area]').on({
		'mouseenter': function() {
			if($('*[data-area=' + $(this).attr('data-area') + '].has_area').length) {
				$('*[data-area=' + $(this).attr('data-area') + ']').addClass('hover');
			}
		},
		'mouseleave': function() {
			$('*[data-area=' + $(this).attr('data-area') + ']').removeClass('hover');
		},
		'click': function() {
			if($('*[data-area=' + $(this).attr('data-area') + '].has_area').length) {
				$('*[data-area]').removeClass('active');
				$('*[data-area=' + $(this).attr('data-area') + ']').addClass('active');

				$('.search_main .area > *').removeClass('show');
				$('.search_main .area ul[data-area-list=' + ($('*[data-area=' + $(this).attr('data-area') + '].has_area').text()) + ']').addClass('show');

			}
			return false;
		}
	});

	if($('*[data-area].active').length) {
		$('*[data-area].active').trigger('click');
	}


	$('.search_narrow .title a').on('click', function() {
		var ele = $('.search_narrow form');
		if(!ele.is(':animated')) {
			$(this).toggleClass('open');
			ele.slideToggle(400);
		}
		return false;
	})

	$('.search_main .search .select .sp_area_select').on('change', function() {
		var v = $(this).val();

		$('.search_main .search .select .sp_area_area').prop('disabled', true).removeClass('show').addClass('hide');
		if(v) {
			$('.search_main .search .select .sp_area_area[data-sp-select=' + v + ']').prop('disabled', false).removeClass('hide').addClass('show');
		} else {
			$('.search_main .search .select .sp_area_area').eq(0).val('').removeClass('hide').addClass('show');
		}

		return false;
	})



	$('.search_main .location a').on('click', function() {
		var href = $(this).attr('href');
		if(navigator.geolocation) {
			// 現在地を取得
			navigator.geolocation.getCurrentPosition(
				// [第1引数] 取得に成功した場合の関数
				function(position) {
					// 取得したデータの整理
					var data = position.coords;

					// データの整理
					var lat = data.latitude;
					var lng = data.longitude;
					var alt = data.altitude;
					var accLatlng = data.accuracy;
					var accAlt = data.altitudeAccuracy;
					var heading = data.heading;
					var speed = data.speed;

					// 移動
					location.href = href + '?lat=' + lat + '&lng=' + lng;
				},


				// [第2引数] 取得に失敗した場合の関数
				function( error ) {
					// エラーコード(error.code)の番号
					// 0:UNKNOWN_ERROR				原因不明のエラー
					// 1:PERMISSION_DENIED			利用者が位置情報の取得を許可しなかった
					// 2:POSITION_UNAVAILABLE		電波状況などで位置情報が取得できなかった
					// 3:TIMEOUT					位置情報の取得に時間がかかり過ぎた…

					// エラー番号に対応したメッセージ
					var errorInfo = [
						"原因不明のエラーです\n再度ボタンを押してください" ,
						"GPS設定をONにしてください",
						"電波状況などで位置情報が取得することができませんでした",
						"タイムアウトしました\n再度ボタンを押してください"
					] ;

					// エラー番号
					var errorNo = error.code ;

					// エラーメッセージ
					var errorMessage = errorInfo[errorNo];

					// アラート表示
					alert(errorMessage);

					return false;
				},

				// [第3引数] オプション
				{
					"enableHighAccuracy": true,
					"timeout": 10000,
					"maximumAge": 2000,
				}
			);
		}

		else {
			alert("ご使用の端末では、現在置を取得できません。");
		}
		return false;
	})


	$('.wp-pagenavi a').each( function() {
		$(this).attr('href', $(this).attr('href') + '#result');
	})

});
