<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?= URLROOT; ?>"><img src="<?= URLROOT; ?>/public/assets/logo-icon.png"> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_username'] == 'fchaillou') : ?>
                <li class="nav-item">
                    <a class="nav-link  mt-2" href="">Welcome [ADMIN]
                        <?= $_SESSION['user_username'] ?> !</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-2" href="<?= URLROOT; ?>/stories">Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mt-2" href="<?= URLROOT; ?>/users">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT; ?>/users/logout"><button class="btn btn-danger"><i
                                class="fa fa-sign-out"></i></button></a>
                </li>

                <?php elseif (isset($_SESSION['user_id']) && $_SESSION['user_username'] != 'fchaillou') : ?>
                <li class="nav-item">
                    <a class="nav-link mt-2" href="">Bienvenue, <?= $_SESSION['user_username'] ?> !</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= URLROOT; ?>/users/logout"><button class="btn btn-danger"><i
                                class="fa fa-sign-out"></i></button></a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>