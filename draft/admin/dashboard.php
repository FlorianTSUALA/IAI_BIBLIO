 <?php

session_start();

$_SESSION['menu'] = 'Tableau de bord';
$_SESSION['sousmenu'] = 'Etat des enregistrements des dossiers des assurés';

require_once(dirname(__FILE__).'/../config/global.php');

include_once('../template/entete.php');

    

?>  


  
            
<div class="br-pagebody mg-t-5 pd-x-30">

        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3 ">
            
            <div id="carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel" data-slide-to="1" class=""></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="bg-teal rounded overflow-hidden">
                      <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-ios-navigate-outline tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                          <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Assurés <br />sans dossiers </p>
                          <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">10 000</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="bg-teal rounded overflow-hidden">
                      <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-folder tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                          <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Assurés <br />avec dossiers </p>
                          <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">15 000</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- carousel-inner -->
            </div><!-- carousel -->
            
          </div><!-- col-3 -->
          
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div id="carouse2" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouse2" data-slide-to="0" class="active"></li>
                  <li data-target="#carouse2" data-slide-to="1" class=""></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <div class="bg-info rounded overflow-hidden">
                      <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-woman tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                          <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Pensionnaires <br />Feminin</p>
                          <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">10 000</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <div class="bg-info rounded overflow-hidden">
                      <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-man tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                          <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Pensionnaires <br />Masculin</p>
                          <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">15 000</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- carousel-inner -->
            </div><!-- carousel -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-info rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-calendar tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Pensionnaires <br />enregistrés ce jour</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">2</p>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
          <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
            <div class="bg-success rounded overflow-hidden">
              <div class="pd-25 d-flex align-items-center">
                <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-20">
                  <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total Assurés <br />enregistrés</p>
                  <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">25 000</p>
                </div>
              </div>
            </div>
          </div><!-- col-3 -->
        </div><!-- row -->

        <div class="row row-sm mg-t-20">
        
        
          <div class="col-6">
          
            <div class="card pd-0 bd-0 shadow-base">
              <div class="pd-x-30 pd-t-30 pd-b-15">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">
                        Evolution des enregistrements des dossiers des assurés
                    </h6>
                    <p class="mg-b-0">
                        Sélectionner la période et cliquez sur <strong>"Go"</strong> : 
                    </p>
                  </div>
                </div>
              </div>
              <div class="pd-x-15 pd-b-15">
                <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">
                    Début : <input type="date" id="date_debut" value="<?php echo (isset($_GET['date_crtl']) ? $_GET['date_crtl'] : date('Y-m-d')); ?>" />
                    Fin : <input type="date" id="date_fin"  value="<?php echo (isset($_GET['date_crtl']) ? $_GET['date_crtl'] : date('Y-m-d')); ?>" />
                <a class="btn btn-info tx-uppercasepd-x-25" onclick="refresh_dashboard()">
                    Go
                </a>
                </h6>
                
                
                
              </div>
            </div>
            
            <hr />
            <div id="container_pie"></div>
            <hr />
            <div id="container_cyl"></div>

          </div>
          
          
          <div class="col-6">
            
            <div id="container"></div>
            <hr />
            
            <div class="card pd-0 bd-0 shadow-base">
              <div class="pd-x-30 pd-t-30 pd-b-15">
                <div>
                  <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1"></h6>
                  <p class="mg-b-0">Les 5 derniers dossiers </p>
                </div>
              </div><!-- d-flex -->

              <table class="table table-valign-middle mg-b-0">
                <tbody>
                  <tr>
                    <td class="pd-l-0-force">
                      <img src="../img/img10.jpg" class="wd-40 rounded-circle" alt="">
                    </td>
                    <td>
                      <h6 class="tx-inverse tx-14 mg-b-0">Deborah Miner</h6>
                      <span class="tx-12">@deborah.miner</span>
                    </td>
                    <td>Nov 01, 2017</td>
                    <td><span id="sparkline1"><canvas width="100" height="30" style="display: inline-block; width: 100px; height: 30px; vertical-align: top;"></canvas></span></td>
                    <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i class="icon ion-more tx-18 lh-0"></i></a></td>
                  </tr>
                  
                  <tr>
                    <td class="pd-l-0-force">
                      <img src="../img/img4.jpg" class="wd-40 rounded-circle" alt="">
                    </td>
                    <td>
                      <h6 class="tx-inverse tx-14 mg-b-0">Marilyn Tarter</h6>
                      <span class="tx-12">@marilyn.tarter</span>
                    </td>
                    <td>Oct 27, 2017</td>
                    <td><span id="sparkline5"><canvas width="100" height="30" style="display: inline-block; width: 100px; height: 30px; vertical-align: top;"></canvas></span></td>
                    <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i class="icon ion-more tx-18 lh-0"></i></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
           
          </div>
            
    </div>
    
    <div class="row">
        
        <div class="col-md-12">
            
        </div>
        
    </div>
          
          
