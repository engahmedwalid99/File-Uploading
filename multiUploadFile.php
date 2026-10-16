<?php

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  if(!isset($_FILES['file']) || $_FILES['file']['error'][0] === UPLOAD_ERR_NO_FILE){
    echo "<div class='alert alert-danger'>No File Choosed</div>";
  }else{
    $image = $_FILES['file'];
    $MAX_INAGE_SIZE = 100000;
    $countImages = count($image['name']);
    $allowed_extensions = ['jpg', 'gif', 'jpeg', 'png'];
    $errors = [];

    for($i = 0; $i < $countImages; $i++){
      $num = $i + 1;

      if($image['error'][$i] != UPLOAD_ERR_OK){
        $errors[] = "Image Number $num not Uploaded.";
        continue;
      }

      $part = explode('.', $image['name'][$i]);
      $ext = strtolower(pathinfo($image['name'][$i], PATHINFO_EXTENSION));

      if(!in_array($ext, $allowed_extensions)){
        $errors[] = "Image Number $num not allowed extention.";
        continue;
      }
    }

    if(!empty($errors)){
      foreach ($errors as $error) {
        echo "<div class='alert alert-danger' role='alert'>" . htmlspecialchars($error) . "</div>";
      }
    }else{
      if(!is_dir(__DIR__ . "/uploads/")){
        mkdir(__DIR__ . "/uploads/");
      }

      $uploaded_DIR = __DIR__ . "/uploads/";

      for($i = 0; $i < $countImages; $i++){
        $new_name = uniqid("img_", true) . "." . $ext;
        $original_name = htmlspecialchars(basename($image['name'][$i]));

        $uploaded = move_uploaded_file($image['tmp_name'][$i], $uploaded_DIR . $new_name);
        if($uploaded){
          echo "<div class='alert alert-success'>File $original_name uploaded successfully!</div>";
        }else{
          echo "<div class='alert alert-danger'>Failed to save $original_name.</div>";
        }
      }
    }
  }
}
