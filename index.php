<?php
    /**
     * @file index.php
     * 
     * This HTML/PHP file is used for demonstrating the functionality in list_files.php.
     * 
     * @author Kenny Carlile
     * @date January 21, 2023
     * @link https://www.kcarlile.com/
     * @link https://github.com/KCarlile
     * @link https://github.com/KCarlile/php-file-listing
     */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP File Listing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>PHP File Listing</h1>
            <p><a href="https://github.com/KCarlile/">KCarlile</a>/<a href="https://github.com/KCarlile/php-file-listing">php-file-listing</a></p>
        </header>
        <hr />
        <?php
            require('list_files.php');
            $files_to_exclude = ["file1","file2"];
        ?>
        <h2>Default File Listing</h2>
        <p>Code: <code><?php print(htmlspecialchars("<?php list_files(); ?>", ENT_QUOTES)); ?></code></p>
        <?php list_files(); ?>
        <h2>Specified File Directory</h2>
        <p>Code: <code><?php print(htmlspecialchars("<?php list_files(files_directory: \"files\"); ?>", ENT_QUOTES)); ?></code></p>
        <?php list_files(files_directory: "files"); ?>
        <h2>Excluded Files</h2>
        <p>Code: <code><?php print(htmlspecialchars("<?php list_files(files_to_exclude: \$files_to_exclude); ?>", ENT_QUOTES)); ?></code></p>
        <?php list_files(files_to_exclude: $files_to_exclude); ?>
        <h2>Ordered List</h2>
        <p>Code: <code><?php print(htmlspecialchars("<?php list_files(ordered_list: TRUE); ?>", ENT_QUOTES)); ?></code></p>
        <?php list_files(ordered_list: TRUE); ?>
        <footer>
            <p>Copyright ©<?php print((date('Y') === "2023") ? "2023" : "2023-" . date('Y')); ?> <a href="https://www.kcarlile.com/">Kenny Carlile</a></p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
