<?php require APPROOT . "/views/inc/header.php"; ?>

<div class="row">
<div class="col-md-6">
<h1>Stories</h1>
</div>
<div class="col-md-6">

</div>
</div>


   
        


        <table class="table">
  <thead>
    <tr>
      
      <th scope="col">Title</th>
      <th scope="col">Heading</th>
      <th scope="col">Created At</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($data['stories'] as $story) :?>
    <tr>
     
      <td><?= $story->title; ?></td>
      <td><?= $story->heading; ?></td>
      <td><?= $story->created_at; ?></td>
      <td><a href="<?= URLROOT;?>/stories/export/<?= $story->id;?>" class="btn btn-success">
Export
</a></td>
      <td><a href="<?= URLROOT;?>/stories/edit/<?= $story->id;?>" class="btn btn-primary">
Edit
</a></td>
<td><a href="<?= URLROOT;?>/storypages/<?= $story->id;?>" class="btn btn-secondary">
Manage pages
</a></td>
<td><form action="<?= URLROOT;?>/stories/delete/<?= $story->id;?>" method="post">
      <input type="hidden" value="<?= $story->id; ?>">
      <input type="submit" value="delete" class="btn btn-danger">
      </form</td>
    </tr>
    <?php endforeach ;?>
  </tbody>
</table>

<td><a href="<?= URLROOT;?>/stories/add" class="btn btn-primary">
New Story
</a></td>





    


<?php require APPROOT . "/views/inc/footer.php"; ?>