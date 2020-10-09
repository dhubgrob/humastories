<?php require APPROOT . "/views/inc/header.php"; ?>
    <a href="<?php echo URLROOT;?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
    <div class="card card-body bg-light mt-5">
        
        <h2>Edit Story</h2>
        <p>Update a story with this form</p>
        <form action="<?= URLROOT?>/stories/edit/<?= $data['story-id'];?>" method="post">
            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?php echo(!empty($data['title_err'])) ? 'is-invalid' : '';?>" value="<?= $data['story-title'] ?>">
                <span class="invalid-feedback"><?php echo $data['title_err'];?></span>
            </div>
            <div class="form-group">
                <label for="heading">Heading: <sup>*</sup></label>
                <select name="heading" class="form-control" id="" value="<?php foreach($data['story'] as $story) : echo $story->heading ; endforeach; ?>">
                    <option>heading</option>
                    <option value="histoire" <?php echo($data['story-heading'] == 'histoire') ? 'selected' : ''; ?>>histoire</option>
                    <option value ="sciences" <?php echo($data['story-heading'] == 'sciences') ? 'selected' : ''; ?>>sciences</option>
                    <option value ="politique" <?php echo($data['story-heading'] == 'politique') ? 'selected' : ''; ?>>politique</option>
                </select>
                <span class="invalid-feedback"><?php echo $data['heading_err'];?></span>
            </div>
            <input type="submit" value="Update Page" class="btn btn-success">
        </form>
    </div>
<?php require APPROOT . "/views/inc/footer.php"; ?>