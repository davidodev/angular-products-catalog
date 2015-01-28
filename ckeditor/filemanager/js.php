<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>


<?php if ($_GET['t'] == 'settings') { ?> 
<script src="js/ajaxupload.3.6.js"></script>
<?php } ?> 
<?php if ($_GET['t'] == 'gallery') { ?> 
<script src="js/jquery.session.js"></script>
<?php } ?> 

<script src="ckeditor/ckeditor.js"></script>
<script src="js/scrollTo-1.4.5.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
     
     $('.remove-page').live('click', function(){
          
          var r = confirm('Czy napewno usunąć?');
          
          if (r != true)
               return false;
     });

});

<?php if ($_GET['t'] == 'catalog') { ?> 
     
$(document).ready(function(){
     
     $('.dodaj-zakladke').on('click', function(){
          
          var ItemNextId = $('#tabContainer .tab-item').length + 1;
          var itemClose   = '<img class="delete-tab jquery" src="images/delete.png" alt="" />';
          var itemLabel   = '<label>Zakładka ' + ItemNextId + ':</label>';     
          var itemTitle   = '<input type="text" maxlenght="50" value="Nazwa zakładki" name="tab[' + ItemNextId + '][name]" />';
          var itemContent = '<textarea class="ckeditor" id="tab-' + ItemNextId + '" name="tab[' + ItemNextId + '][content]"></textarea>';
          
          if(ItemNextId >= <?php echo MAX_TAB; ?> + 1){
               
               alert('Maxymalna ilość zakładek została osiągnięta');
               
          }else {
               
               $('#tabContainer').append('<div class="tab-item">' + itemClose + '<div class="tab-title">' + itemLabel + itemTitle + '</div>' + itemContent + '</div>');
               CKEDITOR.replace( 'tab-' + ItemNextId );
               
          }
          return false;
          
     });
     
     $('.delete-tab').on('click', function(){
          $(this).parent().remove();
     });
     
     $('.delete-tab.jquery').live('click', function(){
          $(this).parent().remove();
     });
     
     
<?php if (isset($_GET['iid_asd']) || isset($_GET['cid_asd'])) { // only product off ?> 
     var button = $('#menu-photo-add'), interval;
     
         new AjaxUpload(button,{
             action: 'index.php?t=content&action=load-images&noheader=true',
             data: {folder: folderImage, folderm: folderImageM, 'sizex' : sizeXImage, 'sizey' : sizeYImage},
             name: 'file',
             onSubmit : function(file, ext){
               $('div#wait').show();
                 //this.disable();
             },
             onComplete: function(file, response){
                 //this.enable();
                 //var FilesLength   = $('#annex-wrap .files .inner').find('p').length;
                 //if(FilesLength < 2) {
                         //$('.annex-add').html('[+] Dodaj kolejny');
                 //   }
                 var data = eval("("+response+")"); //parse json
                 if(data.filename != 'format'){
                    $('#photo-cont').html('<li class="item"><img src="../' + folderImageM + data.filename +'" />' 
                                        
                                        + '<a class="icons icons-delete" href="" title="Usuń zdjęcie"></a>' 
                                        + '<input type="hidden" name="photo" value="' + folderImage + data.filename +'" />'
                                        + '</li>');
                 
                 }else
                    alert('Niedozwolony format pliku!');
                    
                    
                 $('div#wait').hide(); 
             }
         });
         
          
<?php } ?>
<?php if (isset($_GET['iid_asd'])) { // only product off ?> 

     var button2 = $('#menu-photo-add-2'), interval;
     
         new AjaxUpload(button2,{
             action: 'index.php?t=content&action=load-images&noheader=true',
             data: {folder: folderImage, folderm: folderImageM, 'sizex' : sizeXImage, 'sizey' : sizeYImage},
             name: 'file',
             onSubmit : function(file, ext){
               $('div#wait').show();

             },
             onComplete: function(file, response){
                 //this.enable();
                 //var FilesLength   = $('#annex-wrap .files .inner').find('p').length;
                 //if(FilesLength < 2) {
                         //$('.annex-add').html('[+] Dodaj kolejny');
                 //   }
                 var data = eval("("+response+")"); //parse json
                 if(data.filename != 'format'){
                    $('#photo-cont-2').prepend('<li class="item"><img src="../' + folderImageM + data.filename +'" />'
                    
                         + '<a class="icons icons-delete" href="" title="Usuń zdjęcie"></a>'
                         + '<input type="hidden" name="photos[]" value="' + folderImage + data.filename +'" />'
                         + '</li>');
                    
                 }else
                    alert('Niedozwolony format pliku!');
                    
                    
                 $('div#wait').hide(); 
               
             }
         });
          
<?php } ?> 


         $('input[name=meta]').change(function() {
               
               $this = jQuery(this);
               
               valuexx = $this.val();
               
               if(valuexx == '0')
                    $('input[name=meta_title], input[name=meta_description], input[name=meta_keywords]').attr('readonly', 'readonly');
               else
                    $('input[name=meta_title], input[name=meta_description], input[name=meta_keywords]').removeAttr('readonly');
          });


         $('.catalog #photo-cont, .catalog #photo-cont-2').on('click', '.item a', function(e){
              
              $(this).parent().remove();
              
              e.preventDefault();
         });
         
         
         $( ".catalog #photo-cont-2" ).sortable();
         $( ".catalog #photo-cont-2" ).disableSelection();
         
<?php if ($_GET['action'] == 'settings-catalog') { ?> 
         
         
         $('input[type=checkbox]').change(function(){
              if($(this).is(":checked")){
                   
                   $(this).val(1);
                   
              }else{
                   
                   $(this).val(0);
              }
                   
         });
         
<?php } ?> 
          
});     
     

<?php }else if($_GET['t'] == 'news-photo'){ ?>

     $(document).ready(function(){
       
          $( ".datapicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
          });
            
          $.datepicker.regional['pl'] = {
                closeText: 'Zamknij',
                prevText: '&#x3c;Poprzedni',
                nextText: 'Następny&#x3e;',
                currentText: 'Dziś',
                monthNames: ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec',
                'Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'],
                monthNamesShort: ['Sty','Lu','Mar','Kw','Maj','Cze',
                'Lip','Sie','Wrz','Pa','Lis','Gru'],
                dayNames: ['Niedziela','Poniedzialek','Wtorek','Środa','Czwartek','Piątek','Sobota'],
                dayNamesShort: ['Nie','Pn','Wt','Śr','Czw','Pt','So'],
                dayNamesMin: ['N','Pn','Wt','Śr','Cz','Pt','So'],
                weekHeader: 'Tydz',
                dateFormat: 'yy-mm-dd',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
          $.datepicker.setDefaults($.datepicker.regional['pl']);
     
     });

