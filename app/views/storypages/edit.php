<?php require APPROOT . "/views/inc/header.php"; ?>
<a href="<?php echo URLROOT; ?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
    <?php if ($data['sub-id'] ==  1) : ?>
    <h2>Edit Cover Page</h2>
    <?php else : ?>
    <h2> Edit Page </h2>
    <?php endif ?>
    <form action="<?= URLROOT ?>/storypages/edit/<?= $data['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>

        <input type="hidden" name="story-id" value="<?= $data['story-id']; ?>">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <div class="form-group">
            <label for="body-text">Body</label>
            <textarea name="body-text" class="form-control" id="body-text"
                rows="3"><?= $data['body-text']; ?></textarea>
        </div>

        <?php if (!empty($data['background-img'])) : ?>
        <p>Current Background Image :</p>
        <img src="<?= URLROOT . '/public/uploads/' . $data['background-img'] ?>" class="img-thumbnail w-25">
        <div class="form-group">
            <label for="background-img">Change Background Image</label>
            <input name="background-img" type="file" class="form-control-file" id="background-img">
        </div>

        <a href="<?= URLROOT ?>/storypages/deletebg/<?= $data['id']; ?>" class="btn btn-primary">DELETE BG</a>

        <?php else : ?>
        <div class="form-group">
            <label for="background-img">Add Background Image</label>
            <input name="background-img" type="file" class="form-control-file" id="background-img">
        </div>
        <?php endif ?>

        <div class="form-group">
            <label for="title">Background credits: <sup>*</sup></label>
            <input type="text" name="background-credits"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['background-credits']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>

        <div class="form-group">
            <label for="background-animation">Background Animation</label>
            <select name="background-animation" class="form-control" id="exampleFormControlSelect2">
                <option <?= ($data['background-animation'] == 'Ease-in') ? 'selected' : ''; ?>>Ease-in</option>
                <option <?= ($data['background-animation'] == 'Ease-out') ? 'selected' : ''; ?>>Ease-out</option>
                <option <?= ($data['background-animation'] == 'Zoom-in') ? 'selected' : ''; ?>>Zoom-in</option>
                <option <?= ($data['background-animation'] == 'Zoom-out') ? 'selected' : ''; ?>>Zoom-out</option>
            </select>
        </div>

        <?php if (!empty($data['picture-img'])) : ?>
        <p>Current picture Image :</p>
        <img src="<?= URLROOT . '/public/uploads/' . $data['picture-img'] ?>" class="img-thumbnail w-25">
        <div class="form-group">
            <label for="picture-img">Change picture Image</label>
            <input name="picture-img" type="file" class="form-control-file" id="picture-img">
        </div>

        <a href="<?= URLROOT ?>/storypages/deletepic/<?= $data['id']; ?>" class="btn btn-primary">DELETE PIC</a>
        <?php else : ?>
        <div class="form-group">
            <label for="picture-img">Add picture Image</label>
            <input name="picture-img" type="file" class="form-control-file" id="picture-img">
        </div>
        <?php endif ?>

        <div class="form-group">
            <label for="title">Picture credits: <sup>*</sup></label>
            <input type="text" name="picture-credits"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['picture-credits']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>

        <div class="form-group">
            <label for="picture-animation">Picture Animation</label>
            <select name="picture-animation" class="form-control" id="exampleFormControlSelect2">
                <option <?= ($data['picture-animation'] == 'Ease-in') ? 'selected' : ''; ?>>Ease-in</option>
                <option <?= ($data['picture-animation'] == 'Ease-out') ? 'selected' : ''; ?>>Ease-out</option>
                <option <?= ($data['picture-animation'] == 'Zoom-in') ? 'selected' : ''; ?>>Zoom-in</option>
                <option <?= ($data['picture-animation'] == 'Zoom-out') ? 'selected' : ''; ?>>Zoom-out</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-size">Text Block Size</label>
            <select name="text-block-size" class="form-control" id="exampleFormControlSelect2">
                <option <?= ($data['text-block-size'] == 'Full Size') ? 'selected' : ''; ?>>Full Size</option>
                <option <?= ($data['text-block-size'] == '1 / 2') ? 'selected' : ''; ?>>1 / 2</option>
                <option <?= ($data['text-block-size'] == '1 / 3') ? 'selected' : ''; ?>>1 / 3</option>
                <option <?= ($data['text-block-size'] == '1 / 4') ? 'selected' : ''; ?>>1 / 4</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-position">Text Block Position</label>
            <select name="text-block-position" class="form-control" id="exampleFormControlSelect2">
                <option <?= ($data['text-block-position'] == 'Full Size') ? 'selected' : ''; ?>>Full Size</option>
                <option <?= ($data['text-block-position'] == '1 / 2 Top') ? 'selected' : ''; ?>>1 / 2 Top</option>
                <option <?= ($data['text-block-position'] == '1 / 2 Bottom') ? 'selected' : ''; ?>>1 / 2 Bottom</option>
                <option <?= ($data['text-block-position'] == '1 / 3 Top') ? 'selected' : ''; ?>>1 / 3 Top</option>
                <option <?= ($data['text-block-position'] == '1 / 3 Middle') ? 'selected' : ''; ?>>1 / 3 Middle</option>
                <option <?= ($data['text-block-position'] == '1 / 3 Bottom') ? 'selected' : ''; ?>>1 / 3 Bottom</option>
                <option <?= ($data['text-block-position'] == '1 / 4 Top') ? 'selected' : ''; ?>>1 / 4 Top</option>
                <option <?= ($data['text-block-position'] == '1 / 4 Middle Top') ? 'selected' : ''; ?>>1 / 4 Middle Top
                </option>
                <option <?= ($data['text-block-position'] == '1 / 4 Middle Bottom') ? 'selected' : ''; ?>>1 / 4 Middle
                    Bottom</option>
                <option <?= ($data['text-block-position'] == '1 / 4 Bottom') ? 'selected' : ''; ?>>1 / 4 Bottom</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-animation">Text Block Animation</label>
            <select name="text-block-animation" class="form-control" id="exampleFormControlSelect2">
                <option <?= ($data['text-block-animation'] == 'Ease-in') ? 'selected' : ''; ?>>Ease-in</option>
                <option <?= ($data['text-block-animation'] == 'Ease-out') ? 'selected' : ''; ?>>Ease-out</option>
                <option <?= ($data['text-block-animation'] == 'Zoom-in') ? 'selected' : ''; ?>>Zoom-in</option>
                <option <?= ($data['text-block-animation'] == 'Zoom-out') ? 'selected' : ''; ?>>Zoom-out</option>
            </select>
        </div>

        <input type="submit" value="Edit page" class="btn btn-success">
    </form>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>