<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>File Upload</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h4 class="card-title mb-4">Upload a File</h4>
            <form method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="file" class="form-label">Choose file</label>
                <input multiple class="form-control" type="file" id="file" name="file[]" >
              </div>
              <button type="submit" class="btn btn-primary w-100">Upload</button>
            </form>
            <hr>
            <?php
              require("multiUploadFile.php");
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
