<?php require APPROOT . "/views/inc/header.php"; ?>
<div class="row">
<div class="col-md-6">
<a href="<?php echo URLROOT;?>/stories" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <h1>Story Pages for Story : 
    <?php foreach($data['story'] as $storybase) :?>   
    <?= $storybase->title; ?>
    <?php endforeach ; ?>
  </h1>
</div>
<div class="col-md-6">
</div>
</div>

<?php if(empty($data['storypages'])) : ?>
   <a href="<?= URLROOT;?>/storypages/add/<?php foreach($data['story'] as $storybase):?><?= $storybase->id; ?>
    <?php endforeach ; ?>" class="btn btn-primary">Créer la première page</a>
<?php else : ?>

        <table class="table">
  <thead>
    <tr>
      
      <th scope="col">Title</th>
      <th scope="col">Heading</th>
      <th scope="col">Created At</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($data['storypages'] as $story) :?>
    <tr>
     
      <td><?= $story->title; ?></td>
      <td><a href="<?php URLROOT;?>/storypages/edit/<?= $story->id;?>" class="btn btn-primary pull-right">
Edit
</a></td>
<td><a href="<?php URLROOT;?>/storypages/delete/<?= $story->id;?>" class="btn btn-danger pull-right">
Delete
</a></td>
    </tr>
    <?php endforeach ;?>
  </tbody>
</table>
<?php endif ?>




    


<?php require APPROOT . "/views/inc/footer.php"; ?>