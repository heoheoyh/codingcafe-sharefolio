/* 상단에 네비를 고정시키기 위한 제이쿼리 함수입니다*/

$(document).ready(function() {
	var navTop = $('.mastnav').offset().top; /*먼저 네비의 top위치값을 지정하고 */
	var scrollAreaTop = $('#scroll').offset().top; /* 이것은 스크롤의 영역을 고정시키기 위해 top위치값 지정*/

	var fixNav = function(scrollTop) {
		if (scrollTop > navTop) { /* 스크롤을 내렸을시 네비가 상단에 닫는 순간 -> 네비의 탑이 0이 됨*/
			$('.mastnav').addClass('fixed'); /* 이 때 네비를 고정시켜주는 클래스를 추가한다. */
			var height = $('.mastnav').css('height'); /* 이것은 fixed되었을 시 아래  컨텐트 영역들이 자연스럽게 위로 올라갈 수 있도록 css를 추가함*/
			$('.section-cont').css('margin-top', height); /* 만약 이것을 설정을 하지 않는다면 네비가 fixed되는 순간 section-cont영역이 위로 확 달라붙어서 올라감*/
			$('.fixcat').slideDown(200); /* 고냥이가 슬라이드 다운 해서 내려옴*/

		} else {
			$('.mastnav').removeClass('fixed'); /* 네비가 상단에 닫지 않을 때 fixed클래스를 제거함 */
			$('.section-cont').css('margin-top', 0);
			$('.fixcat').hide(); /* 고냥이도 함께 제거*/

		}
	};

	var fixScroll = function(scrollTop) { /*스크롤영역이 fixed되는 부분입니다*/
		if (scrollTop+$('.mastnav').height() > scrollAreaTop && scrollTop <= 9000) {
			$('#scroll').addClass('fixed');/* 스크롤 영역을 9000px으로 잡고 이것이 상단에 닿는 순간 스크롤 영역부터 9000px동안 fixed 클래스를 추가함 */ 
		} else {
			$('#scroll').removeClass('fixed');
		}
	};
	
	var returnScroll = function(scrollTop) {
		if(scrollTop > 9000) {  /* 9000이상이 되면 메뉴와 룸 영역을 스크롤로 다시 만들어줌 */
			$('#scroll').css('display', 'none');
		} else {
			$('#scroll').css('display', 'block');
		}
	};

    var adjustScrollHref = function() { /* 이 부분은 스크롤을 한뒤 갑자기 네비의 guide animation이 클릭이 안되어 방편으로 만듬*/
        var initTop = $('#scroll').offset().top;
        $('.guide-nav').on('click', function(e) { 
            e.preventDefault(); /* preventDefault는 a 태그 처럼 클릭 이벤트 외에 별도의 브라우저 행동을 막기 위해 사용*/
            $('html, body').scrollTop(initTop);
        });
    };
    adjustScrollHref();

	$(window).scroll(function() { /*함수 실행*/
		var scrollTop = $(window).scrollTop();
		fixNav(scrollTop);
		fixScroll(scrollTop);
		returnScroll(scrollTop);
	});
	
});
