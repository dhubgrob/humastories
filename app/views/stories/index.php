<?php require APPROOT . "/views/inc/header.php"; ?>

<?php flash('register_success'); ?>
<?php flash('user_message'); ?>
<?php flash('story_message'); ?>

<div class="col-md-6 mb-5 mt-5">

    <?php if ($_SESSION['user_username'] == 'fchaillou') : ?>
    <h1>Stories</h1>
    <?php else : ?>
    <h1>Mes Stories</h1>
    <?php endif; ?>
</div>

<?php if (empty($data['stories'])) : ?>

<?php else : ?>
<table class="table">
    <thead>
        <tr>

            <th scope="col">Titre</th>
            <th scope="col">Rubrique</th>
            <th scope="col">Date de création</th>

            <?php if ($_SESSION['user_username'] == 'fchaillou') : ?>
            <th scope="col">Auteur</th>
            <?php endif; ?>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['stories'] as $story) : ?>
        <tr>

            <td><?= $story->title; ?></td>
            <td><?= $story->heading; ?></td>
            <td><?php $date = date_create($story->created_at);
                        echo date_format($date, 'd.m.Y'); ?></td>
            <?php if ($_SESSION['user_username'] == 'fchaillou') : ?>
            <td><?= $story->username; ?></td>
            <?php endif; ?>
            <td><a href="<?= URLROOT; ?>/storypages/<?= $story->id; ?>" class="btn btn-secondary">
                    <i class="fa fa-folder-open"></i> Gérer les pages
                </a></td>

            <td><a href="<?= URLROOT; ?>/stories/preview/<?= $story->id; ?>" target="_blank" class="btn btn-success">
                    <i class="fa fa-eye"></i>
                </a></td>
            <td><a href="<?= URLROOT; ?>/stories/edit/<?= $story->id; ?>" class="btn btn-primary">
                    <i class="fa fa-pencil-square-o"></i>
                </a></td>


            <td>
                <form action="<?= URLROOT; ?>/stories/delete/<?= $story->id; ?>" method="post">
                    <input type="hidden" value="<?= $story->id; ?>">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                </form>
            </td>
        </tr> <?php endforeach; ?>
    </tbody>
</table>
<?php endif ?>
<td><a href="<?= URLROOT; ?>/stories/add" class="btn btn-primary">
        <i class="fa fa-plus"></i> Créer une nouvelle story
    </a>
</td>








<?php require APPROOT . "/views/inc/footer.php"; ?>