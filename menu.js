function openLayer(targetID, options) {
	var $layer = $('#' + targetID);
	var $close = $layer.find('.close');
	var width = $layer.outerWidth();
	var ypos = options.top;
	var xpos = options.left;
	var marginLeft = 0;  //���̾ �˾���Ű�� ���� ������

	if (xpos == undefined) {
		xpos = '50%';
		marginLeft = -(width / 2);
	}  //���ʿ������� x���� undefinded�϶�, ��ü 50%�� �����Ѵ� 

	if (!$layer.is(':visible')) {
		$layer.css({
			'top' : ypos + 'px',
			'left' : xpos,
			'margin-left' : marginLeft
		}).slideDown();
	} // ���̾��� css�� ���� �׸��� �˾��Ǿ����� slideDown�Ͽ� ���̰Բ� �Ѵ�. 

	$close.bind('click', function() {
		if ($layer.is(':visible')) {
			$layer.hide();
		}
		return false;
	});//�˾��� ���̾ Ŭ���ϸ� ���̾ hide�ϰ��Ѵ�.
}