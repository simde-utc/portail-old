<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=238586716159701";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="photo_viewer" style="background-color:white; z-index:1000;">
<div class="span6 main-image">
<?php echo showThumb($photo->getImage(), 'galeries', array(
      'width' => 1000,
      'height' => 1000,
      'onclick' => '$(".nextpict")[0].click();'
    ), 'scale') ?>
</div>
  <div class="photo_meta_infos span2">
    <div class="photo-meta-galerie">
      <h2><?php echo $galerie ?></h2>
    </div>
    <div class="photo-meta-author">
      Par <?php echo $author; ?>
    </div>

    <!-- Photo title -->
    <div class="photo-meta-title">
      <?php echo $photo->getTitle() ?>
    </div>

    <!-- Previous and Next Photo button-->
    <div class="photo-prev-next-pict">
          
      <?php foreach ($nextPict as $Button): ?>
        Suivant :
        <a class="photo-samegalery nextpict"  href="<?php echo url_for('photo/show?id='.$Button->getId()) ?>">
          <?php echo showThumb($Button->getImage(), 'galeries', array(
          'width' => 80,
          'height' => 80), 
          'center') ?> 
        </a>
      <?php endforeach; ?>

      
       <?php foreach ($prevPict as $Button): ?>
        Precedent :
        <a class="photo-samegalery prevpict" href="<?php echo url_for('photo/show?id='.$Button->getId())  ?>">
          <?php echo showThumb($Button->getImage(), 'galeries', array(
          'width' => 80,
          'height' => 80), 
          'center') ?> 
        </a>
      <?php endforeach; ?>

    </div>
    <div>
    <a class="photo-fullscreen-button" href="#fullscreen" onclick="switchFullScreen();">Plein Ecran</a>
    </div>
    <div class="photo-edit-button">
    <a href="<?php echo url_for('photo/edit?id='.$photo->getId()) ?>">Editer</a>
    </div>
    <div class="photo-like-button">
      <div class="fb-like" data-href="http://assos.utc.fr/photo/show/<?php
      echo $photo->getId() . "?pass=" . $passCode;
       ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    </div>
  </div>


</div>

<style>
.photo_viewer {text-align:center;}
.photo_meta_infos>div {margin:40px;}
</style>

<script type="text/javascript">
$(document).keydown(function(e){
    if (e.keyCode == 37) // prev
      $(".prevpict")[0].click();
    if (e.keyCode == 39) // next
      $(".nextpict")[0].click();
    })

function fullscreenSizing(){
  $(".photo_viewer").css("position","fixed");
    $(".photo_viewer").css("top","0px");
    $(".photo_viewer").css("left","0px");
    $(".photo_viewer").css("width", $(window).width());
    $(".photo_viewer").css("height", $(window).height());

    var ratio = $(".main-image img").height()/($(".photo_viewer").height()-10);
    if(ratio>1){
      $(".main-image img").height($(".main-image img").height()/ratio);
      $(".main-image img").width($(".main-image img").width()/ratio);
    }
}

function switchFullScreen(){
    $(".photo_viewer .span2").removeClass('span2').addClass('span2'); 
    $(".photo_viewer .span6").removeClass('span6').addClass('span10');

  $(document).keyup(function(e){
    if (e.keyCode == 27) // prev
      $(".photo-fullscreen-button")[0].click();
  })
    
    $.each(
      $(".photo-samegalery"),
      function(osef, link){
        $(link).attr("href", $(link).attr('href') + "#fullscreen");
      })
    setTimeout(function () {
      $(".photo-fullscreen-button").attr("href", location.href.replace(location.hash,""));
      $(window).on('hashchange', function() {
          window.location=location.href.replace(location.hash,"");
      })

      }
    , 100);
    $(window).resize(fullscreenSizing)
    fullscreenSizing();
    setTimeout(fullscreenSizing, 10)

  }

  $(function(){
    if(window.location.hash)
      switchFullScreen();
  })

</script>