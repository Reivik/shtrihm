<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?  
	if(isset($_GET['id']))
	{
		CModule::IncludeModule('iblock');
		$arElem=CIBlockElement::GetList(array(),array("ID"=>(int)$_GET['id']),false,false,array("IBLOCK_ID","PROPERTY_FILE","ID","NAME"))->Fetch();
		if($arElem['IBLOCK_ID']!=21 || $arElem['PROPERTY_FILE_VALUE']<=0)
			die("ОШИБКА: неверный формат запроса!");
		$F_ID=$arElem['PROPERTY_FILE_VALUE'];
		$rsFile = CFile::GetByID($F_ID);
		$arFile = $rsFile->Fetch();
		$fName = $arFile["FILE_NAME"];
		//определяем тип файла
		$c_Type=$arFile["CONTENT_TYPE"];

		 // опредеяем путь к файлу 
		$fileurl = CFile::GetPath($F_ID);
		$file=$_SERVER['DOCUMENT_ROOT'].$fileurl;
		$ob = new CIBlockElementRights(21,$arElem['ID']); // создаём объект прав и инициализируем элементом
		$arRights = $ob->GetRights();
		$arGroups = $USER->GetUserGroupArray(); 
		$access=false; 
		foreach($arRights as $right)
		{
			if($right['TASK_ID']!=38) //если доступ группе не запрещен
				if(in_array(str_replace("G","",$right["GROUP_CODE"]),$arGroups))//входит ли пользователь в эту группу
				{
					$access=true;
					break;
				}	
		}
			if($access)
				if(!file_exists($file))
				{
					die("Error: $file not found.");
				} 
				else
				{
					if( filesize($file)<100000000){//Костыль-костылек, очень большие файлы не хотят скачиваться таким образом
						header("Cache-Control: public");
						header("Content-Description: File Transfer");
						header("Content-Disposition: attachment; filename=".$fName);
						header("Content-Type: $c_Type");
						header("Content-Transfer-Encoding: binary");
						header("Content-Length: " . filesize($file));
						readfile($file);
					}else
						LocalRedirect($fileurl);
				}
			else
				echo "ОШИБКА: У вас недостаточно прав для скачивания этого файла!";
	} 
	else {die("ОШИБКА: неверный формат запроса!");}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?> 