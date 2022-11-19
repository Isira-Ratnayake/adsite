<?php
/**
 * Header shared by all views of the ad site.
 */
/* Initialise the $title to a default value */
if(!isset($title) || empty($title)) {
    $title = 'Default title';
}
if(!isset($stylesheets)) {
    $stylesheets = '';
}
if(!isset($heading)) {
  $heading = 'No Heading';
}
if(!isset($webpageSector)) {
  $webpageSector = 'searchAd';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <link rel="stylesheet" type="text/css" href="./view/bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./view/css/overall_styles.css">
    <?php
        echo $stylesheets;
    ?>
    <script src="./view/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand mb-0 h1" href="#">Ad Site</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if($webpageSector == 'verification'):?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="./index.php?action=verification">Verify Ads</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./index.php?action=topads">Top Ads</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./index.php?action=deleteads">Delete Ads</a>
                </li>
              </ul>
            <?php elseif($webpageSector == 'topads'):?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="./index.php?action=verification">Verify Ads</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="./index.php?action=topads">Top Ads</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./index.php?action=deleteads">Delete Ads</a>
                </li>
              </ul>
            <?php else:?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="./index.php?action=verification">Verify Ads</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./index.php?action=topads">Top Ads</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="./index.php?action=deleteads">Delete Ads</a>
                </li>
              </ul>
            <?php endif?>
          </div>
        </div>
    </nav>