jQuery(document).ready(function($) {

mapImages={"C99018105": "view518_250.jpg",  "C8D919104": "view555_250.jpg", "C8633B103": "view484_250.jpg","C365F7102": "v1000MrA_250.jpg", "C19F9A99": "view156_250.jpg","BF921497": "view2001_250.jpg",
"BC8BD796": "view17_250.jpg","BA134A94": "view139_250.jpg", "B70A7992": "view93_250.jpg","B48E3E89": "view262_250.jpg","B207D888": "view216_250.jpg","AE62DD84": "view3002_250.jpg", "ADB39282": "view300s_250.jpg","A772A381":"view58_250.jpg", "A0727380": "viewblslate_250.jpg","9C29A476": "view1200_250.jpg","9B11DD75": "view1300_250.jpg","99886874": "Viewprot4_250.jpg","953ADC73": "view200_250.jpg","92247771": "vieweast_250.jpg","8B963256": "viewctralley_250.jpg","893AD355": "vlaytonlilies_250.jpg","828DA653": "vmarigny_250.jpg", "7FBCBB52": "viewital2_250.jpg","7E2C0951": "v3tombs_250.jpg","7CA6BA50": "viewfront_250.jpg","7A2F7849": "vberg_250.jpg", "77AF0E48": "views3_250.jpg", "75A03E47": "vscnA9l_04_250.jpg","74876946": "vscnA9l_06_250.jpg","736AE645": "vscnA9l_09_250.jpg", "720D0F43": "vSscn30_250.jpg","7069AB42": "vSscn33_250.jpg","6F4D6E41": "vSscn35_250.jpg","6D1FA339": "vSscn36_250.jpg", "6B64C637": "vSscn38_250.jpg","69E07B35": "vmlaveau_250.jpg","688E1A33": "vplq_250.jpg","66B07732": "vscnA9l_01_250.jpg", "656CD531": "vtourist2_250.jpg","61906229": "viewitalia1_250.jpg","5F8DE428": "views2_250.jpg","5D3A8B26": "vieww2_250.jpg", "5A8FBA24": "viewfrtrt.jpg","58C31022": "viewfrench_250.jpg","55EEE520": "Dec9_250.jpg","5406E418": "opensp2_250.jpg","52DF9F16": "opensp5.jpg","51326914": "viewprot_250.jpg","4E742712": "opensp1_250.jpg","3252FA1": "asclepgate.jpg","CCAA8E109": "view1500_250.jpg"};

$('.yourtour area').hover(function(e) {
  var offsetX = 75;
  var offsetY = 20;

  var id =  $(this).attr('id');
  var href =  '/noladeadspace.com/images/' + mapImages[$(this).attr('id')];

  $('body').$div({id:"imageContainer"}).css('top', e.pageY + -offsetY).css('left', e.pageX + offsetX).$div({id:"largeImage"})
  .$img({height:"300px",src:href});

  }, function() {
      $('#imageContainer').remove();
  });

  $('area').mousemove(function(e) {
      $("#imageContainer").css('top', e.pageY + offsetY).css('left', e.pageX + offsetX);
  });
});


$('.popup img').toggle(function(e) {
  var offsetX = 75;
  var offsetY = 20;

  var id =  $(this).attr('id');
  var href =  '/noladeadspace.com/images/' + mapImages[$(this).attr('id')];

  $('body').$div({id:"imageContainer"}).css('top', e.pageY + -offsetY).css('left', e.pageX + offsetX).$div({id:"largeImage"})
  .$img({height:"300px",src:href});

  }, function() {
      $('#imageContainer').remove();
  });

  $('area').mousemove(function(e) {
      $("#imageContainer").css('top', e.pageY + offsetY).css('left', e.pageX + offsetX);
  });
});