</div>

        


<?php

	include_once('../template/pied.php');
    
?>


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<script src="https://code.highcharts.com/modules/cylinder.js"></script>

<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>



<script type="text/javascript">

function refresh_dashboard() {
    var date_debut = $('#date_debut').val();
    var date_fin = $('#date_fin').val();
    
    document.location.href = "dashboard.php?date_debut="+date_debut+"&date_fin="+date_fin;
}




Highcharts.chart('container_pie', {
  chart: {
    type: 'pie',
    options3d: {
      enabled: true,
      alpha: 45
    }
  },
  title: {
    text: "Nombre d'assurés par catégorie sur la période"
  },
  subtitle: {
    text: 'Source: Base de données de DVWEB'
  },
  plotOptions: {
    pie: {
      innerSize: 100,
      depth: 45
    }
  },
  series: [{
    name: 'Nombre',
    data: [
      ['Civils', 8],
      ['Militaires', 3],
      ['Contractuels', 1],
      ['Pensions spéciales', 6],
      ['Reversions', 8]
    ]
  }]
});


Highcharts.chart('container_cyl', {
  chart: {
    type: 'column',
    options3d: {
      enabled: true,
      alpha: 15,
      beta: 15,
      depth: 50,
      viewDistance: 25
    }
  },
  title: {
    text: "Nombre d'assurés par catégorie sur la période"
  },
  subtitle: {
    text: 'Source: Base de données de DVWEB'
  },
  xAxis: {
    categories: [
      'Civils',
      'Militaires',
      'Contractuels',
      'Pensions spéciales',
      'Reversions'
    ],
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: "Nombre d'assurés"
    }
  },  
  plotOptions: {
    series: {
      depth: 25,
      colorByPoint: true,
      dataLabels: {
        enabled: true,
        format: '{point.y:.f}'
      }
    }
  },
  series: [{
    data: [299, 715, 1064, 1292, 544],
    name: 'Nombre',
    showInLegend: false
  }]
});


Highcharts.chart('container', {

  title: {
    text: "Evolution du nombre d'assurés par année et par catégorie"
  },
  subtitle: {
    text: 'Source: Base de données de DVWEB'
  },
  yAxis: {
    title: {
      text: "Nombre d'assurés"
    }
  },
  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
  },
  plotOptions: {
    series: {
      label: {
        connectorAllowed: true
      },
      pointStart: 2010
    },
    line: {
      dataLabels: {
        enabled: true
      },
      enableMouseTracking: true
    }
  },
  series: [
              {
                name: 'Civils',
                data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
              }, 
              {
                name: 'Militaires',
                data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
              }, 
              {
                name: 'Contractuels',
                data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
              }, 
              {
                name: 'Pensions spéciales',
                data: [0, 0, 7988, 12169, 15112, 22452, 34400, 34227]
              },
              {
                name: 'Reversions',
                data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
              }
  ],
  responsive: {
    rules: [{
      condition: {
        maxWidth: 500
      },
      chartOptions: {
        legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'top'
        }
      }
    }]
  }

});

</script>