<?
if (in_array(12, $USER->GetUserGroupArray())){
	$aMenuLinks = Array(
		Array(
			"Структура компании", 
			"/company/vis_structure.php", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Поиск сотрудника", 
			"/company/index.php", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Телефонный справочник", 
			"/company/telephones.php", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Кадровые изменения", 
			"/company/events.php", 
			Array(), 
			Array(), 
			"CBXFeatures::IsFeatureEnabled('StaffChanges')" 
		),
		Array(
			"Эффективность", 
			"/company/report.php", 
			Array(), 
			Array(), 
			"IsModuleInstalled('tasks')" 
		),
		Array(
			"Доска почета", 
			"/company/leaders.php", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Дни рождения", 
			"/company/birthdays.php", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Фотогалерея", 
			"/company/gallery/", 
			Array(), 
			Array(), 
			"" 
		),
		Array(
			"Тест", 
			"/company/personal/mail/", 
			Array(), 
			Array(), 
			"" 
		)
	);
	}else 
		{$aMenuLinks = Array(
		Array(
			"Структура компании", 
			"/company/vis_structure.php", 
			Array(), 
			Array(), 
			"" 
		)
	);
}
?>