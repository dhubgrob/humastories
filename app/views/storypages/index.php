<?php require APPROOT . "/views/inc/header.php"; ?>
<div class="row">
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back to stories
        </a>
        <h2>Storypages for Story :</h2>
        <h1>

            <?= $data['story-title']; ?>
        </h1>
        <h2>
            Heading : <?= $data['story-heading']; ?><br>
            Related Content : <a
                href="<?= $data['story-linked-content-url']; ?>"><?= $data['story-linked-content-title']; ?></a>
        </h2>

    </div>
    <div class="col-md-6">
    </div>
</div>

<?php if (empty($data['storypages']) && $_SESSION['user_id'] == $data['story-user-id']) : ?>
<a href="<?= URLROOT; ?>/storypages/add/<?= $data['story-id']; ?>" class="btn btn-primary">Créer la COVER</a>
<?php elseif (!empty($data['storypages'])) : ?>

<table class="table">

    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
            <th scope="col">Preview</th>
            <th scope="col">Up</th>
            <th scope="col">Down</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($data['storypages'] as $storypage) : ?>

        <?php if ($storypage->sub_id == 1) : ?>
        <tr class="table-info">
            <?php else : ?>
        <tr>
            <?php endif; ?>
            <td><?= $storypage->title; ?></td>
            <td>
                <a href="<?= URLROOT; ?>/storypages/edit/<?= $storypage->id; ?>" class="btn btn-primary">
                    Edit
                </a>
            </td>
            <td>
                <form action="<?= URLROOT; ?>/storypages/delete/<?= $storypage->id; ?>" method="post">
                    <input type="hidden" value="<?= $storypage->id; ?>">
                    <input type="submit" value="delete" class="btn btn-danger">
                </form>
            </td>
            <td>
                <a href="<?= URLROOT; ?>/storypages/preview/<?= $storypage->id; ?>" target="_blank"
                    class="btn btn-secondary">
                    Preview
                </a>
            </td>
            <?php if ($storypage->sub_id > 1) : ?>
            <td>
                <a href="<?= URLROOT; ?>/storypages/up/<?= $storypage->id; ?>" class="btn btn-secondary">
                    Up
                </a>
            </td>
            <td>
                <a href="<?= URLROOT; ?>/storypages/down/<?= $storypage->id; ?>" class="btn btn-secondary">
                    Down
                </a>
            </td>
            <?php elseif ($storypage->sub_id == 2) : ?>
            <td></td>
            <td>
                <a href="<?= URLROOT; ?>/storypages/down/<?= $storypage->id; ?>" class="btn btn-secondary">
                    Down
                </a>
            </td>
            <?php else : ?>
            <td></td>
            <td></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<?php if ($_SESSION['user_id'] == $data['story-user-id']) : ?>
<a href="<?= URLROOT; ?>/storypages/add/<?= $data['story-id']; ?>" class="btn btn-primary">Add story page</a>
<?php else : ?>
<div></div>
<?php endif; ?>
<?php endif ?>







<?php require APPROOT . "/views/inc/footer.php"; ?>