<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//pr($arResult);?>
<?if(!empty($arResult)):?>
	<div class="consult">
		<div class="block">
			<div class="blockCont">
				<div class="pointer"></div>
				<div class="title">
					<h2>Консультация</h2>
				</div>
				<?$n = 0;?>
				<?foreach($arResult as $key => $arItem):?>
					<div class="theme_consult">
						<div class="subtitle"><?=$key?></div>
						<?foreach($arItem as $item):?>
							<table <?if($n == 0):?> style="display: block" <?endif;?> >
								<tr>
									<td colspan="2" class="statusBl">
										<?if(!empty($item["PREVIEW_PICTURE"]["src"])):?>
											<img src="<?=$item["PREVIEW_PICTURE"]["src"]?>" width="<?=$item["PREVIEW_PICTURE"]["width"]?>" height="<?=$item["PREVIEW_PICTURE"]["height"]?>" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>">
										<?else:?>
											<img src="/design/images/no-photo/pic49x49.png" width="49" height="49" alt="<?=$item["NAME"]?>" title="<?=$item["NAME"]?>" />
										<?endif;?>
										<h3><?=$item["NAME"]?></h3>
										<?if($item["RUNNING"] == true):?>
											<div class="status onLine">On-line</div>
										<?endif;?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<dl>
											<?/*<dt>Ваш региональный менеджер</dt>*/?>
											<?if(!empty($item["PHONE"])):?>
												<dd><span>Телефон:</span> <?=$item["PHONE"]?></dd>
											<?endif;?>
											<?if(!empty($item["EMAIL"])):?>
												<?$email = explode("@", $item["EMAIL"]);?>
												<dd><span>E-mail:</span> <a class="e-mail" title="<?=$email[0]?>" href="#<?=$email[1]?>" ></a></dd>
											<?endif;?>
											<?if(!empty($item["SKYPE"])):?>
												<dd><span>Skype:</span> <?=$item["SKYPE"]?></dd>
											<?endif;?>
											<?if(!empty($item["ICQ"])):?>
												<dd><span>ICQ:</span> <?=$item["ICQ"]?></dd>
											<?endif;?>
										</dl>
									</td>
								</tr>
								<tr>
									<?if($item["RUNNING"] == true):?>
										<?if($item["BUSY"] == true):?>
											<td><a class="optionBtn" target="_blank" href="<?=$item["HREF_COMMIT"]?>">Связаться онлайн</a></td>
											<td><a class="optionBtn" href="mailto:<?=$item["EMAIL"]?>" <?if($item["RUNNING"] == false):?> colspan="2" <?endif;?> href="">Написать <?if($item["RUNNING"] == false):?> <br /> <?endif;?> письмо</a></td>
											<?/*if($USER->IsAuthorized()):?>
												<td><a class="optionBtn" target="_blank" href="<?=$item["HREF_COMMIT"]?>">Связаться онлайн</a></td>
												<td>
													<?$email = explode("@", $item["EMAIL"]);?>
													<a class="e-mail optionBtn" title="<?=$email[0]?>" href="#<?=$email[1]?>" <?if($item["RUNNING"] == false):?> colspan="2" <?endif;?>>11</a>
												</td>
											<?else:?>
												<td class="messConsult">Для общения с консультантом, необходимо <a href="/partners_info/registration/" target="_blank" title="Регистрация">зарегистрироваться</a> или <a href="/login/" target="_blank" title="Авторизация">авторизоваться</a>.</td>
											<?endif*/?>
										<?else:?>
											<?//if($USER->IsAuthorized()):?>	
												<td>В настоящее время данный консультант занят. Вы можете связаться с ним позже или написать письмо.
												<a class="optionBtn" href="mailto:<?=$item["EMAIL"]?>" <?if($item["RUNNING"] == false):?> colspan="2" <?endif;?> href="">Написать <br /> письмо</a></td>
											<?/*else:?>
												<td class="messConsult">Для общения с консультантом, необходимо <a href="/partners_info/registration/" target="_blank" title="Регистрация">зарегистрироваться</a> или <a href="/login/" target="_blank" title="Авторизация">авторизоваться</a>.</td>
											<?endif*/?>
										<?endif;?>
									<?else:?>
										<?//if($USER->IsAuthorized()):?>
											<td><a class="optionBtn" href="mailto:<?=$item["EMAIL"]?>" <?if($item["RUNNING"] == false):?> colspan="2" <?endif;?> href="">Написать <?if($item["RUNNING"] == false):?> <br /> <?endif;?> письмо</a></td>
										<?/*else:?>
											<td class="messConsult">Для общения с консультантом, необходимо <a href="/registration/" target="_blank" title="Регистрация">зарегистрироваться</a> или <a href="/login/" target="_blank" title="Авторизация">авторизоваться</a>.</td>
										<?endif*/?>
									<?endif;?>
								</tr>
							</table>
						<?endforeach;?>
					</div>
					<?$n++;?>
				<?endforeach;?>
			</div>
		</div>
	</div>
<?endif;?>