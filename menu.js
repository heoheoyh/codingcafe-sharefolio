function openLayer(targetID, options) {
	var $layer = $('#' + targetID);
	var $close = $layer.find('.close');
	var width = $layer.outerWidth();
	var ypos = options.top;
	var xpos = options.left;
	var marginLeft = 0;  //레이어를 팝업시키기 위한 변수들

	if (xpos == undefined) {
		xpos = '50%';
		marginLeft = -(width / 2);
	}  //왼쪽에서부터 x축이 undefinded일때, 전체 50%로 지정한다 

	if (!$layer.is(':visible')) {
		$layer.css({
			'top' : ypos + 'px',
			'left' : xpos,
			'margin-left' : marginLeft
		}).slideDown();
	} // 레이어의 css를 지정 그리고 팝업되었을시 slideDown하여 보이게끔 한다. 

	$close.bind('click', function() {
		if ($layer.is(':visible')) {
			$layer.hide();
		}
		return false;
	});//팝업된 레이어를 클릭하면 레이어가 hide하게한다.
}