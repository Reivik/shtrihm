<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("blog"))
{
	ShowError(GetMessage("BLOG_MODULE_NOT_INSTALL"));
	return;
}
if (!CModule::IncludeModule("socialnetwork"))
{
	ShowError(GetMessage("SONET_MODULE_NOT_INSTALL"));
	return;
}

$arParams["MESSAGE_COUNT"] = IntVal($arParams["MESSAGE_COUNT"])>0 ? IntVal($arParams["MESSAGE_COUNT"]): 20;
$arParams["SORT_BY1"] = (strlen($arParams["SORT_BY1"])>0 ? $arParams["SORT_BY1"] : "DATE_PUBLISH");
$arParams["SORT_ORDER1"] = (strlen($arParams["SORT_ORDER1"])>0 ? $arParams["SORT_ORDER1"] : "DESC");
$arParams["SORT_BY2"] = (strlen($arParams["SORT_BY2"])>0 ? $arParams["SORT_BY2"] : "ID");
$arParams["SORT_ORDER2"] = (strlen($arParams["SORT_ORDER2"])>0 ? $arParams["SORT_ORDER2"] : "DESC");

if(!is_array($arParams["GROUP_ID"]))
	$arParams["GROUP_ID"] = array($arParams["GROUP_ID"]);
foreach($arParams["GROUP_ID"] as $k=>$v)
	if(IntVal($v) <= 0)
		unset($arParams["GROUP_ID"][$k]);

$arParams["USER_ID"] = IntVal($arParams["USER_ID"]);
$arParams["SOCNET_GROUP_ID"] = IntVal($arParams["SOCNET_GROUP_ID"]);

$arParams["POST_PROPERTY"] = array(/*"UF_BLOG_POST_FILE", */"UF_BLOG_POST_DOC");
$arParams["DATE_TIME_FORMAT"] = trim(empty($arParams["DATE_TIME_FORMAT"]) ? $DB->DateFormatToPHP(CSite::GetDateFormat("FULL")) : $arParams["DATE_TIME_FORMAT"]);

// activation rating
CRatingsComponentsMain::GetShowRating($arParams);

$arParams["ALLOW_POST_CODE"] = $arParams["ALLOW_POST_CODE"] !== "N";

CpageOption::SetOptionString("main", "nav_page_in_session", "N");

if(strLen($arParams["BLOG_VAR"])<=0)
	$arParams["BLOG_VAR"] = "blog";
if(strLen($arParams["PAGE_VAR"])<=0)
	$arParams["PAGE_VAR"] = "page";
if(strLen($arParams["USER_VAR"])<=0)
	$arParams["USER_VAR"] = "id";
if(strLen($arParams["POST_VAR"])<=0)
	$arParams["POST_VAR"] = "id";

$arParams["PATH_TO_BLOG"] = trim($arParams["PATH_TO_BLOG"]);
if(strlen($arParams["PATH_TO_BLOG"])<=0)
	$arParams["PATH_TO_BLOG"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arParams["PAGE_VAR"]."=blog&".$arParams["BLOG_VAR"]."=#blog#");

$arParams["PATH_TO_BLOG_CATEGORY"] = trim($arParams["PATH_TO_BLOG_CATEGORY"]);
if(strlen($arParams["PATH_TO_BLOG_CATEGORY"])<=0)
	$arParams["PATH_TO_BLOG_CATEGORY"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arParams["PAGE_VAR"]."=blog&".$arParams["BLOG_VAR"]."=#blog#"."&category=#category_id#");

$arParams["PATH_TO_POST"] = trim($arParams["PATH_TO_POST"]);
if(strlen($arParams["PATH_TO_POST"])<=0)
	$arParams["PATH_TO_POST"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arParams["PAGE_VAR"]."=post&".$arParams["BLOG_VAR"]."=#blog#&".$arParams["POST_VAR"]."=#post_id#");

