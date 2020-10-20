<?php require APPROOT . "/views/inc/header.php"; ?>
<a href="<?php echo URLROOT; ?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">

    <h2>Add Story</h2>
    <p>Create a story with this form</p>
    <form action="<?= URLROOT ?>/stories/add" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title: <sup>*</sup></label>
            <input type="text" name="title"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?= $data['title']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="heading">Heading: <sup>*</sup></label>
            <select name="heading" class="form-control" id="">
                <option>heading</option>
                <option>histoire</option>
                <option>sciences</option>
                <option>politique</option>
            </select>
            <span class="invalid-feedback"><?php echo $data['heading_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="linked_content_title">Linked Content Title: <sup>*</sup></label>
            <input type="text" name="linked_content_title"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo (isset($data['linked_content_title'])) ?  $data['linked_content_title'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="linked_content_url">Linked Content URL: <sup>*</sup></label>
            <input type="text" name="linked_content_url"
                class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>"
                value="<?php echo (isset($data['linked_content_url'])) ?  $data['linked_content_url'] : ''; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="linked_content_img">Choose Linked Content IMG</label>
            <input name="linked_content_img" type="file" class="form-control-file" id="linked-content-img">
        </div>
        <input type="submit" value="Submit and Add pages" class="btn btn-success">
    </form>
</div>
<?php require APPROOT . "/views/inc/footer.php"; ?>