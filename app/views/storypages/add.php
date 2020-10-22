<?php require APPROOT . "/views/inc/header.php"; ?>
<a href="<?php echo URLROOT; ?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">

    <h2>Add Page</h2>
    <p>Create a Page with this form</p>
    <form action="<?= URLROOT ?>/storypages/add" method="post" enctype="multipart/form-data">
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
            <label for="background-img">Choose Picture</label>
            <input name="background-img" type="file" class="form-control-file" id="background-img">
        </div>

        <div class="form-group">
            <label for="background-size">Choose Picture Size</label>
            <select name="background-size" class="form-control">
                <option value="cover">Cover</option>
                <option value="contain">Contain</option>
            </select>
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
                <option value="">Aucune</option>
                <option value="fade-in">Fade-In</option>
                <option value="twirl-in">Twirl-In</option>
                <option value="fly-in-left">Fly-In-Left</option>
                <option value="fly-in-right">Fly-In-Right</option>
                <option value="fly-in-top">Fly-In-Top</option>
                <option value="fly-in-bottom">Fly-In-Bottom</option>
                <option value="rotate-in-left">Rotate-In-Left</option>
                <option value="rotate-in-right">Rotate-In-Right</option>
                <option value="drop-in">Drop-In</option>
                <option value="whoosh-in-left">Whoosh-In-Left</option>
                <option value="whoosh-in-right">Whoosh-In-Right</option>
                <option value="zoom-in">Zoom-In</option>
                <option value="zoom-out">Zoom-Out</option>
                <option value="pan-left">Pan-Left</option>
                <option value="pan-right">Pan-Right</option>
                <option value="pan-up">Pan-Up</option>
                <option value="pan-down">Pan-Down</option>
            </select>
        </div>

        <div class="form-group">
            <label for="background-animation-duration">background Animation Duration</label>
            <select name="background-animation-duration" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-size-position">Text Block Size and Position</label>
            <select name="text-block-size-position" class="form-control" id="exampleFormControlSelect2">
                <option value="full-size">Full Size</option>
                <option value="half-top">1 / 2 Top</option>
                <option value="half-middle">1 / 2 Middle</option>
                <option value="half-bottom">1 / 2 Bottom</option>
                <option value="third-top">1 / 3 Top</option>
                <option value="third-middle">1 / 3 Middle</option>
                <option value="third-bottom">1 / 3 Bottom</option>
            </select>
        </div>


        <div class="form-group">
            <label for="text-block-animation">Text Block Animation</label>
            <select name="text-block-animation" class="form-control">
                <option value="">Aucune</option>
                <option value="fade-in">Fade-In</option>
                <option value="twirl-in">Twirl-In</option>
                <option value="fly-in-left">Fly-In-Left</option>
                <option value="fly-in-right">Fly-In-Right</option>
                <option value="fly-in-top">Fly-In-Top</option>
                <option value="fly-in-bottom">Fly-In-Bottom</option>
                <option value="rotate-in-left">Rotate-In-Left</option>
                <option value="rotate-in-right">Rotate-In-Right</option>
                <option value="drop-in">Drop-In</option>
                <option value="whoosh-in-left">Whoosh-In-Left</option>
                <option value="whoosh-in-right">Whoosh-In-Right</option>
                <option value="zoom-in">Zoom-In</option>
                <option value="zoom-out">Zoom-Out</option>
                <option value="pan-left">Pan-Left</option>
                <option value="pan-right">Pan-Right</option>
                <option value="pan-up">Pan-Up</option>
                <option value="pan-down">Pan-Down</option>
            </select>
        </div>

        <div class="form-group">
            <label for="text-block-animation-duration">text-block Animation Duration</label>
            <select name="text-block-animation-duration" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>

        <input type="submit" value="Add page" class="btn btn-success">
    </form>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>