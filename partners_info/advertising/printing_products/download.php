<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?  
	if(isset($_GET['file']))
	{
		CModule::IncludeModule('iblock');
		$arElem=CIBlockElement::GetList(array(),array("ID"=>(int)$_GET['file']),false,false,array("IBLOCK_ID","PROPERTY_FILE","ID","NAME"))->Fetch();
		
		if($arElem['IBLOCK_ID'] != $_GET["iblock"] || $arElem['PROPERTY_FILE_VALUE']<=0)
			die("ОШИБКА: неверный формат запроса!");
		$F_ID=$arElem['PROPERTY_FILE_VALUE'];
		$rsFile = CFile::GetByID($F_ID);
		$arFile = $rsFile->Fetch();
		//pr($arFile);
		$fName = $arFile["ORIGINAL_NAME"];
		//определяем тип файла
		$c_Type=$arFile["CONTENT_TYPE"];		
		 // опредеяем путь к файлу 
		$file = CFile::GetPath($F_ID);
		$file=$_SERVER['DOCUMENT_ROOT'].$file;
		$ob = new CIBlockElementRights($_GET["iblock"], $arElem['ID']); // создаём объект прав и инициализируем элементом
		$arRights = $ob->GetRights();
		$arGroups = CUser::GetUserGroup($USER->GetID());
		$access=false;
		foreach($arRights as $right)
		{
			if($right['TASK_ID'] != 38) //если доступ группе не запрещен
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
				if(strpos($fName, '.docx') !== false) {
					LocalRedirect($fileurl);
					die;
				}
				else {
					file_force_download($file, $fName);
				}
			}
		else
			echo "ОШИБКА: У вас недостаточно прав для скачивания этого файла!";
	} 
	else {die("ОШИБКА: неверный формат запроса!");}
function file_force_download($file, $file_name) {
	if (file_exists($file)) {
		// сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
		// если этого не сделать файл будет читаться в память полностью!
		while (ob_get_level()) {
		ob_end_clean();
			}	
		// заставляем браузер показать окно сохранения файла
		header('Content-Description: File Transfer');
		header('Content-Type: '.mime_content_type($file));
		header('Content-Disposition: attachment; filename=' . $file_name);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		// читаем файл и отправляем его пользователю
		if ($fd = fopen($file, 'rb')) {
			while (!feof($fd)) {
				print fread($fd, 1024);
			}
			fclose($fd);
		}
		exit;
	}
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?> 