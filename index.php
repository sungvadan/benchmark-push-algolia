<?php
 require_once './vendor/autoload.php';
 set_time_limit(0);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$zonesCountries = [
    'AE' => 'ROTW',
    'AM' => 'ROTW',
    'AR' => 'US',
    'AT' => 'GB',
    'AU' => 'US',
    'AZ' => 'ROTW',
    'BA' => 'ROTW',
    'BE' => 'GB',
    'BG' => 'ROTW',
    'BH' => 'ROTW',
    'BN' => 'US',
    'BR' => 'US',
    'BY' => 'ROTW',
    'CA' => 'US',
    'CH' => 'GB',
    'CI' => 'ROTW',
    'CL' => 'US',
    'CM' => 'ROTW',
    'CN' => 'ROTW',
    'CO' => 'US',
    'CY' => 'ROTW',
    'CZ' => 'ROTW',
    'DE' => 'GB',
    'DK' => 'GB',
    'DZ' => 'ROTW',
    'EE' => 'ROTW',
    'EG' => 'ROTW',
    'ES' => 'GB',
    'FI' => 'GB',
    'FR' => 'FR',
    'GA' => 'ROTW',
    'GB' => 'GB',
    'GE' => 'ROTW',
    'GF' => 'FR',
    'GR' => 'ROTW',
    'GG' => 'GB',
    'GP' => 'FR',
    'HK' => 'US',
    'HR' => 'ROTW',
    'HU' => 'GB',
    'ID' => 'US',
    'IE' => 'GB',
    'IL' => 'ROTW',
    'IN' => 'ROTW',
    'IT' => 'GB',
    'JE' => 'GB',
    'JO' => 'ROTW',
    'JP' => 'ROTW',
    'KE' => 'ROTW',
    'KH' => 'US',
    'KR' => 'US',
    'KW' => 'ROTW',
    'KZ' => 'ROTW',
    'LB' => 'ROTW',
    'LT' => 'ROTW',
    'LU' => 'GB',
    'LV' => 'ROTW',
    'MA' => 'ROTW',
    'MC' => 'FR',
    'MG' => 'ROTW',
    'MK' => 'ROTW',
    'MO' => 'US',
    'MT' => 'ROTW',
    'MQ' => 'FR',
    'MU' => 'ROTW',
    'MX' => 'US',
    'MY' => 'US',
    'NC' => 'FR',
    'NG' => 'ROTW',
    'NL' => 'GB',
    'NO' => 'GB',
    'NZ' => 'US',
    'OM' => 'ROTW',
    'PE' => 'US',
    'PH' => 'US',
    'PK' => 'ROTW',
    'PL' => 'GB',
    'PR' => 'US',
    'PT' => 'GB',
    'QA' => 'ROTW',
    'RE' => 'FR',
    'RO' => 'GB',
    'RU' => 'ROTW',
    'SA' => 'ROTW',
    'SE' => 'GB',
    'SG' => 'US',
    'SI' => 'GB',
    'SK' => 'GB',
    'SN' => 'ROTW',
    'TH' => 'US',
    'TN' => 'ROTW',
    'TR' => 'ROTW',
    'TW' => 'US',
    'UA' => 'GB',
    'US' => 'US',
    'UY' => 'US',
    'VE' => 'US',
    'YT' => 'FR',
    'ZA' => 'ROTW',
];

$merchZones = ['FR', 'GB', 'ROTW', 'US'];

