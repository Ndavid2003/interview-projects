<?php require_once 'components/server/fetch_data.php'; ?>
<?php include 'components/modal.php'; 


$email = $_SESSION['email'];
$id = $_SESSION['id'];
$username = $email = '';
$sql = "SELECT * FROM tm_users WHERE id='$id'";
$result = mysqli_query($con, $sql);


//Ha a felhasználó megváltoztatja a célját

if(isset($_POST['submit_profit'])){

  $goalInput = $_POST['profit'];
  $unitInput = $_POST['units'];

  $sql = "UPDATE tm_users SET goal = '$goalInput', units = '$unitInput'";
  mysqli_query($con, $sql);
  header("Refresh: 0");
}

if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$email = $row["email"];
		$username = $row["username"];
		$balance = $row["balance"];
    $goal = $row["goal"];
    $profit = $row["profit"];
    $units = $row["units"];
    $avl_units = $row["avl_units"];
    $wins = $row["wins"];
		$losses = $row["losses"];
	}
}
?>



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
            <li class="active"><a href="index.php">Irányítópult</a></li>
            <li><a href="strategies.php">Stratégiák</a></li>
            <li><a href="calendar.php">Naptár</a></li>
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
                <img src="images/qrcode.png" alt="" width="100px" height="100px" style="object-fit:cover; margin:auto">
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
                <h4 class="p-3">Fogadásaim</h4>
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
            <div class="d-flex flex-column">
            <?php
            include_once 'components/server/mydb.php';
            $query = mysqli_query($con, "SELECT * FROM tm_products ORDER BY id ASC") or die(mysqli_error($con));
            if ($query->num_rows > 0) {
            # code...
                while ($row = mysqli_fetch_array($query)) {
            # code...
                    $id = $row['id'];
                    $name = $row['name'];
            ?>
            <div class="d-flex justify-content-between m-2">
            <h6><?php echo $name; ?></h6>
        <button class="btn btn-primary btn-md">
      <a href="checkout.php?id=<?php echo $id; ?>" style="color: #fff; text-decoration: none;">Megvásárlás</a>
      </button>
            </div>

      <?php } 
      } ?>
      </div>
            <hr>
            <h5 class="p-2">Százalékos elosztás</h5>
            <p class="p-2">Ennél az opciónál egyenleget kell feltölteni és a bankrollodat mi menedzseljük egy százalékos részesedésért cserébe. 
            </p>
            <span class="p-2">Fejlesztés alatt</span>
        </div> 
        <div class="g4x4 bg-info">
          <h4 class="p-3">Felhasználható egységek</h4>
          
			<div id="oddspedia-widget-odds-comparison-popular-false-sports-false-leagues-false">
			<script src="https://widgets.oddspedia.com/js/widget/init.js?widgetId=oddspediaWidgetOddsComparisonPopularSportsLeagues" async></script>
		</div>


      </div> 
      <div class="g4x4 bg-info">
        <h4 class="p-3">Felhasználható egységek</h4>
        <div id="paymentResponse" class="hidden"></div>
    </div> 
        </div>
        <div class="modal fade" id="modalA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Adatok megváltozatása</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="modal-body">
              <label for="estprofit">Cél</label>
              <input type="number" class="form-control my-2" id="estprofit" name="profit" value="<?php echo $goal ?>" step="100"> <!-- PHP VALUE-->
              <label for="estprofit">Egységek száma</label>
              <input type="number" class="form-control mt-2" id="estprofit" name="units" value="<?php echo $units ?>" step="1"> <!-- PHP VALUE-->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezárás</button>
              <button type="submit" name="submit_profit" class="btn btn-primary">Elmentés</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </section>

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

<script src="https://js.stripe.com/v3/"></script>
  </body>
  </html>
  