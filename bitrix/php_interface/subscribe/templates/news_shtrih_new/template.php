<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
global $APPLICATION;
?>
    <style>
		@media only screen {
            html {
                min-height: 100%;
                background: #ffffff;
            }
        }

        @media only screen and (max-width: 596px) {
            .small-float-center {
                margin: 0 auto !important;
                float: none !important;
                text-align: center !important;
            }
            .small-text-center {
                text-align: center !important;
            }
            .small-text-left {
                text-align: left !important;
            }
            .small-text-right {
                text-align: right !important;
            }
        }

        @media only screen and (max-width: 596px) {
            .hide-for-large {
                display: block !important;
                width: auto !important;
                overflow: visible !important;
                max-height: none !important;
                font-size: inherit !important;
                line-height: inherit !important;
            }
        }

        @media only screen and (max-width: 596px) {
            table.body table.container .hide-for-large,
            table.body table.container .row.hide-for-large {
                display: table !important;
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 596px) {
            table.body table.container .callout-inner.hide-for-large {
                display: table-cell !important;
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 596px) {
            table.body table.container .show-for-large {
                display: none !important;
                width: 0;
                mso-hide: all;
                overflow: hidden;
            }
        }

        @media only screen and (max-width: 596px) {
            table.body img {
                width: auto;
                height: auto;
            }
            table.body center {
                min-width: 0 !important;
            }
            table.body .columns,
            table.body .column {
                height: auto !important;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
                padding-left: 2.5% !important;
                padding-right: 2.5% !important;
                width: 95%!important;
            }
            table.body .columns .column,
            table.body .columns .columns,
            table.body .column .column,
            table.body .column .columns {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            table.body .collapse .columns,
            table.body .collapse .column {
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            td.small-1,
            th.small-1 {
                display: inline-block !important;
                width: 8.33333% !important;
            }
            td.small-2,
            th.small-2 {
                display: inline-block !important;
                width: 16.66667% !important;
            }
            td.small-3,
            th.small-3 {
                display: inline-block !important;
                width: 25% !important;
            }
            td.small-4,
            th.small-4 {
                display: inline-block !important;
                width: 33.33333% !important;
            }
            td.small-5,
            th.small-5 {
                display: inline-block !important;
                width: 41.66667% !important;
            }
            td.small-6,
            th.small-6 {
                display: inline-block !important;
                width: 50% !important;
            }
            td.small-7,
            th.small-7 {
                display: inline-block !important;
                width: 58.33333% !important;
            }
            td.small-8,
            th.small-8 {
                display: inline-block !important;
                width: 66.66667% !important;
            }
            td.small-9,
            th.small-9 {
                display: inline-block !important;
                width: 75% !important;
            }
            td.small-10,
            th.small-10 {
                display: inline-block !important;
                width: 83.33333% !important;
            }
            td.small-11,
            th.small-11 {
                display: inline-block !important;
                width: 91.66667% !important;
            }
            td.small-12,
            th.small-12 {
                display: inline-block !important;
                width: 100% !important;
            }
            .columns td.small-12,
            .column td.small-12,
            .columns th.small-12,
            .column th.small-12 {
                display: block !important;
                width: 100% !important;
            }
            table.body td.small-offset-1,
            table.body th.small-offset-1 {
                margin-left: 8.33333% !important;
                Margin-left: 8.33333% !important;
            }
            table.body td.small-offset-2,
            table.body th.small-offset-2 {
                margin-left: 16.66667% !important;
                Margin-left: 16.66667% !important;
            }
            table.body td.small-offset-3,
            table.body th.small-offset-3 {
                margin-left: 25% !important;
                Margin-left: 25% !important;
            }
            table.body td.small-offset-4,
            table.body th.small-offset-4 {
                margin-left: 33.33333% !important;
                Margin-left: 33.33333% !important;
            }
            table.body td.small-offset-5,
            table.body th.small-offset-5 {
                margin-left: 41.66667% !important;
                Margin-left: 41.66667% !important;
            }
            table.body td.small-offset-6,
            table.body th.small-offset-6 {
                margin-left: 50% !important;
                Margin-left: 50% !important;
            }
            table.body td.small-offset-7,
            table.body th.small-offset-7 {
                margin-left: 58.33333% !important;
                Margin-left: 58.33333% !important;
            }
            table.body td.small-offset-8,
            table.body th.small-offset-8 {
                margin-left: 66.66667% !important;
                Margin-left: 66.66667% !important;
            }
            table.body td.small-offset-9,
            table.body th.small-offset-9 {
                margin-left: 75% !important;
                Margin-left: 75% !important;
            }
            table.body td.small-offset-10,
            table.body th.small-offset-10 {
                margin-left: 83.33333% !important;
                Margin-left: 83.33333% !important;
            }
            table.body td.small-offset-11,
            table.body th.small-offset-11 {
                margin-left: 91.66667% !important;
                Margin-left: 91.66667% !important;
            }
            table.body table.columns td.expander,
            table.body table.columns th.expander {
                display: none !important;
            }
            table.body .right-text-pad,
            table.body .text-pad-right {
                padding-left: 10px !important;
            }
            table.body .left-text-pad,
            table.body .text-pad-left {
                padding-right: 10px !important;
            }
            table.menu {
                width: 100% !important;
            }
            table.menu td,
            table.menu th {
                width: auto !important;
                display: inline-block !important;
            }
            table.menu.vertical td,
            table.menu.vertical th,
            table.menu.small-vertical td,
            table.menu.small-vertical th {
                display: block !important;
            }
            table.menu[align="center"] {
                width: auto !important;
            }
            table.button.small-expand,
            table.button.small-expanded {
                width: 100% !important;
            }
            table.button.small-expand table,
            table.button.small-expanded table {
                width: 100%;
            }
            table.button.small-expand table a,
            table.button.small-expanded table a {
                text-align: center !important;
                width: 100% !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            table.button.small-expand center,
            table.button.small-expanded center {
                min-width: 0;
            }
        }

        @media only screen and (max-width: 596px) {
            .border-header {
                width: 95%;
            }
        }

        @media only screen and (max-width: 596px) {
            .border-footer {
                width: 95%;
            }
        }
        @media only screen and (max-width: 596px) {
            .main_info {
                width: 95%;
            }
        }

        @media only screen and (max-width: 596px) {
            .logo {
                width: 81px !important;
                height: 71px !important;
            }
        }

        @media only screen and (max-width: 596px) {
            .logo_footer {
                width: 57px !important;
                height: 45px !important;
            }
        }
    </style>
<?$SUBSCRIBE_TEMPLATE_RESULT = $APPLICATION->IncludeComponent(
	"bitrix:subscribe.news",
	"new_subs",
	Array(
		"SITE_ID" => "s1",
		"IBLOCK_TYPE" => "press_center",
		"ID" => "7",
		"SORT_BY" => "ACTIVE_FROM",
		"SORT_ORDER" => "DESC"
	),
	null,
	array(
		"HIDE_ICONS" => "Y",
	)
);?>
<?

if($SUBSCRIBE_TEMPLATE_RESULT)
	return array(
		"SUBJECT"=>$SUBSCRIBE_TEMPLATE_RUBRIC["NAME"],
		"BODY_TYPE"=>"html",
		"CHARSET"=>"UTF-8",
		"DIRECT_SEND"=>"Y",
		"FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
	);
else
	return false;
?>