$countries = ['FR', 'GF', 'GP', 'MC', 'MQ', 'NC', 'RE', 'YT', 'AT', 'BE', 'CH', 'DE', 'DK', 'ES', 'FI', 'GB', 'GG', 'HU', 'IE', 'IT', 'JE', 'LU', 'NL', 'NO', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK', 'UA', 'AE', 'AM', 'AZ', 'BA', 'BG', 'BH', 'BY', 'CI', 'CM', 'CN', 'CY', 'CZ', 'DZ', 'EE', 'EG', 'GA', 'GE', 'GR', 'HR', 'IL', 'IN', 'JO', 'JP', 'KE', 'KW', 'KZ', 'LB', 'LT', 'LV', 'MA', 'MG', 'MK', 'MT', 'MU', 'NG', 'OM', 'PK', 'QA', 'RU', 'SA', 'SN', 'TN', 'TR', 'ZA', 'AR', 'AU', 'BN', 'BR', 'CA', 'CL', 'CO', 'HK', 'ID', 'KH', 'KR', 'MO', 'MX', 'MY', 'NZ', 'PE', 'PH', 'PR', 'SG', 'TH', 'TW', 'US', 'UY', 'VE'];
$nbProductByBatch = 1000;

$axis = [];
$reqCountries = [];
$reqMerch = [];
$reqProducts = [];
$reqModele = [];
$minNbproduct = 1000;
$nbProduitsParModele = 7;

foreach (range(50000, 500000, 10000) as $nbProducts){
    $axis[] = $nbProducts;
    $byCountries = [];
    $byZoneMerch= [];

    foreach ($countries as $country) {
        $byCountries[$country] =  rand($minNbproduct,$nbProducts);
    }

    $totalProduct = 0;
    foreach ($merchZones as $merchZone) {
        $nbRandProduct = rand($minNbproduct,$nbProducts);
        $byZoneMerch[$merchZone] = $nbRandProduct;
        $totalProduct += $nbRandProduct;
    }
    if($totalProduct < $nbProducts) {
        $byZoneMerch[$merchZones[0]] += ($nbProducts-$totalProduct);
    }
    $reqCountries[] = sendByCountry();
    $reqMerch[] = sendByMerchZone();
    $reqProducts[] = sendByProduct();
    $reqModele[] =  sendByModel();
}



function sendByCountry()
{
    global $nbProductByBatch, $byCountries;

    $nbRequest = 0;
    foreach ($byCountries as $byCountry) {
        $nbRequest += ($byCountry / $nbProductByBatch);
    }

    return $nbRequest;
}



function sendByMerchZone()
{
    global  $nbProductByBatch, $byZoneMerch;
    $nbRequest = 0;
    foreach ($byZoneMerch as $byZoneMerch) {
        $nbRequest += ($byZoneMerch / $nbProductByBatch);
    }

    return $nbRequest;
}



function sendByProduct()
{
    global  $nbProducts, $nbProductByBatch;
    return $nbProducts/$nbProductByBatch;
}

function sendByModel()
{
    global  $nbProducts, $nbProduitsParModele;
    return $nbProducts/($nbProduitsParModele);
}
?>

<div style="width:75%;">
    <canvas id="canvas"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script type="text/javascript">

  window.chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(201, 203, 207)'
  };

  var lineChartData = {
    labels: [<?= implode(',', $axis) ?>],
    datasets: [
    {
      label: 'By country',
      backgroundColor: window.chartColors.red,
      borderColor: window.chartColors.red,
      data: [<?= implode(',', $reqCountries)?>],
      fill: false,
    },
    {
      label: 'By Merch',
      fill: false,
      backgroundColor: window.chartColors.blue,
      borderColor: window.chartColors.blue,
      data: [<?= implode(',', $reqMerch)?>],
    },
    {
      label: 'By Product',
      fill: false,
      backgroundColor: window.chartColors.orange,
      borderColor: window.chartColors.orange,
      data: [<?= implode(',', $reqProducts)?>],
    },
    {
      label: 'By Model',
      fill: false,
      backgroundColor: window.chartColors.grey,
      borderColor: window.chartColors.grey,
      data: [<?= implode(',', $reqModele)?>],
    }
    ]
  };


  window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myLine = Chart.Line(ctx, {
      data: lineChartData,
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Test send product to Algolia'
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Nb products'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Nb requests'
            }
          }]
        }
      }
    });
  };
</script>
</body>
</html>