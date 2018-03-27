<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/eventHandlers.php'; // настройки прав доступа общения
include_once $_SERVER["DOCUMENT_ROOT"] . '/local/php_interface/include/agentdeal.php'; //  агенты сделки
function _Check404Error()
{
   if (defined('ERROR_404') && ERROR_404=='Y')
   {
   GLOBAL $APPLICATION;
   $APPLICATION->RestartBuffer();
   include   $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.SITE_TEMPLATE_ID.'/header.php';
   require($_SERVER['DOCUMENT_ROOT'] . '/404.php');
   include   $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.SITE_TEMPLATE_ID.'/footer.php';
   }
}