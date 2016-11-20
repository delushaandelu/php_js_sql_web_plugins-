<?php
if(isset($_POST['submit']) && !empty($_FILES['file']['name'])){
    if(move_uploaded_file($_FILES['file']['tmp_name'],"uploads/".$_FILES['file']['name'])){
        echo 'File has uploaded successfully.';
    }else{
        echo 'Some problem occurred, please try again.';
    }
}
?>