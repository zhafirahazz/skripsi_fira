<div class="card mt-5 shadow" style="max-width: 500px; margin:auto;">
    <div class="card-header text-center">
        <h4><b>Login</b></h4>
    </div>
    <div class="card-body">
        <img class="img-thumbnail text-center img-200" src="/img/abbskp.png" style="margin: 5vh auto"/>
        <form method="POST" action="<?php echo route_to('do.login') ?>">

            <?php if(isset($_SESSION['error'])) : ?>
                <small class="text-danger"><?php echo($_SESSION['error']) ?></small>
            <?php endif ?>

            <input required class="form form-control" placeholder="email" name="email" type="email">
            <input required class="form mt-3 form-control" placeholder="password" name="password" type="password">
            <div class="text-end">
                <a href="<?php echo route_to('auth.forgot.index') ?>">Lupa password?</a>
            </div>
            <button class="btn mt-4 btn-primary w-100">Login</button>
        </form>
    </div>
</div>