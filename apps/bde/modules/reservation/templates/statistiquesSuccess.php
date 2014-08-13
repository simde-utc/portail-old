<?php use_javascript('jquery-1.7.2.min.js') ?>
<?php use_javascript('chart.js') ?>
<?php include_partial("insideMenu",array("param" => $param)) ?>


<script type="text/javascript">

  $( document ).ready(function() {

        var width=$( window ).width();
        $("#statSalle").attr("width",width*4/10-20);
        $("#statPole").attr("width",width*4/10-20);
        $("#statJour").attr("width",width*4/10-20);
        $("#statMois").attr("width",width*4/10-20);

        $("#statAsso").attr("width",width*8/10);

  
    var ctx1 = $("#statSalle").get(0).getContext("2d");
    var ctx2 = $("#statPole").get(0).getContext("2d");
    var ctx3 = $("#statAsso").get(0).getContext("2d");
    var ctx4 = $("#statJour").get(0).getContext("2d");
    var ctx5 = $("#statMois").get(0).getContext("2d");
     
    $.ajax({
         url: "<?php echo url_for('reservations_statSalle',array('sf_format'=>'json')) ?>",
      dataType: "json",
      success : function (results)
      {
      
        var data = results[0];
        var max_val = Math.max.apply(Math, data.datasets[0].data)

        var statSalle = new Chart(ctx1).Bar(data, {
            scaleOverride: true,
            scaleSteps: max_val,
            scaleStepWidth: 1,
            scaleStartValue: 0
        });
      }
    });

    $.ajax({
         url: "<?php echo url_for('reservations_statPole',array('sf_format'=>'json')) ?>",
      dataType: "json",
      success : function (results)
      {
        var data = results[0];
        var max_val = Math.max.apply(Math, data.datasets[0].data)

        var statSalle = new Chart(ctx2).Bar(data, {
            scaleOverride: true,
            scaleSteps: max_val,
            scaleStepWidth: 1,
            scaleStartValue: 0
        });
      }
    });

    $.ajax({
         url: "<?php echo url_for('reservations_statAsso',array('sf_format'=>'json')) ?>",
      dataType: "json",
      success : function (results)
      {
        var data = results[0];
        var max_val = Math.max.apply(Math, data.datasets[0].data)

        var statSalle = new Chart(ctx3).Bar(data, {
            scaleOverride: true,
            scaleSteps: max_val,
            scaleStepWidth: 1,
            scaleStartValue: 0
        });
      }
    });

    $.ajax({
         url: "<?php echo url_for('reservations_statJour',array('sf_format'=>'json')) ?>",
      dataType: "json",
      success : function (results)
      {
        var data = results[0];
        var max_val = Math.max.apply(Math, data.datasets[0].data)

        var statSalle = new Chart(ctx4).Bar(data, {
            scaleOverride: true,
            scaleSteps: max_val,
            scaleStepWidth: 1,
            scaleStartValue: 0
        });
      }
    });

    $.ajax({
         url: "<?php echo url_for('reservations_statMois',array('sf_format'=>'json')) ?>",
      dataType: "json",
      success : function (results)
      {
        var data = results[0];
        var max_val = Math.max.apply(Math, data.datasets[0].data)

        var statSalle = new Chart(ctx5).Bar(data, {
            scaleOverride: true,
            scaleSteps: max_val,
            scaleStepWidth: 1,
            scaleStartValue: 0
        });
      }
    });
  });


</script>

<h3>Statistiques sur les Réservations</h3>

  <div class='container'>
    <canvas id="statSalle" width=400 height=400></canvas>
    <canvas id="statPole" width=400 height=400></canvas>
  </div>
  <div class='container'>
    <canvas id="statAsso" width=400 height=400></canvas>
  </div>
  <div class='container'>
    <canvas id="statJour" width=400 height=400></canvas>
    <canvas id="statMois" width=400 height=400></canvas>
  </div>
</div>
