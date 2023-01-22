<?php
    /**
     * @file list_files.php
     * 
     * This code file includes:
     * - Constant for default value of the files directory
     * - Constant for default value of the files to exclude (current and parent directory references)
     * - list_file(...) function as the main entrypoint for this application
     * - print_files_list(...) function as the recursive function for listing files in nested subdirectories
     * 
     * @author Kenny Carlile
     * @date January 21, 2023
     * @link https://www.kcarlile.com/
     * @link https://github.com/KCarlile
     * @link https://github.com/KCarlile/php-file-listing
     */

    DEFINE("FILES_DIRECTORY", "files");
    DEFINE("FILES_TO_EXCLUDE", array(".", ".."));

    /**
     * Handles checking of incoming parameters and calls print_files_list(...) for recursive listing of files in the provided or default directory.
     * 
     * @param string $files_directory       Directory in which to list files, without a trailing /. Defaults to "files".
     * @param string[] $files_to_exclude    Array of strings of files to exclude from listing. Defaults to [".",".."] to exclude current and parent directory. Any array passed to the function will have the default (".","..") added to it.
     * @param boolean $ordered_list         FALSE for unordered list (<ul>) or TRUE for ordered list (<ol>).
     */
    function list_files($files_directory = FILES_DIRECTORY, $files_to_exclude = FILES_TO_EXCLUDE, $ordered_list = FALSE) {
        // check for valid files directory
        if(!is_dir($files_directory)) {
            echo "[ERROR] " . $files_directory . " is NOT a valid directory.";
        } // end if test
        else {
            // if excluded files are provided, merge with SELF_PARENT_REF
            if($files_to_exclude !== FILES_TO_EXCLUDE) {
                $files_to_exclude = array_merge($files_to_exclude, FILES_TO_EXCLUDE);
            } // end if test

            // if ordered list is not specified, default to unordered list
            if($ordered_list !== TRUE) {
                $ordered_list = FALSE;
            } // end if test

            print_files_list($files_directory, $files_to_exclude, $ordered_list);
        } // end else test
    } // end function list_files function

    /**
     * Recursively prints the files in a provided directory as an HTML list.
     * 
     * @param string $files_directory       Directory in which to list files, without a trailing /.
     * @param string[] $files_to_exclude    Array of strings of files to exclude from listing.
     * @param boolean $ordered_list         FALSE for unordered list (<ul>) or TRUE for ordered list (<ol>).
     */
    function print_files_list($files_directory, $files_to_exclude, $ordered_list) {
        // get the file contents, but avoid excluded files
        $contents = array_diff(scandir($files_directory), $files_to_exclude);

        // determine list type
        $list_type = $ordered_list ? "ol" : "ul";

        // print opening list tag
        echo "\n<" . $list_type . ">\n";

        // loop over the contents in the current directory
        foreach($contents as $item) {
            echo "<li>";

            // check for directory (text) or file (link) to print it correctly
            if(is_dir($files_directory . "/" . $item)) {
                echo $item . "/";
            } // end if test
            else {
                echo "<a href=\"" . $files_directory . "/" . $item . "\">" . $item . "</a>";
            } // end else test

            // if item is a directory, dive on in
            if(is_dir($files_directory . "/" . $item)) {
                // recurse into subdirectory
                print_files_list($files_directory . "/" . $item, $files_to_exclude, $ordered_list);
            } // end if test

            // print closing list tag
            echo "</li>\n";
        } // end foreach loop
        echo "</" . $list_type . ">\n";
    } // end print_files_list function (recursive)
