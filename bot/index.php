<?php

header('Content-Type: text/html; charset=utf-8');
// подрубаем API
require_once("vendor/autoload.php");

// дебаг
if(true){
	error_reporting(E_ALL & ~(E_NOTICE | E_USER_NOTICE | E_DEPRECATED));
	ini_set('display_errors', 1);
}

// создаем переменную бота
$token = "411235165:AAE8F3pD6MIduXtC7PlY2hCYZRMbx29yfaI";
$bot = new \TelegramBot\Api\Client($token,null);

if($_GET["bname"] == "xname_kz_bot"){
	$bot->sendMessage("@xname_kz_bot", "Тест");
}

// если бот еще не зарегистрирован - регистируем
if(!file_exists("registered.trigger")){ 
	/**
	 * файл registered.trigger будет создаваться после регистрации бота. 
	 * если этого файла нет значит бот не зарегистрирован 
	 */
	 
	// URl текущей страницы
	$page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	$result = $bot->setWebhook($page_url);
	if($result){
		file_put_contents("registered.trigger",time()); // создаем файл дабы прекратить повторные регистрации
	} else die("ошибка регистрации");
}

// Команды бота
// пинг. Тестовая
$bot->command('ping', function ($message) use ($bot) {
	$bot->sendMessage($message->getChat()->getId(), 'pong!');
});

// обязательное. Запуск бота
$bot->command('start', function ($message) use ($bot) {
    $answer = 'Добро пожаловать!';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// обязательное. Запуск бота
$bot->command('name', function ($message) use ($bot) {
    $answer = 'Как Вас Зовут?';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// помощь
$bot->command('help', function ($message) use ($bot) {
    $answer = 'Команды:
	/help - Проводник;
	/name - Имя на латинском';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// Отлов  сообщений
$bot->on(function($Update) use ($bot){
	
	$message = $Update->getMessage();
	$mtext = $message->getText();
	$cid = $message->getChat()->getId();	
	
	$translation = translate($mtext);
	
	if($translation !== false){
		$bot->sendMessage($message->getChat()->getId(), $translation);
	}
}, function($message) use ($name){
	return true; // когда тут true - команда проходит
});

function translate($string)
{
	
	$replace = array("А"=>"A","а"=>"a","Ә"=>"A'","ә"=>"a'","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Ғ"=>"G'","ғ"=>"g'","Д"=>"D","д"=>"d",
		"Е"=>"E","е"=>"e","Ё"=>"I'O","ё"=>"i'o","Ж"=>"J","ж"=>"j","З"=>"Z","з"=>"z","И"=>"I'","и"=>"i'","Й"=>"I'","й"=>"i'","К"=>"K","к"=>"k",
		"Қ"=>"Q","қ"=>"q","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n","Ң"=>"N'","ң"=>"n'","О"=>"O","о"=>"o","Ө"=>"O'","ө"=>"o'","П"=>"P",
		"п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t","У"=>"Y'","у"=>"y'","Ф"=>"F","ф"=>"f","Х"=>"h","х"=>"h","Ц"=>"c","ц"=>"c",
		"Ч"=>"C'","ч"=>"c'","Ш"=>"S'","ш"=>"s'","Щ"=>"S'S'","щ"=>"s's'","Ұ"=>"U","ұ"=>"u","Ү"=>"U'","ү"=>"u'","Ы"=>"Y","ы"=>"y","Э"=>"E","э"=>"e","Ю"=>"I'Y'","ю"=>"i'y'","Я"=>"I'A","я"=>"i'a","ъ"=>"","ь"=>"");
		
        
	return iconv("UTF-8","UTF-8//IGNORE",strtr($string,$replace));
	
}

// запускаем обработку
$bot->run();

echo "бот";