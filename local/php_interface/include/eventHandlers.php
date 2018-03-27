<? AddEventHandler("im", "OnBeforeMessageNotifyAdd", "___OnBeforeMessageNotifyAdd");
AddEventHandler("tasks", "OnBeforeTaskAdd", "___OnBeforeTaskAdd");

function ___OnBeforeMessageNotifyAdd($arFields) // Метод ограничивает общение между сотрудниками стальной линии и сотрудниками дистрибьюторов, кроме лиц из группы Ответсвенные лица стальной линии(id=23) и руководста завода и партнёров (id=24)
{
	global $USER;

	if (CSite::InGroup (array(12, 24))) return; //Руководство завода и партнёров и Ответсвенные лица Дистрибьюторов
	//if (isset($arFields['TO_USER_ID']) == $USER->GetID()) return;
	
	
	//if (!CSite::InGroup (array(12))){


        if (!in_array(12, CUser::GetUserGroup($arFields['TO_USER_ID']))) return;
		$arFilter = Array(
			"GROUPS_ID" => array(23, 1) // Ответсвенные лица Стальной Линии
		);

		$arList = CUser::GetList(($by = "NAME"), ($order = "desc"), $arFilter);


		while ($arUser = $arList->Fetch()) {
		  $fixIDs[] = $arUser[ID];
		}
		
		CModule::IncludeModule("im");

		$stopMessage = true;

		if(!$USER->IsAdmin()){
			if(isset($arFields['TO_CHAT_ID'])){
				$chatId = intval($arFields['TO_CHAT_ID']);
				$chatinfo = CIMChat::GetChatData(array('ID' => $chatId));

				foreach($chatinfo['userInChat'][$chatId] as $userTo){

					if(in_array($userTo, $fixIDs)){
						$stopMessage = false;
						break;
					}
				}
				unset($chatInfo);
			}elseif(isset($arFields['TO_USER_ID'])){
                if ($USER->GetID() == 456 && $arFields['TO_USER_ID'] == 428) return;
				if(in_array($arFields['TO_USER_ID'], $fixIDs)){
					$stopMessage = false;
				}
			}
			
			if($stopMessage){
				return Array(
					'reason' => 'По регламенту компании писать этому сотруднику запрещено.'
					,'result' => false
				);
			}
		}
	/*}else if (!$USER->IsAdmin()){
		
		if (in_array(12, CUser::GetUserGroup($arFields['TO_USER_ID']))){ return;}

		if(isset($arFields['TO_CHAT_ID'])){ die();
			$chatId = intval($arFields['TO_CHAT_ID']);
			$chatinfo = CIMChat::GetChatData(array('ID' => $chatId));

			foreach($chatinfo['userInChat'][$chatId] as $userTo){
				if($userTo != 12 || $userTo != 1){
					return false;
				}
			}
			unset($chatInfo);
		}
		return false;
	}*/
}

function ___OnBeforeTaskAdd($arFields){

	global $USER;
	if (CSite::InGroup (array(12, 24))) return;
	
	CModule::IncludeModule("tasks");
	
	$stopTask = true;
	
	if (!isset($arFields['MULTITASK'])){
		$arRes = array_merge((array) $arFields['RESPONSIBLE_ID'], $arFields['ACCOMPLICES'], $arFields['AUDITORS']);
		foreach($arRes as $arr){

			if(!in_array(23, CUser::GetUserGroup($arr)) && in_array(12, CUser::GetUserGroup($arr))){
				$stopTask = false;
			}
		}
		if($stopTask){
			
			return true;
		}
	}
	return false;

}
