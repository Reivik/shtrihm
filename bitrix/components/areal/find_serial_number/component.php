<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(isset($_REQUEST['commDateOk']) && $_REQUEST['serialText']==$_REQUEST['serNumber'] && check_bitrix_sessid() && (in_array(UG_PO,$USER->GetUserGroupArray()) || in_array(UG_ADMIN,$USER->GetUserGroupArray())))
{
	if($_REQUEST['comm_date']!="")
		$date=date_format(date_create($_REQUEST['comm_date']), 'Y-m-d');
	if(strtotime($date))
	{
		$serNumber=htmlspecialchars($_REQUEST['serNumber']);
		$DB->Query("UPDATE `SERIAL_NUMBERS` SET `COMMISSIONING_DATE`='$date',`PARTNER_ID`='".$USER->GetId()."' WHERE `SERIAL_NUM`='".$serNumber."'");
	}
	else
		$arResult['COMM_DATE_ERROR']="Проверте правильность вводимой даты!";

}
if(isset($_REQUEST['remontOk']) && $_REQUEST['serialText']==$_REQUEST['serNumber'] && check_bitrix_sessid() && (in_array(UG_PO,$USER->GetUserGroupArray()) || in_array(UG_ADMIN,$USER->GetUserGroupArray())))
{
	if($_REQUEST['remontDate']!="")
		$date=date_format(date_create($_REQUEST['remontDate']), 'Y-m-d');
	if(strtotime($date))
	{
		$comment=trim(htmlspecialchars(strip_tags($_REQUEST['regComment'])));
		$serNumber=htmlspecialchars($_REQUEST['serNumber']);
		$DB->Query("INSERT INTO `WARRANTY`(`NUMBER`, `DATE`, `PARTNER_ID`, `COMMENT`) VALUES ('$serNumber','$date','".$USER->GetId()."','$comment')");
		LocalRedirect($APPLICATION->GetCurPage(false)."?add_remont=Y&serNumber=".$serNumber."&serialText=".$serNumber);
	}
	else
		$arResult['REMONT_ERROR']="Проверте правильность вводимой даты!";

}
if(isset($_REQUEST['serialText']) && trim($_REQUEST['serialText']!=="") && check_bitrix_sessid())
{
	$serNumber=trim(htmlspecialchars(strip_tags($_REQUEST['serialText'])));
	if($serNumber!="")
	{
		global $DB;
		$res=$DB->Query("SELECT * FROM  `SERIAL_NUMBERS` WHERE `SERIAL_NUM`='".$serNumber."'");
		if(!$arResult['ELEMENT']=$res->Fetch())
			$arResult['ERROR']="Информация об оборудовании с данным номером отсутствует. Проверьте корректность веденного номера";
	}
	if($arResult['ELEMENT']['COMMISSIONING_DATE']!="")
	{
		$res=$DB->Query("SELECT * FROM  `WARRANTY` WHERE `NUMBER`='".$serNumber."'");
		while($arElem=$res->Fetch())
		{
			if($arElem['PARTNER_ID']!='')
			{
				//выборка названия компании
				$user=$USER->GetByID($arElem['PARTNER_ID']);//
			}
			$arResult['REMONT'][]=$arElem;
		}
	}
}
$this->IncludeComponentTemplate();
?>
