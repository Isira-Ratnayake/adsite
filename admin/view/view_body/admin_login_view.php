<div class="my-5 mb-3"></div>
    <div class="container-fluid main-body">
    <h1 class="ms-5">Administration</h1>
    <div class="row justify-content-center">
        <div class="col col-11">
            <hr>
        </div>
    </div>
        <div class="row justify-content-center h-75 mt-4">
            <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8 col-10">

                    <?php if($errStat !== 0):?>
                    <div class="alert alert-danger mt-3">
                        <?php echo $err_msg?>
                    </div>
                    <?php endif?>
                <form class="border rounded border-dark p-3" action="./index.php" method="POST">
                    <h2>Log-In</h2>
                    <input type="text" id="usernameControl" class="form-control mb-3" placeholder="Username" name="adminUsername" required>
                    <input type="password" id="passwordControl" class="form-control mb-3" placeholder="Password" name="adminPassword" required>
                    <input type="hidden" name="action" value="adminLogin">
                    <input type="hidden" name="nextLoginAction" value="<?php echo $next_login_page_action?>">
                    <div class="d-grid gap-2 col-3 mx-auto mt-4">
                        <input type="submit" class="btn btn-dark" value="Log-In">
                    </div>
                </form>
            </div>
        </div>
    </div>