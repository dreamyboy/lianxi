//menu
$(document).ready(function(){
  
  $('li.mainlevel').mousemove(function(){
  $(this).find('ul').stop(true,true).slideDown(5);//you can give it a speed
  });
  $('li.mainlevel').mouseleave(function(){
  $(this).find('ul').stop(true,true).slideUp("fast");
  });
  
});