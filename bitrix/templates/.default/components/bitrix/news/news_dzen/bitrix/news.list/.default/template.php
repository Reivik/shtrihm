<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$news_counter = 0; //порядковый номер новости
$news_in_block = 0; //номер нововсти в блоке из 6 штук
$first_block = 1; //первый блок
$second_block = 0; //второй блок

function HexToRgba($hex, $alpha = false) {
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		$rgb = $r . ', ' . $g . ', ' . $b . ', ';
		if ($alpha !== false) $a = $alpha;
		else $a = 1;
		$rgb .= $a;
		return $rgb;
}

	function RandColor() {
		$colors = array("#495678", "#79d6cd", "#6c92ea", "#56575e", "#e68f5a", "#dd2d1a", "#c6a79d", "#c6e5a5", "#dddcd9");
		return $colors[array_rand($colors)];
	}

?>

<div class="news_row">
<?

	foreach($arResult["ITEMS"] as $arItem):

	$news_counter++;
    $news_in_block++;
    if ($news_in_block > 6) {
        $news_in_block = 1;
        if ($first_block == 1) {
            $first_block = 0;
            $second_block = 1;
        }else{
            $first_block = 1;
            $second_block = 0;
        }
    }
    if ($news_in_block == 1) {
        $news_class = ' full_item';
        $margin_class = '';
        if ($first_block == 1) {
            $color_class = 'hor';
        }else{
            $color_class = 'hor';
        }
    }elseif ($news_in_block == 2) {
        if ($first_block == 1) {
            $news_class = ' wide_item';
            $margin_class = ' mr';
            $color_class = 'color2';
        }else{
            $news_class = ' short_item';
            $margin_class = ' mr';
            $color_class = 'color8';
        }
    }elseif ($news_in_block == 3) {
        if ($first_block == 1) {
            $news_class = ' short_item';
            $margin_class = '';
            $color_class = 'color3';
        }else{
            $news_class = ' wide_item';
            $margin_class = '';
            $color_class = 'color9';
        }
    }else{
        $news_class = ' triple_item';
        $margin_class = ' mr';
        if ($news_in_block == 4) {
            $color_class = 'color4';
        }elseif ($news_in_block == 5) {
            $color_class = 'color5';
        }else{
            $margin_class = '';
            $color_class = 'color6';
        }
    }

	$db_props = CIBlockElement::GetProperty(7, $arItem['ID'], array("sort" => "asc"), Array("CODE"=>"GRAD"));
	if($ar_props = $db_props->Fetch())
		$color = $ar_props["VALUE"];
	else
		$color = RandColor();

	if ($color == '') $color = RandColor();

	$color1 = HexToRgba($color, 1);
	$color2 = HexToRgba($color, 0);

	if ($color_class == 'hor') {
		$dir = 'left';
		$basedir = 'to right';
		$p1 = '12%';
		$p2 = '30%';
		$p3 = '65%';
	} else {
		$dir = 'bottom';
		$basedir = 'to top';
		$p1 = '22%';
		$p2 = '53%';
		$p3 = '99%';
	}

	$grad_style = "
		background: -moz-linear-gradient($dir, rgba($color1) 0%, rgba($color1) $p1, rgba($color1) $p2, rgba($color2) $p3, rgba($color2) 100%);
		background: -webkit-linear-gradient($dir, rgba($color1) 0%,rgba($color1) $p1,rgba($color1) $p2,rgba($color2) $p3,rgba($color2) 100%);
		background: linear-gradient($basedir, rgba($color1) 0%,rgba($color1) $p1,rgba($color1) $p2,rgba($color2) $p3,rgba($color2) 100%);
	";

    ?>
        <div class="news_item<?=$news_class?><?=$margin_class?>" style="background:url(<?=$arItem['DETAIL_PICTURE']['SRC']?>) no-repeat scroll center top;">
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" style="<?=$grad_style?>">
                <div class="news_item_text">
                    <span><?=$arItem['NAME']?></span>
                    <p><?=$arItem['PREVIEW_TEXT']?></p>
                </div>
            </a>
        </div>

<?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>