<?php 
    include '../../../models/clase.php';
    list($datosX, $datosY) = graficaSolicitudes();
?>

<div id="graficaLinea"></div>

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
  title:'Solicitudes de experticia',
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
    title: 'Total de solicitudes',
    titlefont: {
      color: 'black',
      size: 12
    },
    rangemode: 'tozero'
  }
};

  Plotly.newPlot('graficaLinea', data, layout);

</script>