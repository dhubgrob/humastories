<?php require APPROOT . "/views/inc/header.php"; ?>

<?php flash('register_success'); ?>

<div class="col-md-6 mb-5 mt-5">

    <h1>Utilisateurs</h1>

</div>

<table class="table">
    <thead>
        <tr>

            <th scope="col">Pseudo</th>

            <th scope="col">Date de création</th>

            <th scope="col"></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['users'] as $user) : ?>
        <tr>

            <td><?= $user->username; ?></td>
            <td><?php $date = date_create($user->created_at);
                    echo date_format($date, 'd.m.Y'); ?></td>
            <td>
                <form action="<?= URLROOT; ?>/users/delete/<?= $user->id; ?>" method="post">
                    <input type="hidden" value="<?= $user->id; ?>">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<td><a href="<?= URLROOT; ?>/users/register" class="btn btn-primary">
        Créer un nouvel utilisateur
    </a>
</td>








<?php require APPROOT . "/views/inc/footer.php"; ?>