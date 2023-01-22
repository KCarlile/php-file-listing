# PHP File Listing

## Overview

This script lists the files in a directory as clickable links. Optionally, the
script can descend into subdirectories and excluded files or directories can
be defined.

GitHub repo: <https://github.com/KCarlile/php-file-listing>

## Usage

### File Placement

You can place your files and subdirectories in the provided `files/` directory
or you can put them in another directory and pass that path as a string to the
function. Note that the directory must be readable by the webserver and it
must be relative to the page.

### Calling the Function

In your HTML, call the PHP function to list files and subdirectories like this:

```php
...
<?php
    require('list_files.php');
    list_files();
?>
...
```

This presumes that your files are in the default location of `files`. There are three other ways to call the function with optional parameters. You must include the `require('list_files.php');` line so PHP knows where to find the functions you calling.

### Overriding Default Parameters by Specifying Explicit Values

The `list_files()` function siguature looks like this:

```php
<?php
    require('list_files.php');
    list_files($files_directory = FILES_DIRECTORY,
                $files_to_exclude = SELF_PARENT_REF,
                $ordered_list = FALSE);
?>
```

The parameters are defined as follows:

| Parameter Name | Description | Default |
| -------------- | ----------- | ------- |
| `files_directory` | The directory, relative to the script's location, in which the files can be found. Does not include a trailing slash. | `"files"` |
| `files_to_exclude` | An array of strings representing files to skip in the listing. References to the current directory and parent directory (`['.','..']`) will be included with any other array of values. | `['.','..']` (current and parent directories) |
| `ordered_list` | Pass `TRUE` to change from and unordered list (`<ul>`) to an ordered list (`<ol>`).  | `FALSE` (i.e. `<ul>`) |

You can specify none, one, two, or three parameters, like this:

```php
<?php
    require('list_files.php');   
    list_files();
    list_files('some-other-files-directory');
    list_files('some-other-files-directory', ['file1','file2']);
    list_files('some-other-files-directory', ['file1','file2'], TRUE);
?>
```

Alternately, you can specify just the default value you want to override without having to specify all preceding parameters, like this:

```php
<?php
    require('list_files.php');
    list_files(files_directory: "files");
    list_files(files_to_exclude: $files_to_exclude);
    list_files(ordered_list: TRUE);
?>
```

## Technical

### Files

- `index.php`
  - Main entrypoint to the application; home page
- `list_files.php`
  - Default values and functions used to print out file listings. The `list_files()` function is the main entry point.
- `css/styles.css`
  - Defines additional styles beyond inherited Bootstrap styles
- `files/`
  - Default location for files to be listed.

### Dependencies

- [PHP >=8.2](https://www.php.net/)
  - This likely works with older versions of PHP, but 8.2 is the version with which this code was developed.

#### Optional Dependencies

- [Twitter Bootstrap 5.3](https://getbootstrap.com/docs/5.3/)
  - Technically, this isn't a dependency as you could use the PHP functionality on any site. However, the default page has been built with Twitter Bootstrap 5.3 (or greater) for convenience.
- [Docker >=4.15](https://www.docker.com/)
  - Docker configuration is provided for easy local development and testing, but you can use the PHP script anywhere you like.
- Bash *nix Shell
  - The `.server` and `setup-etc-hosts` files are written for Bash in *nix (Mac OS X, specifically) are helpful for Docker setup, but not required.

### Local Environment

- `Dockerfile`
  - Defines container with Apache 2.x, PHP 8.x, and enables MOD REWRITE in Apache
- `docker-compose.yml`
  - Launches the container
- `server`
  - Launches the Docker container at <http://php-file-listing.local/>
- `setup-etc-hosts`
  - Adds the proper entry to /etc/hosts, but must be run as root (`$ sudo ./setup-etc-hosts`)

## Author

Kenny Carlile

- GitHub account: [KCarlile](https://github.com/KCarlile)
- Website: [KCarlile.com](https://www.kcarlile.com/)
