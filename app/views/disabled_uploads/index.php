<?php
var_dump($data);
foreach ($data['picture'] as $picture) {
    echo ($picture['id']);
}
echo URLROOT . '/' . $data['filename_background_img'];
?>

<img src="http://localhost/humastories/uploads/phph1huA0.jpg">