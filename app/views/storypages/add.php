<?php require APPROOT . "/views/inc/header.php"; ?>
<a href="<?php echo URLROOT; ?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">

    <h2>Add Page</h2>
    <p>Create a Page with this form</p>
    <form action="<?= URLROOT ?>/storypages/add" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cover" value="cover" id="coverCheck">
                <label class="form-check-label" for="defaultCheck1">
                    Cover page
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>

        <input type="hidden" name="story-id" value="<?= getLastElementOfUrl() ?>">

        <div class="form-group">
            <label for="body-text">Body</label>
            <textarea name="body-text" class="form-control" id="body-text" rows="3"></textarea>
        </div>


        <div class="form-group">
            <label for="background-img">Choose Background</label>
            <input name="background-img" type="file" class="form-control-file" id="background-img">
        </div>


        <div class="form-group">
            <label for="title">Background credits: <sup>*</sup></label>
            <input type="text" name="background-credits"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>

        <div class="form-group">
            <label for="background-animation">Background Animation</label>
            <select name="background-animation" class="form-control" id="exampleFormControlSelect2">
                <option>Ease-in</option>
                <option>Ease-out</option>
                <option>Zoom-in</option>
                <option>Zoom-out</option>
            </select>
        </div>

        <div class="form-group">
            <label for="picture-img">Choose Picture</label>
            <input type="file" name="picture-img" class="form-control-file" id="picture-img">
        </div>

        <div class="form-group">
            <label for="title">Picture credits: <sup>*</sup></label>
            <input type="text" name="picture-credits"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>

        <div class="form-group">
            <label for="picture-animation">Picture Animation</label>
            <select name="picture-animation" class="form-control" id="exampleFormControlSelect2">
                <option>Ease-in</option>
                <option>Ease-out</option>
                <option>Zoom-in</option>
                <option>Zoom-out</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-size">Text Block Size</label>
            <select name="text-block-size" class="form-control" id="exampleFormControlSelect2">
                <option>Full Size</option>
                <option>1 / 2</option>
                <option>1 / 3</option>
                <option>1 / 4</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-position">Text Block Position</label>
            <select name="text-block-position" class="form-control" id="exampleFormControlSelect2">
                <option>Full Size</option>
                <option>1 / 2 Top</option>
                <option>1 / 2 Bottom</option>
                <option>1 / 3 Top</option>
                <option>1 / 3 Middle</option>
                <option>1 / 3 Bottom</option>
                <option>1 / 4 Top</option>
                <option>1 / 4 Middle Top</option>
                <option>1 / 4 Middle Bottom</option>
                <option>1 / 4 Bottom</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-animation">Text Block Animation</label>
            <select name="text-block-animation" class="form-control" id="exampleFormControlSelect2">
                <option>Ease-in</option>
                <option>Ease-out</option>
                <option>Zoom-in</option>
                <option>Zoom-out</option>
            </select>
        </div>

        <input type="submit" value="Add page" class="btn btn-success">
    </form>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>