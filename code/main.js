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
  
  // Слушатель главного меню
  $menuItems.click(function () {
     var menuItem = $(this).text();
     var $nt = $("#navitext");
     $nt.text(menuItem);
     manageMenu(menuItem);
  });  //#menu li
  
  
  function manageMenu(menuItem) {
      // разруливаем главное меню взависимости от menuItem 
      if ("МальчикиДевочкиЗверушки".indexOf(menuItem) != -1 ) return;  // Ничего в меню не меняем    

     switch(menuItem) { 
        case "Главная":
           break;
        case "Фотогалерея":
           break;
        case "Процесс":
           break;
        case "Выкройки":
           break;
        case "Контакты":
           $("article").empty();
           break;
     
     } //switch    
  }  // refillMenu

  function setMain() {
     
  } // setMain

  function setGallery(galType) {
     
  } // setGallery
  
  function setProcess() {
     
  } // setProcess
  
  function setPatterns() {
     
  } // setPatterns
  
  function setContacts() {
     
  } // setContacts
   
}


///////////////////////////////////////////////////////////////////////////////////////////////////
// Собственно программа, готорая выполняется после загрузки документа
$(document).ready(main);