<?php 
    include '../../../models/clase.php';
    list($datosX1, $datosY1, $datosX2, $datosY2) = graficaRegistros();
?>

<div id="graficaLinea"></div>

<script>

  function crearCadenaLineal1(json){
    var parsed = JSON.parse(json);
    var arr = [];
    for(var x in parsed){
      arr.push(parsed[x]);
    }
    return arr;
  }

  datosX1 = crearCadenaLineal1('<?php echo $datosX1; ?>');
  datosY1 = crearCadenaLineal1('<?php echo $datosY1; ?>');

  function crearCadenaLineal2(json){
    var parsed = JSON.parse(json);
    var arr = [];
    for(var x in parsed){
      arr.push(parsed[x]);
    }
    return arr;
  }

  datosX2 = crearCadenaLineal2('<?php echo $datosX2; ?>');
  datosY2 = crearCadenaLineal2('<?php echo $datosY2; ?>');
  
  var trace1 = {
  x: datosX1,
  y: datosY1,
  type: 'scatter',
  name: 'Disfrutadas'
};

var trace2 = {
  x: datosX2,
  y: datosY2,
  type: 'scatter',
  name: 'Suspendidas'
};

var layout = {
  title: 'Vacaciones 2019',
  xaxis: {
    title: 'Meses',
    showgrid: false,
    zeroline: false
  },
  yaxis: {
    title: 'Total',
    showline: false
  }
};

var data = [trace1, trace2];

Plotly.newPlot('graficaLinea', data, layout,{}, {showSendToCloud: true});

</script>