<!DOCTYPE html>
<html>
<head>
    <title>File Upload </title>
    <style>
        .file-list {
            margin-top: 20px;
        }
        .file-list li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>File Upload </h1>

    <?php
	

$uploads_dir = 'uploads';

if (!file_exists($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
}

$file_name = $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];

move_uploaded_file($file_tmp, $uploads_dir . '/' . $file_name);

    
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

       
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];

        
        move_uploaded_file($file_tmp, 'uploads/' . $file_name);

        
        $uploaded_files[] = [
            'name' => $file_name,
            'size' => $file_size
        ];
    }
    ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>

    <?php if (!empty($uploaded_files)) : ?>
        <ul class="file-list">
            <?php foreach ($uploaded_files as $file) : ?>
                <li>
                    <a href="uploads/<?php echo $file['name']; ?>" download="<?php echo $file['name']; ?>"><?php echo $file['name']; ?></a>
                    (<?php echo format_file_size($file['size']); ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php
    
    function format_file_size($size)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $i = 0;
        while ($size >= 1024 && $i < 4) {
            $size /= 1024;
            $i++;
        }
        return round($size, 2) . ' ' . $units[$i];
    }
    ?>
	
</body>
</html>
