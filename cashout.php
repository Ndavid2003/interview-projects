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
                <li><a href="calendar.php">Naptár</a></li>
                <li><a href="favourites.php">Kedvenceim</a></li>
            </ul>
            <span class="ps-2">Pénzügyek</span>
            <ul>
                <li><a href="subscriptions.php">Előfizetések</a></li>
                <li><a href="cashin.php">Befizetés</a></li>
                <li class="active"><a href="cashout.php">Kifizetés</a></li>
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
            <h1 class="g6x2 text-light">Jelenleg ez a funkció nem elérhető</h1>
            <div class="loader"></div>
        </div>
    </section>
      <?php include 'components/modal.php'; ?>
  </div>
  </body>
  </html>
  