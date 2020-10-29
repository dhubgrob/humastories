<?php require APPROOT . "/views/inc/header.php"; ?>
<a href="<?= URLROOT; ?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">

    <h2>Modifier une Story</h2>
    <form action="<?= URLROOT ?>/stories/edit/<?= $data['story-id']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre : <sup>*</sup></label>
            <input type="text" name="title"
                class="form-control form-control-lg <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['story-title'] ?>">
            <span class="invalid-feedback"><?= $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="heading">Rubrique : <sup>*</sup></label>
            <select name="heading" class="form-control" id="" value="<?php foreach ($data['story'] as $story) : echo $story->heading;
                                                                        endforeach; ?>">
                <option>rubrique</option>
                <option value="histoire" <?= ($data['story-heading'] == 'histoire') ? 'selected' : ''; ?>>histoire
                </option>
                <option value="sciences" <?= ($data['story-heading'] == 'sciences') ? 'selected' : ''; ?>>sciences
                </option>
                <option value="politique" <?= ($data['story-heading'] == 'politique') ? 'selected' : ''; ?>>politique
                </option>
            </select>
            <span class="invalid-feedback"><?= $data['heading_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="linked_content_title">Titre de l'article lié : <sup>*</sup></label>
            <input type="text" name="linked_content_title"
                class="form-control form-control-lg <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= (isset($data['story-linked-content-title'])) ?  $data['story-linked-content-title'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="linked_content_url">URL de l'article lié : <sup>*</sup></label>
            <input type="text" name="linked_content_url"
                class="form-control form-control-lg <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= (isset($data['story-linked-content-url'])) ?  $data['story-linked-content-url'] : ''; ?>">
            <span class="invalid-feedback"><?= $data['title_err']; ?></span>
        </div>

        <?php if (!empty($data['story-linked-content-img'])) : ?>
        <div class="row">
            <div class="col">
                <p>Image Actuelle de l'article lié :</p>
                <img src="<?= URLROOT . '/public/uploads/' . $data['story-linked-content-img'] ?>"
                    class="img-thumbnail w-25">

            </div>
            <div class="col">
                <div class="form-group mt-2">
                    <label for="linked_content_img">Choisir une autre image :</label>
                    <input name="linked_content_img" type="file" class="form-control-file" id="linked-content-img">

                </div>
            </div>
            <div class="col">
                <a href="<?= URLROOT ?>/stories/deletepic/<?= $data['story-id']; ?>" class="btn btn-danger">Supprimer
                    l'image</a>
            </div>
        </div>




        <?php else : ?>
        <div class="form-group">
            <label for="linked_content_img">Ajouter une image de l'article lié :</label>
            <input name="linked_content_img" type="file" class="form-control-file" id="linked-content-img">
        </div>
        <?php endif ?>
        <input type="submit" value="Update Page" class="btn btn-success">
    </form>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>