<?php }else if($_GET['t'] == 'gallery' ){  ?>
     

     var folderImage = "<?php echo $image_path; ?>";
     var folderImageM = "<?php echo $_IMAGE['thumb']; ?>";
     
     $(document).ready(function(){
          
          $('.gallery #gallery-sort').on('click', '.item a', function(e){
               
               var $item = $(this).parent().parent();
               if($item.hasClass('todelete')){
                    $item.fadeTo('slow', 1).removeClass('todelete');
                    $item.find('input.delete').val('');
               }else {
                    $item.fadeTo('slow', 0.3).addClass('todelete');
                    $item.find('input.delete').val(true);
               }
              
              e.preventDefault();
              
          });
          
          $( "#gallery-sort" ).sortable();
          //$( "#gallery-sort" ).disableSelection();
          
          
          
          var small_x = <?php echo $_SESSION['KCFINDER']['smallSizeWidth']; ?>;
          var small_y = <?php echo $_SESSION['KCFINDER']['smallSizeHeight']; ?>;
          
          $('input[name=thumb_x]').on('focus blur', function(e){
               
               if(e.type == 'focus'){
                    $(this).select();
               }else{
                    $(this).select().select();
                    $('input[name=thumb_y]').focus().select();
               }
          });
          
          $('input[name=thumb_y]').on('blur', function(e){
               
               var thumbx = $("input[name=thumb_x]").val();
               var thumby = $("input[name=thumb_y]").val();
               
               $.post('index.php?t=gallery&action=ajax-set-vars&noheader=true', {"thumb_x": thumbx, "thumb_y": thumby})
               .done(function(data){
                    
                    if (thumbx != small_x || thumby != small_y){
                         
                         $('#confirm-image-resize').modal('show');
                         
                    }
                    console.log('szerokość: ' + thumbx);
                    console.log('wysokość: ' + thumby);
                    
               });
          });
          
          
          $('#confirm-image-resize .btn-primary').on('click', function(){
               
               $('#confirm-image-resize').modal('hide');
               
               $('#confirm-image-resize').on('hidden.bs.modal', function (e) {
                 $('#image-resize-progress').modal('show');
               });
               
               $('#gallery-sort li').each(function(e){
                    var itemLength = $('#gallery-sort li').length();
                    var filePath =  $(this).find('.thumb-wrap input[type=hidden]').val();
                    
                    $.post('ckeditor/filemanager/upload.php?resize-thumb=true', { "file": filePath}, function( data ){}, 'json')
                    .done(function(data){
                         
                         console.log('resize: ' + data.success);
                         
                    });
                    
               });
          });
          
          
          
          var large_x = <?php echo $_SESSION['KCFINDER']['largeSizeWidth']; ?>;
          var large_y = <?php echo $_SESSION['KCFINDER']['largeSizeHeight']; ?>;
          
          $('input[name=photo_x]').on('focus blur', function(e){
               
               if(e.type == 'focus'){
                    $(this).select();
               }else{
                    $(this).select().select();
                    $('input[name=photo_y]').focus().select();
               }
          });
          
          $('input[name=photo_y]').on('blur', function(e){
               
               var photox = $("input[name=photo_x]").val();
               var photoy = $("input[name=photo_y]").val();
               
               $.post('index.php?t=gallery&action=ajax-set-vars&noheader=true', {"photo_x": photox, "photo_y": photoy})
               .done(function(data){
                    
                    if (photox != large_x || photoy != large_y){
                         
                         $('#confirm-image-resize').modal('show');
                         
                    }
                    
               });
          });
          
          $('#confirm-image-resize .btn-primary').on('click', function(){
               
               $('#confirm-image-resize').modal('hide');
               
               $('#confirm-image-resize').on('hidden.bs.modal', function (e) {
                 $('#image-resize-progress').modal('show');
               });
               
               $('#gallery-sort li').each(function(e){
                    var itemLength = $('#gallery-sort li').length();
                    var filePath =  $(this).find('.thumb-wrap input[type=hidden]').val();
                    
                    $.post('ckeditor/filemanager/upload.php?resize-large=true', { "file": filePath}, function( data ){}, 'json')
                    .done(function(data){
                         
                         console.log('resize: ' + data.success);
                         
                    });
                    
               });
          });
          
          
          
          $("input[name=thumb_ratio]").change(function(){
               
               $.post('index.php?t=gallery&action=ajax-set-vars&noheader=true', {thumb_ratio: true})
                .done(function(data){
                    
                    console.log('zachowaj proporcje'); 
                    
               });
          });
          
          
     });
     
     
     
     function openKCFinder(div) {
     
     
         window.KCFinder = {
             callBack: function(url) {
                 window.KCFinder = null;
                 
                 $('#wait').show();
                 newurl = url.substring(1, url.length);
                 var img = new Image();
                 //alert(newurl);
                 img.src = '../' + newurl;
                 
                 img.onload = function() {
                    
                    var filename = newurl.substring(newurl.indexOf('/')+1);
                    
                    $('#gallery-sort').prepend(
                              printItemGallery(folderImageM, filename, newurl)
                              );

                    $('div#wait').hide();
                 }
             },
             callBackMultiple: function(url) {
                 window.KCFinder = null;
                 $('#wait').show();
                     
                     console.log(url);
                     var html = '';
                 for (var i = 0; i < url.length; i++){
                      
                      var turl = url[i];     
                      
                      var newurl = turl.substring(1, turl.length);
                      
                      var img = new Image();
                      //alert(newurl);
                      img.src = '../' + newurl;
                      
                      var filename = newurl.substring(newurl.indexOf('/')+1);
                      html += printItemGallery(folderImageM, filename, newurl);
                      
                 }
                 $('#gallery-sort').prepend(html);
                 $('div#wait').hide();
                 
                 
             }
         };
         
         window.open('ckeditor/filemanager/browse.php?type=images&langCode=pl',
             'kcfinder_multiple', "status=0, directories=0, resizable=1, top=200, left=200, width="+ (screen.width - 400) +", height= "+ (screen.height - 400) +", scrollbars=0"
         );
     }
     

     
     function printItemGallery(folder,name,url){
          
          html =
                  '<li class="item clearfix">'
                + '  <div class="thumb-wrap">'
                + '      <img src="../' + folder + name + '" />'
                + '      <a class="icons icons-delete" href="" title="Usuń zdjęcie"></a>'
                + '      <input type="hidden" name="gallery[photos][]" value="' + url +'" />'
                + '  </div>'
                + '  <div class="desc-wrap">'
                + '      <div class="clearfix name-wrap">'
                + '           <input class="name" placeholder="Nazwa zdjęcia" type="text" name="gallery[names][]" value="" />'
                + '           <input class="alt" placeholder="Alt" type="text" name="gallery[alts][]" value="" />'
                + '           <input class="delete" type="hidden" name="gallery[photo_delete][]" value="" />'
                + '           <input type="hidden" name="gallery[photo_ids][]" value="" />'
                + '      </div>'
                + '      <textarea class="desc" placeholder="Opis" name="gallery[desc][]"></textarea>'
                + '  </div>'
                + '</li>';
                
          return html;
     }
     
     
<?php } if($_GET['t'] == 'content' && ($_GET['action'] == 'edit-item' || $_GET['action'] == 'add-new-item')){ ?>
     
     $(document).ready(function(){
     
     //attach the change event to the type select
     $('select#select-content-type').change(function() {
          $this = jQuery(this);
          $loadWrap = jQuery('#content-wrap');
          
          jQuery.ajax({
                    url: admin_url+'&action=get-content-type&noheader=true&type='+$this.attr('value')+'&id=<?php echo $_GET['id']; ?>&lid=<?php echo $_GET['lid']; ?>',
                    dataType: 'json',
                    data: '',
                    beforeSend: function(jqXHR, settings) {
                         $this.attr('disabled', true);
                    },
                    success: function(data, textStatus, jqXHR) {
                         if(data.success) {
                              
                              var html = '';
                              
                              html += data.html;
                              $loadWrap.html(html);
                              
                         }else{
                              
                              $loadWrap.html('Wystąpił błąd');
                              $loadWrap.delay(2500).fadeOut();
                              
                         }
                         $this.attr('disabled', false); 
                         
                    }
          });
     });
     
     });
     
     <?php } elseif($_GET['t'] == 'content' && ( $_GET['action'] == 'add-new-category' || $_GET['action'] == 'edit-category')){  ?>
     
     $(document).ready(function(){
     
          $('select#select-content-type').change(function() {
               $this = jQuery(this);
               $loadWrap = jQuery('#content-wrap');
               
               jQuery.ajax({
                         url: admin_url+'&action=get-type-category&noheader=true&type='+$this.attr('value'),
                         dataType: 'json',
                         data: '',
                         beforeSend: function(jqXHR, settings) {
                              $this.attr('disabled', true);
                         },
                         success: function(data, textStatus, jqXHR) {
                              if(data.success) {
                                   
                                   var html = '';
                                   
                                   html += data.html;
                                   $loadWrap.html(html);
                                   
                              }else{
                                   $loadWrap.html('Wystąpił błąd');
                                   $loadWrap.delay(2500).fadeOut();
                              }
                              $this.attr('disabled', false); 
                              
                         }
               });
          });
     
     });
     
     
     //$('select#select-size-image').change(function() {
     //     $this = jQuery(this);
     //     $loadWrap = jQuery('#content-wrap');
          
     //});

<?php } ?>

     $(document).ready(function(){

    $('input[type="submit"],input[type="radio"],input[type="button"]').hover(
        function() {$(this).css('cursor','pointer');}, 
        function() {$(this).css('cursor','auto');}
    );    
    
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection(); 
    $( ".sortable" ).sortable();
    $( ".sortable" ).disableSelection(); 
    
     jQuery('a.toggle').on('click', function(){
          
        var link = jQuery(this).attr('href');
        jQuery(link).toggle();
          
        return false;
     });
     
     if (jQuery(this).scrollTop() > 60) {
          jQuery('body').addClass('header-fixed');
     } else {
          jQuery('body').removeClass('header-fixed');
     }
     
     jQuery(window).scroll(function () {
          if (jQuery(this).scrollTop() > 60) {
               jQuery('body').addClass('header-fixed');
          } else {
               jQuery('body').removeClass('header-fixed');
          }
     });
          

});


