<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $errors = array();

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $image      = $_FILES['file'];
        $imagename  = basename($image['name']);
        $imageSize  = $image['size'];
        $imageDIR   = $image['tmp_name'];

        $allowed_extentions = ['jpg', 'gif', 'jpeg', 'png'];
        $parts              = explode('.', $imagename);
        $imageExtention     = strtolower(end($parts));

        if (!in_array($imageExtention, $allowed_extentions)) {
            $errors[] = "Image Extention $imageExtention is not supported.";
        }

        if ($imageSize > 3829382938938) {
            $errors[] = "Image Size Can't Br More Than 100000";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger' role='alert'>
                        $error
                      </div>";
            }
            return;
        }

        if (!is_dir(__DIR__ . "/uploads/")) {
            mkdir(__DIR__ . "/uploads/", 0755, true);
        }

        $uploadedDIR = __DIR__ . "/uploads/";
        $uploaded    = move_uploaded_file($imageDIR, $uploadedDIR . basename($imagename));

        if ($uploaded) {
            echo "<div class='alert alert-success'>File " . basename($image_name) . " uploaded successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Failed to save the file.</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>
                No File Uploaded.
              </div>";
    }
}
