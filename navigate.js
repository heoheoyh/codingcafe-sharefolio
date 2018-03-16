/* ��ܿ� �׺� ������Ű�� ���� �������� �Լ��Դϴ�*/

$(document).ready(function() {
	var navTop = $('.mastnav').offset().top; /*���� �׺��� top��ġ���� �����ϰ� */
	var scrollAreaTop = $('#scroll').offset().top; /* �̰��� ��ũ���� ������ ������Ű�� ���� top��ġ�� ����*/

	var fixNav = function(scrollTop) {
		if (scrollTop > navTop) { /* ��ũ���� �������� �׺� ��ܿ� �ݴ� ���� -> �׺��� ž�� 0�� ��*/
			$('.mastnav').addClass('fixed'); /* �� �� �׺� ���������ִ� Ŭ������ �߰��Ѵ�. */
			var height = $('.mastnav').css('height'); /* �̰��� fixed�Ǿ��� �� �Ʒ�  ����Ʈ �������� �ڿ������� ���� �ö� �� �ֵ��� css�� �߰���*/
			$('.section-cont').css('margin-top', height); /* ���� �̰��� ������ ���� �ʴ´ٸ� �׺� fixed�Ǵ� ���� section-cont������ ���� Ȯ �޶�پ �ö�*/
			$('.fixcat').slideDown(200); /* ����̰� �����̵� �ٿ� �ؼ� ������*/

		} else {
			$('.mastnav').removeClass('fixed'); /* �׺� ��ܿ� ���� ���� �� fixedŬ������ ������ */
			$('.section-cont').css('margin-top', 0);
			$('.fixcat').hide(); /* ����̵� �Բ� ����*/

		}
	};

	var fixScroll = function(scrollTop) { /*��ũ�ѿ����� fixed�Ǵ� �κ��Դϴ�*/
		if (scrollTop+$('.mastnav').height() > scrollAreaTop && scrollTop <= 9000) {
			$('#scroll').addClass('fixed');/* ��ũ�� ������ 9000px���� ��� �̰��� ��ܿ� ��� ���� ��ũ�� �������� 9000px���� fixed Ŭ������ �߰��� */ 
		} else {
			$('#scroll').removeClass('fixed');
		}
	};
	
	var returnScroll = function(scrollTop) {
		if(scrollTop > 9000) {  /* 9000�̻��� �Ǹ� �޴��� �� ������ ��ũ�ѷ� �ٽ� ������� */
			$('#scroll').css('display', 'none');
		} else {
			$('#scroll').css('display', 'block');
		}
	};

    var adjustScrollHref = function() { /* �� �κ��� ��ũ���� �ѵ� ���ڱ� �׺��� guide animation�� Ŭ���� �ȵǾ� �������� ����*/
        var initTop = $('#scroll').offset().top;
        $('.guide-nav').on('click', function(e) { 
            e.preventDefault(); /* preventDefault�� a �±� ó�� Ŭ�� �̺�Ʈ �ܿ� ������ ������ �ൿ�� ���� ���� ���*/
            $('html, body').scrollTop(initTop);
        });
    };
    adjustScrollHref();

	$(window).scroll(function() { /*�Լ� ����*/
		var scrollTop = $(window).scrollTop();
		fixNav(scrollTop);
		fixScroll(scrollTop);
		returnScroll(scrollTop);
	});
	
});
