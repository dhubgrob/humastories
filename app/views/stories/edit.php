<?php require APPROOT . "/views/inc/header.php"; ?>
<a href="<?= URLROOT; ?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">

    <h2>Edit Story</h2>
    <p>Update a story with this form</p>
    <form action="<?= URLROOT ?>/stories/edit/<?= $data['story-id']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title"
                class="form-control form-control-lg <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['story-title'] ?>">
            <span class="invalid-feedback"><?= $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="heading">Heading: <sup>*</sup></label>
            <select name="heading" class="form-control" id="" value="<?php foreach ($data['story'] as $story) : echo $story->heading;
                                                                        endforeach; ?>">
                <option>heading</option>
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
            <label for="linked_content_title">Linked Content Title: <sup>*</sup></label>
            <input type="text" name="linked_content_title"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo (isset($data['story-linked-content-title'])) ?  $data['story-linked-content-title'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="linked_content_url">Linked Content URL: <sup>*</sup></label>
            <input type="text" name="linked_content_url"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo (isset($data['story-linked-content-url'])) ?  $data['story-linked-content-url'] : ''; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>

        <?php if (!empty($data['story-linked-content-img'])) : ?>
        <p>Current Linked Content Image :</p>
        <img src="<?= URLROOT . '/public/uploads/' . $data['story-linked-content-img'] ?>" class="img-thumbnail w-25">
        <div class="form-group">
            <label for="linked_content_img">Change Linked Content IMG</label>
            <input name="linked_content_img" type="file" class="form-control-file" id="linked-content-img">
        </div>
        <a href="<?= URLROOT ?>/stories/deletepic/<?= $data['story-id']; ?>" class="btn btn-primary">DELETE PIC</a>
        <?php else : ?>
        <div class="form-group">
            <label for="linked_content_img">Add Linked Content IMG</label>
            <input name="linked_content_img" type="file" class="form-control-file" id="linked-content-img">
        </div>
        <?php endif ?>
        <input type="submit" value="Update Page" class="btn btn-success">
    </form>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>