$arParams["PATH_TO_POST_EDIT"] = trim($arParams["PATH_TO_POST_EDIT"]);
if(strlen($arParams["PATH_TO_POST_EDIT"])<=0)
	$arParams["PATH_TO_POST_EDIT"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arParams["PAGE_VAR"]."=post_edit&".$arParams["BLOG_VAR"]."=#blog#&".$arParams["POST_VAR"]."=#post_id#");

$arParams["PATH_TO_USER"] = trim($arParams["PATH_TO_USER"]);
if(strlen($arParams["PATH_TO_USER"])<=0)
	$arParams["PATH_TO_USER"] = htmlspecialcharsbx($APPLICATION->GetCurPage()."?".$arParams["PAGE_VAR"]."=user&".$arParams["USER_VAR"]."=#user_id#");

$arParams["PATH_TO_SMILE"] = strlen(trim($arParams["PATH_TO_SMILE"]))<=0 ? false : trim($arParams["PATH_TO_SMILE"]);

$arParams["IMAGE_MAX_WIDTH"] = IntVal($arParams["IMAGE_MAX_WIDTH"]);
$arParams["IMAGE_MAX_HEIGHT"] = IntVal($arParams["IMAGE_MAX_HEIGHT"]);
$arParams["ALLOW_POST_CODE"] = $arParams["ALLOW_POST_CODE"] !== "N";
$arResult["allowVideo"] = COption::GetOptionString("blog","allow_video", "Y");

if($arParams["SET_TITLE"] == "Y")
	$APPLICATION->SetTitle(GetMessage("BLOG_DR_TITLE"));