$('.mainImage a').mouseover(function(){
  /*swaps out image when text link is hovered over. image and text links should be in container with class "mainImage." id of div 
  should match classes of the links. href of links contain urls of images. See in action: 
  http://www.noladeadspace.com/historicalmaps, second map
  
  usage:
  <div class="mainImage" id="divid">
  <p><img alt="" name="mapswap" src="..." style="width: 400px; height: 400px; margin-left: 10px; margin-right: 10px; float: right;" /></p>

  <p><a class="divid" href="...">text</a></p>
  </div>
  */

  var id = $(this).attr("class");
  var caption = $(this).attr("title");

  $('#' + id + ' img').attr('src', $(this).attr("href"));   
  return false; 
});

  
$('.timelineMap area').mouseover(function(){
  /*see function in action: http://www.noladeadspace.com/historicalmaps, first map*/
  var id=$(this).attr("class");
  var i = $('<img />').attr('src',this.href).load(function() {
    $('#' + id + ' img').attr('src', i.attr('src'));
    $('#' + id + ' img').fadeIn();
  });
  return false; 
});

$('.mapText area').mouseover(function(){
  var $active = $('.displayText .show');
  var id = $(this).attr("id");
  var $next=$('.displayText p#' + id);
  $active.removeClass('show');//reset the z-index and unhide the image
  $next.addClass('show');//make the next image the top one};
  return false;
});

$('.mapText area').mouseout(function(){
  var $active = $('.displayText .show');
  var id = $(this).attr("id");
  var $next=$('.displayText .basetext');
  $active.removeClass('show');//reset the z-index and unhide the image
  $next.addClass('show');//make the next image the top one};
  return false;
});


$('#brushes img').mouseover(function(){   
 var href = $(this).attr("href"); 
 var id = $(this).attr("id");
 $('#colorMe img#'+id+'tomb').prop("src", href);

  return false; 
});
  
$('.rotator img').click(function(){
  /* To see in action, http://www.noladeadspace.com/focus-st-louis-cemetery-no1*/

  var $active = $('.rotator .show');
  var $next = ($active.next().length > 0) ? $active.next() : $('.rotator img:first');
  $next.css('z-index',2);//move the next image up the pile
  $active.removeClass('show');//reset the z-index and unhide the image
  $next.addClass('show');//make the next image the top one};
  return false;
});
  
$('.rotator a').click(function(e){
  /* To see in action, http://www.noladeadspace.com/focus-st-louis-cemetery-no1*/
  e.preventDefault();
  var $active = $('.rotator .show');
  var $next = ($active.next().length > 0) ? $active.next() : $('.rotator img:first');
  $next.css('z-index',2);//move the next image up the pile
  $active.removeClass('show');//reset the z-index and unhide the image
  $next.addClass('show');//make the next image the top one};
  return false;
});


$('.mainText a').mouseover(function(){
  /*This function changes the text of an image when you hover over a link. The default caption should have a class of "show." links and their captions need to have the same id. Caption container has a class of "displayText." Text links, images, and caption container should be in a container with unique ids, with the container being the direct parent of the links.
  To see in action: http://www.noladeadspace.com/tombscapes
  
  usage:
  <div class="mainText" id="containerid"><a class="" href="..." id="id1">link text</a> | <a class="" href="..." id="id2">link text</a>
  <img alt="" name="ninel" src="..."  />

  <div class="displayText">
  <p class="caption show" id="id1">caption</p>
  <p class="caption" id="id2">caption</p>
  </div></div>
  */
  var $parent = $(this).parent().parent().attr("id");
  var $active = $('#' + $parent + ' .displayText .show');
  var $id = $(this).attr("id");
  var $next=$('#' + $parent + ' .displayText p#' + $id);
  $active.removeClass('show');//reset the z-index and unhide the image
  $next.addClass('show');//make the next image the top one};
  return false;
  });

$('.contentcycler a').click(function(){
  /* Here, I needed to cycle through text and images together, so I could not just use the rotator function.
  to see in action: http://www.noladeadspace.com/decay-scenarios
  */
  var $current = ($('div.contentcycler .show')? $('div.contentcycler .show') : $('div.contentcycler > div:first'));
  var $class = $(this).attr("class");

  if ($class=='next'){
    if ($current.next().length != 0) var $next = $current.next();
    else $next = $('div.contentcycler > div:first');
    }
  if ($class=='prev'){
    if (!$current.hasClass('start')) var $next = $current.prev();
    else $next = $('div.contentcycler > div:last');
    }      
  $current.removeClass('show');//reset the z-index and unhide the image
  $next.addClass('show');//make the next image the top one};
  return false;
);
