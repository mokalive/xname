/var arrru = new Array ("Ғ","ғ","Қ","қ","Ү","ү","Ұ","ұ","Ә","ә",'І','і','Я','я','Ю','ю','Ч','ч','Ш','ш','Ж','ж','А','а','Б','б','В','в','Г','г','Д','д','Е','е','Ё','ё','З','з','И','и','Й','й','К','к','Л','л','М','м','Н','н','Ң','ң', 'О','о','П','п','Р','р','С','с','Т','т','У','у','Ф','ф','Х','х','һ','Ц','ц','Ы','ы','Ь','ь','Ъ','ъ','Э','э');

var arren = new Array ("G'","g'","Q","q","U'","u'","U","u","A'","a'",'I','i',"I'a","i'a","I'u'","i'u'","C'","c'","S'","s'",'J','j','A','a','B','b','V','v','G','g','D','d','E','e','E','e','Z','z',"I'","i'","I'","i'",'K','k','L','l','M','m','N','n',"N'","n'",'O','o','P','p','R','r','S','s','T','t',"Y'","y'",'F','f','H','h','h','C','c','Y','y','`','`','\'','\'','E', 'e');

function cyrill_to_latin(text){
	for(var i=0; i<arrru.length; i++){
		var reg = new RegExp(arrru[i], "g");
		text = text.replace(reg, arren[i]);
    }
	return text;
}

function transliter(){
	$("[name=result]").val(cyrill_to_latin($("[name=translit]").val()));
	$(".rotate").click(function(){
    $(this).toggleClass("down"); 
    });
}

