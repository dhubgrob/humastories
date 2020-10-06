<?php require APPROOT . "/views/inc/header.php"; ?>

<div class="row">
<div class="col-md-6">
<h1>Posts</h1>
</div>
<div class="col-md-6">
<a href="<?php URLROOT;?>/stories/add" class="btn btn-primary pull-right">
Add story
</a>
</div>
</div>

<p>
    <?php foreach($data['stories'] as $story) :?>
        <p>
        <?= $story->title; ?>
        </p>
    <?php endforeach ;?>
</p>

<?php require APPROOT . "/views/inc/footer.php"; ?>