<?php if ($_GET['t'] == 'structure') { ?> 
     
         function FormCheckAdd(){
                                if (top.formularz.subtitle.value == '') {alert('<?php echo L_TITLE_COMMENT; ?>');return false;}
                                }
                    
          function showItem(value){
              if (value=='meta') {
                  document.getElementById('meta').style.display = 'block'
                  document.getElementById('LinkOn').style.display = 'none'
                  document.getElementById('LinkOf').style.display = 'block'
              }
          }
          
          function hideItem(value){
              if (value=='meta') {
                  document.getElementById('meta').style.display = 'none'
                  document.getElementById('LinkOf').style.display = 'none'
                  document.getElementById('LinkOn').style.display = 'block'
              }
          }
          
          
          
$(document).ready(function(){
          
     $('select#select-content-template').change(function() {
          $this = jQuery(this);
          $loadWrap = jQuery('#content-wrap');
          
          jQuery.ajax({
                    url: 'index.php?t=structure&action=ajax-get-template&id=<?php echo $_GET['id']; ?>&noheader=true&type='+$this.attr('value'),
                    dataType: 'json',
                    data: '',
                    beforeSend: function(jqXHR, settings) {
                         $this.attr('disabled', true);
                    },
                    success: function(data, textStatus, jqXHR) {
                         if(data.success) {
                              
                              var html = '';
                              
                              html += data.html;
                              $loadWrap.html(html);
                              
                         }else{
                              $loadWrap.html('Wystąpił błąd');
                              $loadWrap.delay(2500).fadeOut();
                         }
                         $this.attr('disabled', false); 
                         
                    }
          });
     });
     
     
     
     $('input[name=meta]').change(function() {
          
          $this = jQuery(this);
          
          valuexx = $this.val();
          
          if(valuexx == '0')
               $('input[name=meta_title], input[name=meta_description], input[name=meta_keywords]').attr('readonly', 'readonly');
          else
               $('input[name=meta_title], input[name=meta_description], input[name=meta_keywords]').removeAttr('readonly');
     });
     
     
     
     $('.cke_bottom').live('mouseleave mouseover', function(e){
          
          if(e.type == 'mouseleave'){
          var thisCke  = $(this).parent().find('.cke_contents');
          
          
          $('.cke_contents').css('height', thisCke.css('height'));
          $('.box-height').val(thisCke.css('height'));
          }
          
     });
     
     
}); 

<?php } ?>
<?php if ($_GET['t'] == 'settings') { ?> 
     
$(document).ready(function(){
     
     $('a.lang-add').on('click',function() {
          $this = jQuery(this);
          $loadWrap = jQuery('#ajax-page-container');
          var count = jQuery('#ajax-page-container > div').length;
          
          jQuery.ajax({
                    url: 'index.php?t=settings&action=ajax-add-lang&noheader=true&count=' + count,
                    dataType: 'json',
                    data: '',
                    beforeSend: function(jqXHR, settings) {
                         //$this.attr('disabled', true);
                    },
                    success: function(data, textStatus, jqXHR) {
                         if(data.success) {
                              
                              var html = '';
                              
                              html += data.html;
                              $loadWrap.append(html);
                              
                         }else{
                              $loadWrap.append('Wystąpił błąd');
                              $loadWrap.delay(2500).fadeOut();
                         }
                         //$this.attr('disabled', false); 
                         
                    }
          });
          
          return false;
     });
     
     
     
     var folderImage = "files/images/logo/";
     var folderImageM = "files/thumbs/images/logo/";
     <?php if(DIR_TEMPLATE != 'template'){ // jesli uklad kadruj logo ?>
     var sizeXImage = 250;
     var sizeYImage = 150;
     <?php }else{ ?>
     var sizeXImage = '';
     var sizeYImage = '';
     <?php } ?>
     
     var button = $('#logo-add'), interval;
     
         new AjaxUpload(button,{
             action: 'index.php?t=settings&action=load-images&noheader=true',
             data: {folder: folderImage, folderm: folderImageM, 'sizex' : sizeXImage, 'sizey' : sizeYImage},
             name: 'file',
             onSubmit : function(file, ext){
               $('div#wait').show();
                 this.disable();
             },
             onComplete: function(file, response){
                 //this.enable();
                 //var FilesLength   = $('#annex-wrap .files .inner').find('p').length;
                 //if(FilesLength < 2) {
                         //$('.annex-add').html('[+] Dodaj kolejny');
                 //   }
                 var data = eval("("+response+")"); //parse json
                 if(data.filename != 'format'){
                    $('#photo-cont').html('<img src="../' + folderImage + data.filename +'" />');
                    $('#logo-save').val(folderImage + data.filename);
                 }else
                    alert('Niedozwolony format pliku!');
                    
                    
                 $('div#wait').hide(); 
                 this.enable();
             }
         });


            var greenStyle = new Object();
                 greenStyle['name'] = 'green';
                 greenStyle['1']    = '#9bc225';
                 greenStyle['2']    = '#2C3E10';
                 greenStyle['1-text']    = '#fff';
                 greenStyle['2-text']    = '#F1F8DC';
                 greenStyle['footer']    = '';
                 

                 
                 
            var blueStyle = new Object();
                 blueStyle['name'] = 'blue';
                 blueStyle['1']    = '#26A2D7';
                 blueStyle['2']    = '#143851';
                 blueStyle['1-text']    = '#fff';
                 blueStyle['2-text']    = '#e9f4f8';
                 blueStyle['footer']    = '';
                 
                 
            var yelowStyle = new Object();
                 yelowStyle['name'] = 'yelow';
                 yelowStyle['1']    = '#FFB200';
                 yelowStyle['2']    = '#D56001';
                 yelowStyle['1-text']    = '#fff';
                 yelowStyle['2-text']    = '#f8f2e5';
                 yelowStyle['footer']    = '';
                 
                 
            var redStyle = new Object();
                 redStyle['name'] = 'red';
                 redStyle['1']    = '#DE2528';
                 redStyle['2']    = '#571A13';
                 redStyle['1-text']    = '#fff';
                 redStyle['2-text']    = '#F9DBDC';
                 redStyle['footer']    = '';
                 
                 
            var brownStyle = new Object();
                 brownStyle['name'] = 'brown';
                 brownStyle['1']    = '#AD957A';
                 brownStyle['2']    = '#514A3D';
                 brownStyle['1-text']    = '#fff';
                 brownStyle['2-text']    = '#EFEAE5';
                 brownStyle['footer']    = '';
                 
                 
            var grayStyle = new Object();
                 grayStyle['name'] = 'gray';
                 grayStyle['1']    = '#BCBCBC';
                 grayStyle['2']    = '#3F3F3F';
                 grayStyle['1-text']    = '#fff';
                 grayStyle['2-text']    = '#EAEAEA';
                 grayStyle['footer']    = '';
         

            jQuery('#color-wrap a').click(function(){
            
                 var $this = $(this);
                 
                 var href = $this.attr('href');
                 

                 jQuery('#color-wrap a').removeClass('current');
                 jQuery(this).addClass('current');
                 
                 var style = href.substr(1,href.length);
                 
                 switch (style) {
                      case 'green':
                         addStyle(greenStyle, true);
                        break;
                      case 'blue':
                        addStyle(blueStyle, true);
                        break;
                      case 'yelow':
                        addStyle(yelowStyle, true);
                        break;
                      case 'red':
                        addStyle(redStyle, true);
                        break;
                      case 'brown':
                        addStyle(brownStyle, true);
                        break;
                      case 'gray':
                        addStyle(grayStyle, true);
                        break;

                 }
                 
                 return false;

            });
            
               function addStyle (style, setColor){
                    
                      jQuery('#color-theme-1').val(style['1']);
                      jQuery('#color-theme-2').val(style['2']);
                      jQuery('#color-theme-text-1').val(style['1-text']);
                      jQuery('#color-theme-text-2').val(style['2-text']);
               }
     
     
}); 
   
<?php } ?>
</script>


