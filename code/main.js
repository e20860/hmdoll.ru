//////////////////////////////////////////////////////////////////////////////////////////////////
//
//                                   pattern.js
//   шаблон программы
//////////////////////////////////////////////////////////////////////////////////////////////////
function main() {
   // главная функция, которая всё и делает...
   console.log("Hello, world");
  var $menu = $("#menu");
  var $menuItems = $("#menu li"); 

  // Объявляем меню
  $menu.menu();

  // Запоминаем пункты меню в переменных
  $mn = $("#menu li:contains('Главная')");       //main
  $pg = $("#menu li:contains('Фотогалерея')");   //photo gallery
  $gl = $("#menu li:contains('Девочки')");       // girls
  $by = $("#menu li:contains('Мальчики')");      // boys
  $an = $("#menu li:contains('Зверушки')");      // animals
  $pr = $("#menu li:contains('Процесс')");       // process
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
  $gl.click(function () {
     var menuItem = $(this).text();
     manageMenu(menuItem);
  });  //
  $by.click(function () {
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

     
   //********************************************************************************************  
  function manageMenu(menuItem) {
      // разруливаем главное меню взависимости от menuItem 
     var $nt = $("#navitext");
     $nt.text(menuItem);
     if ("МальчикиДевочкиЗверушки".indexOf(menuItem) != -1 ) {
         // Сразу к галерее, минуя перетурбации с меню
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
           $menu.append($gl);
           $menu.append($by);
           $menu.append($an);
           $menu.append($pr);
           $menu.append($pt);
           $menu.append($ct);
           setGallery("Девочки");
           break;
        case "Процесс":
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
     $gl.detach();
     $by.detach();
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
     
  } // setMain

//--------------------------------------------------------------------------------------

  function setGallery(galType) {

     
  } // setGallery

//--------------------------------------------------------------------------------------
  
  function setProcess() {
     $menu.append($mn);
     $menu.append($pg);
     $menu.append($pt);
     $menu.append($ct);
     
  } // setProcess

//--------------------------------------------------------------------------------------
  
  function setPatterns() {

     $menu.append($mn);
     $menu.append($pg);
     $menu.append($pr);
     $menu.append($ct);
     
  } // setPatterns

//--------------------------------------------------------------------------------------
  
  function setContacts() {

     $menu.append($mn);
     $menu.append($pg);
     $menu.append($pr);
     $menu.append($pt);
     
  } // setContacts
   
}


///////////////////////////////////////////////////////////////////////////////////////////////////
// Собственно программа, готорая выполняется после загрузки документа
$(document).ready(main);