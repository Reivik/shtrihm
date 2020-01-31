<div class="block-title calendar">
	<div class="title">календарь событий</div>
	<div class="block-content">
		<div id="datepicker" class="datapicker"></div>
		<div id="event_list">
			<?$APPLICATION->IncludeComponent("areal:calendar_event", ".default", array("DATE" => date("d.m.Y")));?>			
		</div>
	</div>
</div>