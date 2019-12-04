<?php 
    include '../../../models/clase.php';
    list($datosX, $datosY) = graficaExperticias();
?>

<div id="graphLineExperticia"></div>

<script>

  function crearCadenaLineal(json){
    var parsed = JSON.parse(json);
    var arr = [];
    for(var x in parsed){
      arr.push(parsed[x]);
    }
    return arr;
  }

  datosX = crearCadenaLineal('<?php echo $datosX; ?>');
  datosY = crearCadenaLineal('<?php echo $datosY; ?>');

  var data = [
    {
      x: datosX,
      y: datosY,
      type: 'scatter'
    }
  ];

  var layout = {
  title:'Experticias registradas',
  height: 550,
  font: {
    family: 'Arial',
    size: 16,
    color: 'black' //color de titulo central, y las fechas y cantidades en los ejes X Y
  },
  plot_bgcolor: '',
  margin: {
    pad: 10
  },
  xaxis: {
    title: 'Fecha',
    titlefont: {
      color: 'black',
      size: 12
    },
    rangemode: 'tozero'
  },
  yaxis: {
    title: 'Total de experticias',
    titlefont: {
      color: 'black',
      size: 12
    },
    rangemode: 'tozero'
  }
};

  Plotly.newPlot('graphLineExperticia', data, layout);

</script>