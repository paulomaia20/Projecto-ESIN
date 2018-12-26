 <?php 
  // Generate filenames for original, small and medium files
  $originalFileName = "img/originals/$username.jpg";
  $smallFileName = "img/thumbs_small/$username.jpg";
  // Move the uploaded file to its final destination
  move_uploaded_file($_FILES['image']['tmp_name'], $originalFileName);

  $path_img=$username.'.jpg'; 

  // Create an image representation of the original image
  $original = imagecreatefromjpeg($originalFileName);

  $width = imagesx($original);     // width of the original image
  $height = imagesy($original);    // height of the original image
  $square = min($width, $height);  // size length of the maximum square

  // Create and save a small square thumbnail
  $small = imagecreatetruecolor(150, 150);
  imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
  imagejpeg($small, $smallFileName);
  ?> 