<?php
    if(!isset($next_login_page_action)) {
        $next_login_page_action = "";
    }
    if(!isset($login_message)) {
        $login_message = "";
    }
?>
<div class="my-5 mb-3"></div>
<div class="container-fluid main-body">
<h1 class="ms-5"><?php echo $heading?></h1>
<div class="row justify-content-center">
    <div class="col col-11">
        <hr>
    </div>
</div>
    <div class="row justify-content-center h-75 mt-4">
        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-8 col-10">
            <?php if(!empty($login_message)):?>
                <div class="alert alert-danger mt-3">
                    <?php echo $login_message?>
                </div>
            <?php endif?>
            <form class="border rounded border-dark p-3" action="./index.php" method="POST">
                <label for="userPhoneNoControl" class="form-label">Mobile Phone Number</label>
                <input type="tel" id="userPhoneNoControl" class="form-control" pattern="[0-9]{10}" placeholder="0XXXXXXXXX" name="user_phone_number" aria-describedby="userPhoneNoHelp" required>
                <div id="userPhoneNoHelp" class="form-text mb-3">Please enter you mobile phone number according to the given format.</div>
                <input type="hidden" name="action" value="login">
                <input type="hidden" name="next_page_action" value=<?php echo "\"$next_login_page_action\""?>>
                <div class="d-grid gap-2 col-3 mx-auto">
                    <input type="submit" class="btn btn-dark" value="OK">
                </div>
            </form>
        </div>
    </div>
</div>