<?php require APPROOT . "/views/inc/header.php"; ?>

<div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
    <h1 class="display-3"><?= $data['title']; ?></h1>
    <p class="lead"><?= $data['description']; ?></p>
    </div>
</div>

<?php if(isset($_SESSION['user_id'])): ;?>

<?php endif; ?>

<?php require APPROOT . "/views/inc/footer.php"; ?>