$(document).ready(function(){
    //******************************************
    // custom select param
    var _dropMenuHeight = 200;
    var _maxVisibleItemsInMenu = 10;
    var _stepSliceItems = 60;

    var $selects = $('select');
    var _needHiddenAll = false;

    //******************************************
    // create custom selects
    createSelects();
    function createSelects(){
        $(document.body).click(function(){
            if (_needHiddenAll) hiddenAllSelectsMenu(); else _needHiddenAll = true;
        });
        for (var i=0; i<$selects.length; i++) createMenu($selects[i]);
    }


    function createMenu(_obj) {
        var _itemsNumber = $(_obj).children('option').size();
        var _selectMenu = '';

        var _selectedVal = $(_obj).val();

        for (var i=0; i<_itemsNumber; i++){
            var _li = $(_obj).children('option').eq(i);
            _selectMenu += '<li'+((_selectedVal==_li.val()) ? ' class="current">' : '>')+'<a href="#" rel="'+_li.val()+'">'+_li.html()+'</a></li>';
        }

        if (_itemsNumber <= _maxVisibleItemsInMenu) {
            _selectMenu = 	'<div class="select_box"> \
								<span class="visible_selected"><span>'+$(_obj).children('option:selected').html()+'</span><i><!-- shadow --></i></span> \
								<div class="options_box" style="display: none;" > \
									<ul>'+_selectMenu+'</ul> \
								</div> \
							</div>';
        } else {
            _selectMenu =	'<div class="select_box"> \
								<span class="visible_selected"><span>'+$(_obj).children('option:selected').html()+'</span><i><!-- shadow --></i></span> \
								<div class="options_box" style="height: '+_dropMenuHeight+'px; display: none;" > \
									<ul style="position: absolute; top: 0; left: 0; width: 100%">'+_selectMenu+'</ul> \
									<div class="options_scroll"> \
										<a href="#" class="arrow_top"></a> \
										<a href="#" class="arrow_bottom"></a> \
										<div class="sniper_box"> \
											<a href="#" class="sniper"><span><span></span></span></a> \
										</div> \
									</div> \
								</div> \
							</div>';
        }

        $(_obj).parent().append(_selectMenu);
        $(_obj).css('display', 'none');
        setScrollParam($(_obj).parent().find('.select_box'));
        setOpenEvent($(_obj).parent().find('.select_box .visible_selected'));
    }

    function setScrollParam(_obj) {

        if (!$(_obj).find('.options_box .options_scroll').length) return false;

        var _heigh = _dropMenuHeight - $(_obj).find('.options_box .options_scroll .arrow_top').height() - $(_obj).find('.options_box .options_scroll .arrow_bottom').height();

        $(_obj).find('.options_box .options_scroll .sniper_box').css('top', $(_obj).find('.options_box .options_scroll .arrow_top').height()+'px');
        $(_obj).find('.options_box .options_scroll .sniper_box').css('height', _heigh+'px');
        $(_obj).find('.options_box .options_scroll .sniper_box .sniper').css('height', (_heigh/$(_obj).find('.options_box ul li').size()*_maxVisibleItemsInMenu)+'px');

        $(_obj).find('.options_box .options_scroll .sniper_box .sniper').draggable({
            containment: 'parent',
            drag: function(e, ui) {
                $(e.target).parent().parent().parent().find('ul').css('top', calcOptionsListPosition($(e.target), ui.position.top)+'px');
            },
            stop: function(e, ui) {
                $(e.target).parent().parent().parent().find('ul').css('top', calcOptionsListPosition($(e.target), ui.position.top)+'px');
            }
        });

        setMouseScroll($(_obj).find('.options_box'));
    }


    // parse 'px'
    function getNumber (num) {return Number(num.slice(0, num.search('px')));}


    //******************************************
    // events custom selected

    $('.select_box ul li').click(function(e) {
        $(this).parent().parent().parent().find('span.visible_selected span').html($(this).find('a').html());
        $(this).parent().children('li').removeClass('current');
        $(this).addClass('current');
        $(this).parent().parent().parent().toggleClass('select_open');
        $(this).parent().parent().parent().parent().parent("basket-select").toggleClass('select_open');
        $(this).parent().parent().parent().parent().find('select').val($(this).find('a').attr('rel'));
        $(this).parent().parent().parent().parent().find('select').change();
        return false;
    });

    function setOpenEvent(_obj) {
        $(_obj).click(function(e) {
            var _val = $(this).parent().is('.select_open');

            hiddenAllSelectsMenu();
            $(this).parent().addClass('select_open');

            if (_val) {
                $(this).parent().removeClass('select_open');
                _needHiddenAll = true;
            } else {
                _needHiddenAll = false;
            }
        });
    }

    function hiddenAllSelectsMenu() {
        for (var i=0; i<$selects.length; i++) {
            var _tObj = $selects[i];
            $(_tObj).parent().find('.select_open').removeClass('select_open');
        }
    }

    $('.options_box .arrow_top').click(function(e){
        scrollToSelectMenu($(this).parent().parent(), 'top');
        return false;
    });

    $('.options_box .arrow_bottom').click(function(e){
        scrollToSelectMenu($(this).parent().parent(), 'bottom');
        return false;
    });

    function setMouseScroll(_obj) {
        $(_obj).mousewheel(function (e, delta) {
            scrollToSelectMenu($('.select_open .options_box'), (delta>0) ? 'top' : 'bottom');
            e.preventDefault();
        });
    }

    function scrollToSelectMenu(obj, arrow) {
        var _menuObj = $(obj).find('ul');
        var _menuSniperObj = $(obj).find('.options_scroll');

        var _top = getNumber($(_menuObj).css('top'));
        var _height = $(obj).find('ul').height();

        if (arrow == 'top') {
            if (_top+_stepSliceItems >= 0) {
                scrollToSelectMenuIn(_menuObj, _menuSniperObj, 0);
            } else {
                scrollToSelectMenuIn(_menuObj, _menuSniperObj, _top+_stepSliceItems);
            }
        } else if (arrow == 'bottom') {
            if (_height+_top-_stepSliceItems <= _dropMenuHeight) {
                scrollToSelectMenuIn(_menuObj, _menuSniperObj, _dropMenuHeight-_height);
            } else {
                scrollToSelectMenuIn(_menuObj, _menuSniperObj, _top-_stepSliceItems);
            }
        }
    }

    function scrollToSelectMenuIn(_menuObj, _menuSniperObj, _top) {
        _menuObj.css('top', _top+'px');

        var _ratio = ($(_menuSniperObj).find('.sniper_box').height()-$(_menuSniperObj).find('.sniper_box .sniper').height())/($(_menuObj).height()-_dropMenuHeight);
        $(_menuSniperObj).find('.sniper_box .sniper').css('top', (_ratio*_top*-1)+'px');
    }

    function calcOptionsListPosition(_obj, _top) {
        var _scrollBox = $(_obj).parent().parent().parent();
        var _ratio = ($(_scrollBox).find('ul').height()-_dropMenuHeight)/($(_scrollBox).find('.sniper_box').height()-$(_scrollBox).find('.sniper_box .sniper').height());

        return _top*_ratio*-1;
    }

});