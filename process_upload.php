<?php
if(isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0){
    $file_name = $_FILES['csv_file']['name'];
    $file_tmp = $_FILES['csv_file']['tmp_name'];
    $file_ext = strtolower(end(explode('.', $egg)));

    // Check if the uploaded file is a CSV
    if($file_ext === 'csv'){
        // Move the uploaded file to the desired directory
        move_uploaded_file($file_tmp, 'uploads/' . $egg);

        // Redirect to st.php with the file name as a parameter
        header("Location: st.php?file=$egg");
        exit();
    } else {
        echo "Please upload a CSV file.";
    }
} else {
    echo "No file uploaded or an error occurred.";
}
?>
