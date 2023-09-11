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
                <li class="active"><a href="subscriptions.php">Előfizetések</a></li>
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

          <div class="g4x4 bg-success d-flex flex-column justify-content-between">
          <div>
            <h4 class="text-center pt-3">Kezdő</h4>
            <h6 class="text-center">16.990Ft</h6>
            <p class="p-2">Olyanoknak ajánljuk ezt a csomagot, akik már profitáltak az oldalunkon és bizalmad szavaznak nekünk 1 hónapra.</p>
            </div>  
            <ul>
              <li>1 hónapig érvényes</li>
              <li>Heti 23 Tipp</li>
              <li>Telegram csoport</li>
              <li>Hétvégi Tippek</li>
              <li>24/7 support</li>
            </ul>
            <button class="btn btn-dark m-2">Előfizetek</button>
          </div>
          <div class="g4x4 bg-secondary d-flex flex-column justify-content-between">
            <div>
            <h4 class="text-center pt-3">Haladó</h4>
            <h6 class="text-center">30.990Ft</h6>
            <p class="p-2">Olyanoknak ajánljuk ezt a csomagot, akik már profitáltak az oldalunkon és bizalmad szavaznak nekünk 1 hónapra.</p>
            </div>   
            <ul>
              <li>2 hónapig érvényes</li>
              <li>Heti 27 Tipp</li>
              <li>Telegram csoport</li>
              <li>Hétvégi Tippek</li>
              <li>24/7 support</li>
              <li>Visszaküldési lehetőség</li>
            </ul>
            <button class="btn btn-dark m-2">Előfizetek</button>
          </div>
          <div class="g4x4 bg-light text-dark d-flex flex-column justify-content-between">
          <div>
            <h4 class="text-center pt-3">Veterán</h4>
            <h6 class="text-center">80.990Ft</h6>
            <p class="p-2">Veteránoknak ajánljuk, akik rendszeresen használják az oldalt és profitáltak velünk.</p>
            </div>   
            <ul>
            <li>6 hónapig érvényes</li>
              <li>Heti 30 Tipp</li>
              <li>Telegram csoport</li>
              <li>Hétvégi Tippek</li>
              <li>24/7 support</li>
              <li>Visszaküldési lehetőség</li>
              <li>Nyereményjátékok</li>
              <li>Token elővásárlási jog <a href="" class="sm-desc">Bövebben</a></li>
            </ul>
            <button class="btn btn-dark m-2">Előfizetek</button>
          </div>
          </div>
    </section>
      <?php include 'components/modal.php'; ?>
  </div>
  </body>
  </html>
  