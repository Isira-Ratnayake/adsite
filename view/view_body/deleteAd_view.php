<ul class="nav pt-2 px-2 justify-content-end">
      <li class="nav-item px-2">
        <a class="rounded-pill btn btn-dark" href="./index.php?action=dashboard">&nbsp;&nbsp;&nbsp;My&nbsp;Ads&nbsp;&nbsp;&nbsp;</a>
      </li>
        <li class="nav-item">
          <a class="rounded-pill btn btn-outline-dark" href="./index.php?action=logout">&nbsp;&nbsp;Sign-Out&nbsp;&nbsp;</a>
        </li>
    </ul>
    <div class="container-fluid main-body">
        <h1 class="ms-5"><?php echo $heading?></h1>
<div class="row justify-content-center">
    <div class="col col-11">
        <hr>
    </div>
</div>
    <div class="row justify-content-center h-75 mt-4">
        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8 col-10">
            <div class="border rounded border-dark p-3">
                <div class="row mb-4">
                    <label class="form-label fs-5">Are you sure you want to delete this ad?</label>
                </div>
                <div class="row mb-2">
                    <div class="col d-grid">
                        <a href="./index.php?action=dashboard" class="rounded-pill btn btn-dark">No</a>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col">
                        <form action="./index.php" method="POST">
                            <div class="row">
                                <div class="col col-12 d-grid">
                                    <input type="hidden" name="ad_id" value="<?php echo $ad_id?>">
                                    <input type="hidden" name="action" value="deleteadrecord">
                                    <input type="submit" class="rounded-pill btn btn-outline-dark" value="Yes">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>