<?php
session_start();
require_once ('components/server/config.php');
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
                <li><a href="index.php">Irányítópult</a></li>
                <li><a href="strategies.php">Stratégiák</a></li>
                <li><a href="calendar.php">Naptár</a></li>
                <li><a href="favourites.php">Kedvenceim</a></li>
            </ul>
            <span class="ps-2">Pénzügyek</span>
            <ul>
                <li><a href="subscriptions.php">Előfizetések</a></li>
                <li  class="active"><a href="cashin.php">Befizetés</a></li>
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
            <div class="g6x2 grs-2 bg-success text-center d-flex flex-column justify-content-center">
                <h4 class="p-3">Egyenleg feltöltés Stripe-al 🚀</h4>
                <p class="px-2">Töltsd fel egyenleged, hogy élvezhetsd a teljeskerű szolgáltatásunkat!</p>
                <div class="row align-items-baseline justify-content-around">
                <button class="btn btn-dark col-lg-4 col-10">Befizetés</button>
                <span class="col-lg-3 sm-desc pb-2">Ez a funkció nem elérhető</span>
                </div>
            </div> 
            <div class="g6x4 bg-info d-flex flex-column justify-content-start card">
              <div class="d-flex p-3">
              <span style="font-size:11px" class="pt-2 pe-4">vagy</span><h4 class="">Vegyél Tippet!</h4>
              </div>
              <div class="d-flex justify-content-between wrap" style="place-items: baseline;">
              <h6 data-bs-toggle="tooltip" data-bs-placement="top" title="1 tippet tartalmaz">Duplázó [310Ft]</h6>
              <button class="btn btn-primary">kosárba</button>
            </div>
            <div class="d-flex justify-content-between my-2 wrap" style="place-items: baseline;">
              <h6 data-bs-toggle="tooltip" data-bs-placement="top" title="8 tippet tartalmaz">Napi csomag [2400Ft] <span class="sm-desc">Ajánlott</span></h6>
              <button class="btn btn-primary">kosárba</button>
            </div>
            <div class="d-flex justify-content-between wrap" style="place-items: baseline;">
              <h6 data-bs-toggle="tooltip" data-bs-placement="top" title="40 tippet tartalmaz">2 hetes csomag [12.990Ft]</h6>
              <button class="btn btn-primary">kosárba</button>
            </div>
            <div class="d-flex justify-content-between my-2 wrap" style="place-items: baseline;">
              <h6>1 hónapos csomag [23.990Ft]</h6>
              <button class="btn btn-primary">kosárba</button>
            </div>
            <div class="d-flex justify-content-between my-2 wrap" style="place-items: baseline;">
              <h6>HRHR [23.990Ft]</h6>
              <button class="btn btn-primary">kosárba</button>
            </div>

            </div> 
            <div class="g6x2 bg-info d-flex flex-column justify-content-start">
                <h4 class="p-2">Promóciós kód: </h4>
                <div class="d-flex">
                <input type="text" name="" id="" class="form-control w-75 m-2" placeholder="IngyenMix2022">
                <button class="btn btn-primary">Beváltás</button>
                </div>
            </div>
    </section>
      <?php include 'components/modal.php'; ?>
  </div>
  </body>
  </html>
  