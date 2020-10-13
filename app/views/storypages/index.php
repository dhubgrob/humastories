<?php require APPROOT . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
        <h1>Story Pages for Story :
            <?php foreach ($data['story'] as $storybase) : ?>
            <?= $storybase->title; ?>
            <?php endforeach; ?>
        </h1>
    </div>
    <div class="col-md-6">
    </div>
</div>

<?php if (empty($data['storypages'])) : ?>
<a href="<?= URLROOT; ?>/storypages/add/<?php foreach ($data['story'] as $storybase) : ?><?= $storybase->id; ?>
    <?php endforeach; ?>" class="btn btn-primary">Créer la première page</a>
<?php else : ?>

<table class="table">
    <thead>
        <tr>

            <th scope="col">Title</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['storypages'] as $storypage) : ?>
        <tr>

            <td><?= $storypage->title; ?></td>
            <td><a href="<?= URLROOT; ?>/storypages/edit/<?= $storypage->id; ?>" class="btn btn-primary">
                    Edit
                </a></td>
            <td>
                <form action="<?= URLROOT; ?>/storypages/delete/<?= $storypage->id; ?>" method="post">
                    <input type="hidden" value="<?= $storypage->id; ?>">
                    <input type="submit" value="delete" class="btn btn-danger">
                    </form< /td>
            <td><a href="<?= URLROOT; ?>/storypages/preview/<?= $storypage->id; ?>" target="_blank"
                    class="btn btn-secondary">
                    Preview
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="<?= URLROOT; ?>/storypages/add/<?= $storypage->id_story; ?>" class="btn btn-primary">Add story page</a>

<?php endif ?>







<?php require APPROOT . "/views/inc/footer.php"; ?>