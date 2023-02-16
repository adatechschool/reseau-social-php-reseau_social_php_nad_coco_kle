<?
$file_path = "news.php";

// Check if the file exists before attempting to read it
if (file_exists($file_path)) {

    // Use the file_get_contents function to read the contents of the file and store them in a variable
    $file_contents = file_get_contents($file_path);
    $filename = 'news.php';
    $somecontent = "Ajout de chaîne dans le fichier\n";


    // Search for the strings "user_id" and "author" in the file contents
    if (strpos($file_contents, "author_name") !== false) /*|| strpos($file_contents, "author_name") !== false)*/ {
        // If either string is found, print a message indicating that a match was found
        echo "The file contains 'author_name'";
        if (!$fp = fopen($filename, 'a')) {
          echo "Impossible d'ouvrir le fichier ($filename)";
          exit;
        }
    
        // Ecrivons quelque chose dans notre fichier.
        if (fwrite($fp, $somecontent) === FALSE) {
            echo "Impossible d'écrire dans le fichier ($filename)";
            exit;
        }
    
        echo "L'écriture de ($somecontent) dans le fichier ($filename) a réussi";
    
        fclose($fp);
    } else {
        // If neither string is found, print a message indicating that no match was found
        echo "The file does not contain 'author_name'.";
    }

} else {
    // If the file does not exist, print an error message
    echo "Error: The specified file does not exist.";
}
?>