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
            <label for="background-size">Change Picture Size</label>
            <select name="background-size" class="form-control">
                <option value="cover" <?= ($data['background-size'] == 'cover') ? 'selected' : ''; ?>>Cover</option>
                <option value="contain" <?= ($data['background-size'] == 'contain') ? 'selected' : ''; ?>>Contain
                </option>
            </select>
        </div>


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
                <option <?= ($data['background-animation'] == '') ? 'selected' : ''; ?> value="">Aucune</option>
                <option <?= ($data['background-animation'] == 'fade-in') ? 'selected' : ''; ?> value="fade-in">Fade-In
                </option>
                <option <?= ($data['background-animation'] == 'twirl-in') ? 'selected' : ''; ?> value="twirl-in">
                    Twirl-In</option>
                <option <?= ($data['background-animation'] == 'fly-in-left') ? 'selected' : ''; ?> value="fly-in-left">
                    Fly-In-Left</option>
                <option <?= ($data['background-animation'] == 'fly-in-right') ? 'selected' : ''; ?>
                    value="fly-in-right">Fly-In-Right</option>
                <option <?= ($data['background-animation'] == 'fly-in-top') ? 'selected' : ''; ?> value="fly-in-top">
                    Fly-In-Top</option>
                <option <?= ($data['background-animation'] == 'fly-in-bottom') ? 'selected' : ''; ?>
                    value="fly-in-bottom">Fly-In-Bottom</option>
                <option <?= ($data['background-animation'] == 'rotate-in-left') ? 'selected' : ''; ?>
                    value="rotate-in-left">Rotate-In-Left</option>
                <option <?= ($data['background-animation'] == 'rotate-in-right') ? 'selected' : ''; ?>
                    value="rotate-in-right">Rotate-In-Right</option>
                <option <?= ($data['background-animation'] == 'drop-in') ? 'selected' : ''; ?> value="drop-in">Drop-In
                </option>
                <option <?= ($data['background-animation'] == 'whoosh-in-left') ? 'selected' : ''; ?>
                    value="whoosh-in-left">Whoosh-In-Left</option>
                <option <?= ($data['background-animation'] == 'whoosh-in-right') ? 'selected' : ''; ?>
                    value="whoosh-in-right">Whoosh-In-Right</option>
                <option <?= ($data['background-animation'] == 'zoom-in') ? 'selected' : ''; ?> value="zoom-in">Zoom-In
                </option>
                <option <?= ($data['background-animation'] == 'zoom-out') ? 'selected' : ''; ?> value="zoom-out">
                    Zoom-Out</option>
                <option <?= ($data['background-animation'] == 'pan-left') ? 'selected' : ''; ?> value="pan-left">
                    Pan-Left</option>
                <option <?= ($data['background-animation'] == 'pan-right') ? 'selected' : ''; ?> value="pan-right">
                    Pan-Right</option>
                <option <?= ($data['background-animation'] == 'pan-up') ? 'selected' : ''; ?> value="pan-up">Pan-Up
                </option>
                <option <?= ($data['background-animation'] == 'Pan-Down') ? 'selected' : ''; ?> value="pan-down">
                    Pan-Down</option>
            </select>
        </div>

        <div class="form-group">
            <label for="background-animation-duration">background Animation Duration</label>
            <select name="background-animation-duration" class="form-control">
                <option <?= ($data['background-animation-duration'] == '1') ? 'selected' : ''; ?> value="1">1</option>
                <option <?= ($data['background-animation-duration'] == '2') ? 'selected' : ''; ?> value="2">2</option>
                <option <?= ($data['background-animation-duration'] == '3') ? 'selected' : ''; ?> value="3">3</option>
                <option <?= ($data['background-animation-duration'] == '4') ? 'selected' : ''; ?> value="4">4</option>
                <option <?= ($data['background-animation-duration'] == '5') ? 'selected' : ''; ?> value="5">5</option>
                <option <?= ($data['background-animation-duration'] == '6') ? 'selected' : ''; ?> value="6">6</option>
                <option <?= ($data['background-animation-duration'] == '7') ? 'selected' : ''; ?> value="7">7</option>
                <option <?= ($data['background-animation-duration'] == '8') ? 'selected' : ''; ?> value="8">8</option>
                <option <?= ($data['background-animation-duration'] == '9') ? 'selected' : ''; ?> value="9">9</option>
                <option <?= ($data['background-animation-duration'] == '10') ? 'selected' : ''; ?> value="10">10
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-size-position">Text Block Size and Position</label>
            <select name="text-block-size-position" class="form-control" id="exampleFormControlSelect2">
                <option value="full-size" <?= ($data['text-block-size-position'] == 'full-size') ? 'selected' : ''; ?>>
                    Full Size</option>
                <option value="half-top" <?= ($data['text-block-size-position'] == 'half-top') ? 'selected' : ''; ?>>1 /
                    2 Top</option>
                <option value="half-middle"
                    <?= ($data['text-block-size-position'] == 'half-middle') ? 'selected' : ''; ?>>1 / 2 Middle</option>
                <option value="half-bottom"
                    <?= ($data['text-block-size-position'] == 'half-bottom') ? 'selected' : ''; ?>>1 / 2 Bottom</option>
                <option value="third-top" <?= ($data['text-block-size-position'] == 'third-top') ? 'selected' : ''; ?>>1
                    / 3 Top</option>
                <option value="third-middle"
                    <?= ($data['text-block-size-position'] == 'third-middle') ? 'selected' : ''; ?>>1 / 3 Middle
                </option>
                <option value="third-bottom"
                    <?= ($data['text-block-size-position'] == 'third-bottom') ? 'selected' : ''; ?>>1 / 3 Bottom
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-animation">text-block Animation</label>
            <select name="text-block-animation" class="form-control" id="exampleFormControlSelect2">
                <option <?= ($data['text-block-animation'] == '') ? 'selected' : ''; ?> value="">Aucune</option>
                <option <?= ($data['text-block-animation'] == 'fade-in') ? 'selected' : ''; ?> value="fade-in">Fade-In
                </option>
                <option <?= ($data['text-block-animation'] == 'twirl-in') ? 'selected' : ''; ?> value="twirl-in">
                    Twirl-In
                </option>
                <option <?= ($data['text-block-animation'] == 'fly-in-left') ? 'selected' : ''; ?> value="fly-in-left">
                    Fly-In-Left</option>
                <option <?= ($data['text-block-animation'] == 'fly-in-right') ? 'selected' : ''; ?>
                    value="fly-in-right">
                    Fly-In-Right</option>
                <option <?= ($data['text-block-animation'] == 'fly-in-top') ? 'selected' : ''; ?> value="fly-in-top">
                    Fly-In-Top</option>
                <option <?= ($data['text-block-animation'] == 'fly-in-bottom') ? 'selected' : ''; ?>
                    value="fly-in-bottom">
                    Fly-In-Bottom</option>
                <option <?= ($data['text-block-animation'] == 'rotate-in-left') ? 'selected' : ''; ?>
                    value="rotate-in-left">Rotate-In-Left</option>
                <option <?= ($data['text-block-animation'] == 'rotate-in-right') ? 'selected' : ''; ?>
                    value="rotate-in-right">Rotate-In-Right</option>
                <option <?= ($data['text-block-animation'] == 'drop-in') ? 'selected' : ''; ?> value="drop-in">Drop-In
                </option>
                <option <?= ($data['text-block-animation'] == 'whoosh-in-left') ? 'selected' : ''; ?>
                    value="whoosh-in-left">Whoosh-In-Left</option>
                <option <?= ($data['text-block-animation'] == 'whoosh-in-right') ? 'selected' : ''; ?>
                    value="whoosh-in-right">Whoosh-In-Right</option>
                <option <?= ($data['text-block-animation'] == 'zoom-in') ? 'selected' : ''; ?> value="zoom-in">Zoom-In
                </option>
                <option <?= ($data['text-block-animation'] == 'zoom-out') ? 'selected' : ''; ?> value="zoom-out">
                    Zoom-Out
                </option>
                <option <?= ($data['text-block-animation'] == 'pan-left') ? 'selected' : ''; ?> value="pan-left">
                    Pan-Left
                </option>
                <option <?= ($data['text-block-animation'] == 'pan-right') ? 'selected' : ''; ?> value="pan-right">
                    Pan-Right</option>
                <option <?= ($data['text-block-animation'] == 'pan-up') ? 'selected' : ''; ?> value="pan-up">Pan-Up
                </option>
                <option <?= ($data['text-block-animation'] == 'Pan-Down') ? 'selected' : ''; ?> value="pan-down">
                    Pan-Down
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-animation-duration">Text Block Animation Duration</label>
            <select name="text-block-animation-duration" class="form-control">
                <option <?php ($data['text-block-animation-duration'] == '1') ? 'selected' : ''; ?> value="1">1</option>
                <option <?= ($data['text-block-animation-duration'] == '2') ? 'selected' : ''; ?> value="2">2</option>
                <option <?= ($data['text-block-animation-duration'] == '3') ? 'selected' : ''; ?> value="3">3</option>
                <option <?= ($data['text-block-animation-duration'] == '4') ? 'selected' : ''; ?> value="4">4</option>
                <option <?= ($data['text-block-animation-duration'] == '5') ? 'selected' : ''; ?> value="5">5</option>
                <option <?= ($data['text-block-animation-duration'] == '6') ? 'selected' : ''; ?> value="6">6</option>
                <option <?= ($data['text-block-animation-duration'] == '7') ? 'selected' : ''; ?> value="7">7</option>
                <option <?= ($data['text-block-animation-duration'] == '8') ? 'selected' : ''; ?> value="8">8</option>
                <option <?= ($data['text-block-animation-duration'] == '9') ? 'selected' : ''; ?> value="9">9</option>
                <option <?= ($data['text-block-animation-duration'] == '10') ? 'selected' : ''; ?> value="10">10
                </option>
            </select>
        </div>

        <input type="submit" value="Edit page" class="btn btn-success">
    </form>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>