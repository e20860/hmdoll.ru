//////////////////////////////////////////////////////////////////////////////////////////////////
//
//                                   main.js
//   Основная программа сайта hmdoll.ru
//////////////////////////////////////////////////////////////////////////////////////////////////
function main() {
   // главная функция, которая всё и делает...
   console.log("Hello, world");
  var $menu = $("#menu");
  var $menuItems = $("#menu li"); 
  // адреса страниц, составляющих сайт (наполнение article)
  urlMain = "docs/main.html";
  urlGall = "";                   // Определяется контекстом
  urlProc = "docs/process.html";
  urlPatt = "docs/pattern.html";
  urlCont = "docs/contacts.html"; 
  
  
  
  // Объявляем меню
  $menu.menu();

  // Запоминаем пункты меню в переменных
  $mn = $("#menu li:contains('Главная')");       //main
  $pg = $("#menu li:contains('Фотогалерея')");   //photo gallery
  $dl = $("#menu li:contains('Куклы')");         // dolls
  $an = $("#menu li:contains('Зверушки')");      // animals
  $pr = $("#menu li:contains('Мастер-класс')");  // process
  $pt = $("#menu li:contains('Выкройки')");      // patterns
  $ct = $("#menu li:contains('Контакты')");      // contacts
  // к переменным добавляем слушателей
    
  $mn.click(function () {
     var menuItem = $(this).text();
     manageMenu(menuItem);
  });  //
  
  $pg.click(function () {
     var menuItem = $(this).text();
     manageMenu(menuItem);
  });  //
  $dl.click(function () {
     var menuItem = $(this).text();
     manageMenu(menuItem);
  });  //
  $an.click(function () {
     var menuItem = $(this).text();
     manageMenu(menuItem);
  });  //

  $pr.click(function () {
     var menuItem = $(this).text();
     manageMenu(menuItem);
  });  //
  $pt.click(function () {
     var menuItem = $(this).text();
     manageMenu(menuItem);
  });  //
  $ct.click(function () {
     var menuItem = $(this).text();
     manageMenu(menuItem);
  });  //
  
  // Формируем первую страницу с главным меню  
  manageMenu("Главная"); 
  
  //-------------------------------------------------------------------------------------
  function fillArticle(url) {
     // заполняет раздел article страницы
      $("article").load(url);  
   }   

  function loadGallery(url) {
     // Загружает галерею картинок с указанного url
      $("article").load(url,function () { 
         $("a.fancybox").fancybox({
         transitionIn: 'elastic',
         transitionOut: 'elastic',
         speedIn: 500,
         speedOut: 500,
         hideOnOverlayClick: false,
         titlePosition: 'over'
         });
    });
  }

     
   //********************************************************************************************  
  function manageMenu(menuItem) {
      // разруливаем главное меню взависимости от menuItem 
     var $nt = $("#mmheader");
     $nt.text(menuItem);
     if ("КуклыЗверушки".indexOf(menuItem) != -1 ) {
         // Сразу к галерее, минуя перетурбации с меню
        $nt.text("Фотогалерея");
        setGallery(menuItem);
        return;
     }     
     // Убрать (деактивировать) все пункты меню
     detachAll();
     switch(menuItem) { 
        case "Главная":
           setMain();
           break;
        case "Фотогалерея":
           $menu.append($mn);
           $menu.append($dl);
           $menu.append($an);
           $menu.append($pr);
           $menu.append($pt);
           $menu.append($ct);
           setGallery("Куклы");
           break;
        case "Мастер-класс":
           setProcess();
           break;
        case "Выкройки":
           setPatterns();
           break;
        case "Контакты":
           setContacts();
           break;
     
     } //switch    
  }  // refillMenu

  //---------------------------------------------------------------------------------------
  function detachAll() {
     $mn.detach();
     $pg.detach();
     $dl.detach();
     $an.detach();
     $pr.detach();
     $pt.detach();
     $ct.detach();  
  }

  //--------------------------------------------------------------------------------------
  function setMain() {
     $menu.append($pg);
     $menu.append($pr);
     $menu.append($pt);
     $menu.append($ct);
     fillArticle(urlMain);
  } // setMain

//--------------------------------------------------------------------------------------

  function setGallery(galType) {
     if (galType.indexOf("Фото") !=-1) {
        galType = "Куклы";  // по умолчанию
     } // if
     urlGall = "docs/"+galType+".html";
     loadGallery(urlGall);   
  } // setGallery

//--------------------------------------------------------------------------------------
  
  function setProcess() {
     $menu.append($mn);
     $menu.append($pg);
     $menu.append($pt);
     $menu.append($ct);
     fillArticle(urlProc);
  } // setProcess

//--------------------------------------------------------------------------------------
  
  function setPatterns() {

     $menu.append($mn);
     $menu.append($pg);
     $menu.append($pr);
     $menu.append($ct);
     fillArticle(urlPatt);
  } // setPatterns

//--------------------------------------------------------------------------------------
  
  function setContacts() {

     $menu.append($mn);
     $menu.append($pg);
     $menu.append($pr);
     $menu.append($pt);
     fillArticle(urlCont);
  } // setContacts
   
}


///////////////////////////////////////////////////////////////////////////////////////////////////
// Собственно программа, готорая выполняется после загрузки документа
$(document).ready(main);