# File-Uploading

A simple PHP project for uploading multiple images at once, with validation on both the client side (JavaScript) and the server side (PHP).

## Features

- Upload one or many images in a single request
- Client-side checks (file type, file size, total size, file count) before the form is submitted
- Server-side validation:
  - Upload error check for each file
  - Allowed extensions whitelist (`jpg`, `jpeg`, `png`, `gif`)
  - Maximum file size per image
  - Real image verification using `getimagesize()`
- Handles the case where the request exceeds `post_max_size`
- Saves files with unique names to avoid overwriting
- Bootstrap alerts for success and error messages
- Output escaped with `htmlspecialchars()`

## Requirements

- PHP 8.0 or higher
- A local server such as XAMPP (Apache + PHP)

## Installation

1. Clone the repository into your server's web root (for XAMPP: `htdocs`):

   ```bash
   git clone https://github.com/engahmedwalid99/File-Uploading.git
   ```

2. Start Apache from the XAMPP Control Panel.
3. Open the project in your browser:

   ```
   http://localhost/File-Uploading/
   ```

## PHP Configuration

If large uploads fail, update these values in `php.ini` and restart Apache:

```ini
post_max_size = 128M
upload_max_filesize = 64M
max_file_uploads = 50
```

`post_max_size` must be larger than `upload_max_filesize` and larger than the total size of all files uploaded at once.

## Form Example

```html
<form method="POST" enctype="multipart/form-data">
    <input multiple class="form-control" type="file" id="file" name="file[]"
           accept="image/jpeg,image/png,image/gif">
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
```

Important points:

- `enctype="multipart/form-data"` is required on the form.
- The input name must be `file[]` and it must have the `multiple` attribute.

## How It Works

1. The browser validates the selected files and blocks the submit if something is wrong.
2. PHP checks whether the request exceeded `post_max_size`.
3. PHP validates every file (error code, extension, size, real image).
4. If any file fails validation, nothing is uploaded and all errors are shown.
5. If all files pass, each one is saved to `uploads/` with a unique name.

## Project Structure

```
File-Uploading/
├── index.php
├── multiUploadFile.php
├── uploads/
│   └── .gitkeep
├── .gitignore
└── README.md
```

## Security Notes

- Never rely on the file extension alone; the project also verifies the file content.
- Uploaded files are renamed with `uniqid()` so user-supplied names are never used on disk.
- Client-side validation is for convenience only; the server-side checks are the real protection.
- The `uploads/` folder is excluded from Git so uploaded images are not committed.

## .gitignore

```
uploads/*
!uploads/.gitkeep
```

## Author

[engahmedwalid99](https://github.com/engahmedwalid99)
