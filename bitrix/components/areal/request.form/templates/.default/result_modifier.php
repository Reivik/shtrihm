<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if($USER->IsAuthorized())
{
	$fioPos=strpos($arResult['QUESTIONS']["SIMPLE_QUESTION_881"]['HTML_CODE'],"value=\"")+7;
	$valPos=strpos($arResult['QUESTIONS']["SIMPLE_QUESTION_881"]['HTML_CODE'],"\"",$fioPos);
	$value=substr($arResult['QUESTIONS']["SIMPLE_QUESTION_881"]['HTML_CODE'],$fioPos,$valPos-$fioPos);

	if($value=="")
	{
		$value=$USER->GetFullName();
		$start=substr($arResult['QUESTIONS']["SIMPLE_QUESTION_881"]['HTML_CODE'],0,$fioPos);
		$finish=substr($arResult['QUESTIONS']["SIMPLE_QUESTION_881"]['HTML_CODE'],$fioPos,strlen($arResult['QUESTIONS']["SIMPLE_QUESTION_881"]['HTML_CODE'])-$fioPos);
		$arResult['QUESTIONS']["SIMPLE_QUESTION_881"]['HTML_CODE']=$start.$value.$finish;
	}

	$emailPos=strpos($arResult['QUESTIONS']["SIMPLE_QUESTION_970"]['HTML_CODE'],"value=\"")+7;
	$valPos=strpos($arResult['QUESTIONS']["SIMPLE_QUESTION_970"]['HTML_CODE'],"\"",$emailPos);
	$value=substr($arResult['QUESTIONS']["SIMPLE_QUESTION_970"]['HTML_CODE'],$emailPos,$valPos-$emailPos);

	if($value=="")
	{
		$value=$USER->GetEmail();
		$start=substr($arResult['QUESTIONS']["SIMPLE_QUESTION_970"]['HTML_CODE'],0,$emailPos);
		$finish=substr($arResult['QUESTIONS']["SIMPLE_QUESTION_970"]['HTML_CODE'],$emailPos,strlen($arResult['QUESTIONS']["SIMPLE_QUESTION_970"]['HTML_CODE'])-$emailPos);
		$arResult['QUESTIONS']["SIMPLE_QUESTION_970"]['HTML_CODE']=$start.$value.$finish;
	}
}
//email SIMPLE_QUESTION_970
?>