$user_id = IntVal($USER->GetID());
if($user_id > 0 && $user_id == IntVal($arParams["USER_ID"]))
{
	if (CSocNetFeatures::IsActiveFeature(SONET_ENTITY_USER, $arParams["USER_ID"], "blog"))
	{
		$arResult["ERROR_MESSAGE"] = Array();
		$arResult["OK_MESSAGE"] = Array();

		//Message delete
		if (IntVal($_GET["del_id"]) > 0)
		{
			if($_GET["success"] == "Y")
				$arResult["OK_MESSAGE"][] = GetMessage("BLOG_BLOG_BLOG_MES_DELED");
			else
			{
				if (check_bitrix_sessid())
				{
					$del_id = IntVal($_GET["del_id"]);
					if($arPost = CBlogPost::GetByID($del_id))
					{
						if($arPost["AUTHOR_ID"] == $user_id)
						{
							CBlogPost::DeleteLog($del_id);
							if (CBlogPost::Delete($del_id))
							{
								LocalRedirect($APPLICATION->GetCurPageParam("del_id=".$del_id."&success=Y", Array("del_id", "pub_id", "sessid", "success")));
							}
							else
								$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_BLOG_BLOG_MES_DEL_ERROR");
						}
						else
							$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_BLOG_BLOG_MES_DEL_NO_RIGHTS");
					}
					else
						$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_BLOG_BLOG_MES_DEL_NO_RIGHTS");
				}
				else
					$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_BLOG_SESSID_WRONG");
			}
		}
		elseif (IntVal($_GET["pub_id"]) > 0)
		{
			if($_GET["success"] == "Y")
				$arResult["OK_MESSAGE"][] = GetMessage("BLOG_BLOG_BLOG_MES_PUB");
			else
			{
				if (check_bitrix_sessid())
				{
					$pub_id = IntVal($_GET["pub_id"]);
					if($arPost = CBlogPost::GetByID($pub_id))
					{
						if($arPost["AUTHOR_ID"] == $user_id && $arPost["PUBLISH_STATUS"] != BLOG_PUBLISH_STATUS_PUBLISH)
						{
							if(CBlogPost::Update($pub_id, Array("PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_PUBLISH, "=DATE_PUBLISH" => $DB->GetNowFunction())))
							{
								$arParamsNotify = Array(
									"bSoNet" => true,
									"allowVideo" => $arResult["allowVideo"],
									"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
									"PATH_TO_POST" => $arParams["PATH_TO_POST"],
									"SOCNET_GROUP_ID" => $arParams["SOCNET_GROUP_ID"],
									"user_id" => $arParams["USER_ID"],
									"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
									"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
									);
								CBlogPost::Notify($arPost, false, $arParamsNotify);

								$socnetRights = CBlogPost::GetSocNetPermsCode($arPost["ID"]);
								$arFieldsIM = Array(
									"TYPE" => "POST",
									"TITLE" => $arPost["TITLE"],
									"URL" => CComponentEngine::MakePathFromTemplate(htmlspecialcharsBack($arParams["PATH_TO_POST"]), array("post_id" => $arPost["ID"], "user_id" => $arParams["USER_ID"])),
									"ID" => $arPost["ID"],
									"FROM_USER_ID" => $arParams["USER_ID"],
									"TO_USER_ID" => array(),
									"TO_SOCNET_RIGHTS" => $socnetRights,
									"TO_SOCNET_RIGHTS_OLD" => array(),
								);

								CBlogPost::NotifyIm($arFieldsIM);
								LocalRedirect($APPLICATION->GetCurPageParam("pub_id=".$pub_id."&success=Y", Array("del_id", "pub_id", "sessid", "success")));
							}
							else
								$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_BLOG_BLOG_MES_PUB_ERROR");
						}
					}
					else
						$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_BLOG_BLOG_MES_PUB_NO_RIGHTS");
				}
				else
					$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_BLOG_SESSID_WRONG");
			}
		}

		$dbPost = CBlogPost::GetList(
			Array("DATE_PUBLISH" => "DESC"),
			Array(
					"PUBLISH_STATUS" => BLOG_PUBLISH_STATUS_DRAFT,
					"BLOG_USE_SOCNET" => "Y",
					"GROUP_ID" => $arParams["GROUP_ID"],
					"GROUP_SITE_ID" => SITE_ID,
					"AUTHOR_ID" => $arParams["USER_ID"],
				),
			false,
			array("nPageSize"=>$arParams["MESSAGE_COUNT"], "bShowAll" => false),
			array("ID", "TITLE", "BLOG_ID", "AUTHOR_ID", "DETAIL_TEXT", "DETAIL_TEXT_TYPE", "DATE_PUBLISH", "PUBLISH_STATUS", "ENABLE_COMMENTS", "VIEWS", "NUM_COMMENTS", "CATEGORY_ID", "CODE", "BLOG_OWNER_ID", "BLOG_GROUP_ID", "BLOG_GROUP_SITE_ID", "MICRO")
		);

		$arResult["NAV_STRING"] = $dbPost->GetPageNavString(GetMessage("MESSAGE_COUNT"), $arParams["NAV_TEMPLATE"]);
		$arResult["POST"] = Array();
		$arResult["IDS"] = Array();

		while($arPost = $dbPost->GetNext())
		{
			$arPost["perms"] = BLOG_PERMS_FULL;
			$arPost["urlToPub"] = htmlspecialcharsex($APPLICATION->GetCurPageParam("pub_id=".$arPost["ID"]."&".bitrix_sessid_get(), Array("del_id", "sessid", "success", "pub_id")));
			$arPost["urlToDelete"] = htmlspecialcharsex($APPLICATION->GetCurPageParam("del_id=".$arPost["ID"]."&".bitrix_sessid_get(), Array("del_id", "sessid", "success", "pub_id")));
			$arPost["ADIT_MENU"][6] = Array(
				"text_php" => GetMessage("BLOG_DR_PUB"),
				"href" => $arPost["urlToPub"],
				);
			$arPost["ADIT_MENU"][7] = Array(
				"text_php" => GetMessage("BLOG_DR_DELETE"),
				"onclick" => "function() { if(confirm('".GetMessage("BLOG_DR_DELETE_CONFIRM")."')) window.location='".$arPost["urlToDelete"]."';  this.popupWindow.close();}",
				);
			$arResult["POST"][] = $arPost;
		}
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_SONET_MODULE_NOT_AVAIBLE");
}
else
	$arResult["ERROR_MESSAGE"][] = GetMessage("BLOG_DR_ANOTHER_USER_DRAFT");
$this->IncludeComponentTemplate();
?>
