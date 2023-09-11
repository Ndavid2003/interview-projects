<?php require 'components/server/fetch_data.php'; ?>


<!DOCTYPE html>
<html>
    <head>
        <?php include 'components/head.php';?>
        <title>Mixby | Irányítópult </title>
    </head>
    <body class="bg-dark">
<div class="wrapper">
    <nav class="menu bg-info">
            <div class="menu-header">
                <h2 class="text-light p-3">Mixby</h2>
            </div>
            <ul>
                <li><a href="index.php">Irányítópult</a></li>
                <li><a href="strategies.php">Stratégiák</a></li>
                <li class="active"><a href="calendar.php">Naptár</a></li>
                <li><a href="favourites.php">Kedvenceim</a></li>
            </ul>
            <span class="ps-2">Pénzügyek</span>
            <ul>
                <li><a href="subscriptions.php">Előfizetések</a></li>
                <li><a href="cashin.php">Befizetés</a></li>
                <li><a href="cashout.php">Kifizetés</a></li>
            </ul>
        </nav>
    <section>
        <div class="dash-grid">
            <div class="topnav bg-info mt-4">
                <i class="bi bi-bell mx-3 fs-4"></i>
                <div class="d-flex flex-column">
                    <?php echo $username?>
                    <span>Egyenleg: <?php echo number_format($balance) ?>Ft</span>
                </div>
                <div class="dropdown">
                    <img class="" src="images/prof.png" alt="" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu bg-info" aria-labelledby="dropdownMenuButton1">
                      <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profil</a></li>
                      <li><a class="dropdown-item" href="#"><i class="bi bi-cash"></i> Egyenleg feltöltése</a></li>
                      <li><a class="dropdown-item" href="#"><i class="bi bi-envelope"></i> Üzenetek</a></li>
                      <li><a class="dropdown-item" href="#"><i class="bi bi-question-circle"></i> FAQ</a></li>
                      <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Kijelentkezés</a></li>
                    </ul>
                  </div>   
            </div> 
            <div class="g6x2 bg-success text-center d-flex flex-column justify-content-center">
                <h4 class="p-3">Szia <?php echo $username; ?>! 🚀</h4>
                <p class="p-2">Ebben a hónapban 12.527Ft-ot realizáltál. Ez egy <span class="fw-bold">13,5%-os</span>
                     növekedés az előző hónaphoz képest.</p>

            </div> 
            <div class="g3x2 bg-info d-flex flex-column justify-content-start card">
              <div>
                <h4 class="pt-3 ps-3"><?php echo number_format($profit) ?> Ft</h4>
                <span class="ps-3">Eddig szerzett profit</span>
              </div>
              <div id="chart" class="">
              </div>
            </div> 
            <div class="g3x2 bg-info d-flex flex-column justify-content-center">
                <h5 class="p-3">Barát meghívása QR kóddal</h5>
                <img src="images/qrcode.png" alt="" width="130px" height="130px" style="object-fit:cover; margin:auto">
            </div> 
            <div class="g6x3 bg-info d-flex flex-column justify-content-start">
                <div class="d-flex justify-content-start">
                  <div>
                    <h4 class="px-3 pt-3">2022. december</h4>
                    <span class="pt-2 px-3">Statisztika</span>
                  </div>
                </div>
                <div class="row px-2 pt-3">
                  <div class="col-lg-12 d-flex justify-content-between">
                    <div>
                    <label for="goals">Cél: <?php echo number_format($goal) ?> Ft</label>
                    <div class="progress bg-dark">
                      <div class="progress-bar bg-success" role="progressbar" style="width:<?php echo $balance / $goal * 100 ?>%" aria-valuenow="<?php echo $balance ?>" aria-valuemin="0" aria-valuemax="<?php echo $goal ?>"></div>
                    </div>
                  </div>
                  <button class="btn btn-primary" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalA">Változtatás</button>
                  </div>
                  <div class="col-lg-8">
                    <label for="goals" class="pt-3">Megnyert fogadások: <?php echo $wins ?> db</label>
                    <div class="progress bg-dark">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $wins /($losses + $wins) * 100 ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="<?php echo $losses + $wins ?>"></div>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <label for="goals" class="pt-3">Elvesztett fogadások: <?php echo $losses ?> db</label>
                    <div class="progress bg-dark">
                      <div class="progress-bar bg-secondary" role="progressbar" style="width: <?php echo $losses /($losses + $wins) * 100 ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="<?php echo $losses + $wins ?>"></div>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <label for="goals" class="pt-3">Egységek (<?php echo $units ?> / <?php echo $avl_units ?> db)   </label>
                    <div class="progress bg-dark">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $avl_units / $units * 100 ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="<?php echo $units ?>"></div>
                    </div>
                    <span class="sm-desc">1 egység <?php echo number_format($balance / $units)?> Ft</span>
                  </div>
                </div>
            </div> 
            <div class="g6x3 bg-info">
                <h4 class="p-3">Felhasználható egységek</h4>
            </div> 
            <div class="g4x4 bg-info">
              <h4 class="p-3">Tippek</h4>
              <ul>
                <li>Ne lépd túl a napi egységszámot!</li>
                <li>Ha vereségszériád van szüneteltetsd egy kicsit!</li>
                <li>Havi 51%-os nyerési arány már profit</li>
                <li>Ügyesen menedzseld a bankrollod</li>
              </ul>
          </div> 
          <div class="g4x4 bg-info">
            <h4 class="p-3">Tippmix tipp árak</h4>
            <div class="d-flex justify-content-between px-3" style="place-items: baseline;">
              <h6 data-bs-toggle="tooltip" data-bs-placement="top" title="1 tippet tartalmaz">Duplázó [310Ft]</h6>
              <button class="btn btn-primary">kosárba</button>
            </div>
            <div class="d-flex justify-content-between px-3 my-2" style="place-items: baseline;">
              <h6 data-bs-toggle="tooltip" data-bs-placement="top" title="8 tippet tartalmaz">Napi csomag [2400Ft] <span class="sm-desc">Ajánlott</span></h6>
              <button class="btn btn-primary">kosárba</button>
            </div>
            <div class="d-flex justify-content-between px-3" style="place-items: baseline;">
              <h6 data-bs-toggle="tooltip" data-bs-placement="top" title="40 tippet tartalmaz">2 hetes csomag [12.990Ft]</h6>
              <button class="btn btn-primary">kosárba</button>
            </div>
            <div class="d-flex justify-content-between px-3 my-2" style="place-items: baseline;">
              <h6>1 hónapos csomag [23.990Ft]</h6>
              <button class="btn btn-primary">kosárba</button>
            </div>
            <hr>
            <h5 class="p-2">Százalékos elosztás</h5>
            <p class="p-2">Ennél az opciónál egyenleget kell feltölteni és a bankrollodat mi menedzseljük egy százalékos részesedésért cserébe. 
            </p>
            <span class="p-2">Fejlesztés alatt</span>
        </div> 
        <div class="g4x4 bg-info">
          <h4 class="p-3">Felhasználható egységek</h4>
      </div> 
      <div class="g4x4 bg-info">
        <h4 class="p-3">Felhasználható egységek</h4>
    </div> 
        </div>
    </section>
      <?php include 'components/modal.php'; ?>
  </div>
  <script>
    var options = {
      stroke: {
      show: true,
      curve: 'smooth',
      lineCap: 'butt',
      colors:  '#7367f0',
      width: 3,
      dashArray: 0,      
  },
  fill: {
    colors:  '#7367f0',
    type: 'solid'
  },
  
      chart: {
        type: 'line',
        height: '120',
        toolbar: {
        show: false
        },
        sparkline: {
        enabled: true
      },
            },
      series: [{
        name: 'Egyenleg',
        data: [500,100,500,1000,500,100,500,1000,500],
        lines: {
        show: false
    }
  }],
  grid: {
show: true,
borderColor: '#7367f0',
strokeDashArray: 0,
position: 'back',
xaxis: {
  lines: {
      show: false
  },
},   
yaxis: {
  lines: {
      show: false
  },
  borderColor: '#7367f0',
},  
row: {
  colors: undefined,
  opacity: 0.5
},  
column: {
  colors: undefined,
  opacity: 0.5
},  
padding: {
  top: 30,
  right: 0,
  bottom: 0,
  left: 0
},  
},
  xaxis: {
    categories: ['Január', 'Február', 'Március', 'Április', 'Május', 'Június', 'Július', 'Augusztus', 'Szeptember'],
    lines: {
      show: false
    }
  }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
  </script>
  </body>
  </html>
  