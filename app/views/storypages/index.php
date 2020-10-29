<?php require APPROOT . "/views/inc/header.php"; ?>

<?php flash('story_message'); ?>

<div class="row">
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/stories" class="btn btn-secondary"><i class="fa fa-backward"></i> Mes Stories
        </a>

        <h1 class="mt-3">
            <?= $data['story-title']; ?> <button id="infostorybutton" class="btn btn-primary"><i
                    class="fa fa-info-circle"></i></button>
        </h1>
        <div id="nodisplay" class="container p-3 mb-3 bg-light">
            <p>Rubrique : <?= $data['story-heading']; ?></p>
            <p> Article lié : <a
                    href="<?= $data['story-linked-content-url']; ?>"><?= $data['story-linked-content-title']; ?></a></p>
            <a href="<?= URLROOT ?>/stories/edit/<?= $data['story-id']; ?>"><button class="btn btn-primary"><i
                        class="fa fa-pencil-square-o"></i> Modifier</button></a>
        </div>

    </div>
    <div class="col-md-6">
    </div>
</div>

<?php if (empty($data['storypages']) && $_SESSION['user_id'] == $data['story-user-id']) : ?>
<h4 class="mt-3">Pour l'instant, votre story est vide !</h4>
<a href="<?= URLROOT; ?>/storypages/add/<?= $data['story-id']; ?>" class="btn btn-primary mt-3"><i
        class="fa fa-plus"></i> Créer la Cover</a>
<?php elseif (!empty($data['storypages'])) : ?>

<table class="table">

    <thead>
        <tr>
            <th scope="col">Titre</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>

    <tbody>
        <?php
            foreach ($data['storypages'] as $storypage) : ?>

        <?php if ($storypage->sub_id == 1) : ?>
        <tr class="table-info">
            <?php else : ?>
        <tr>
            <?php endif; ?>
            <td><?= $storypage->title; ?></td>
            <td>
                <a href="<?= URLROOT; ?>/storypages/edit/<?= $storypage->id; ?>" class="btn btn-primary">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
            </td>
            <td>
                <form action="<?= URLROOT; ?>/storypages/delete/<?= $storypage->id; ?>" method="post">
                    <input type="hidden" value="<?= $storypage->id; ?>">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>

                </form>
            </td>
            <td>
                <a href="<?= URLROOT; ?>/storypages/preview/<?= $storypage->id; ?>" target="_blank"
                    class="btn btn-secondary">
                    <i class="fa fa-eye"></i>
                </a>
            </td>
            <?php if ($storypage->sub_id > 1) : ?>
            <td>
                <a href="<?= URLROOT; ?>/storypages/up/<?= $storypage->id; ?>"
                    class="storypage-link-up btn btn-secondary">
                    <i class="fa fa-arrow-up"></i>
                </a>
            </td>
            <td>
                <a href="<?= URLROOT; ?>/storypages/down/<?= $storypage->id; ?>"
                    class="storypage-link-down btn btn-secondary">
                    <i class="fa fa-arrow-down"></i>
                </a>
            </td>
            <?php elseif ($storypage->sub_id == 2) : ?>
            <td></td>
            <td>
                <a href="<?= URLROOT; ?>/storypages/down/<?= $storypage->id; ?>" class="btn btn-secondary">
                    <i class="fa fa-arrow-down"></i>
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


<a href="<?= URLROOT; ?>/storypages/add/<?= $data['story-id']; ?>" class="btn btn-primary"><i class="fa fa-plus"></i>
    Créer une nouvelle page</a>

<div></div>
<?php endif; ?>








<?php require APPROOT . "/views/inc/footer.php"; ?>