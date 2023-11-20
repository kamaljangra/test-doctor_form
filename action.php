<?php
$conn = new mysqli('localhost', 'root', '', 'test');
// if($conn){
//     echo"ok";
// }

if (isset($_POST['docType'])) {
    $FName = $_POST['firstName'];
    $Lname = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phoneNumber'];
    $doc_type = $_POST['docType'];
    $gender = $_POST['gender'];
    $skills = implode(', ', $_POST['skills']);
    $qualifications = implode(', ', $_POST['qualifications']);

    
    if (isset($_FILES["myfile"]) && $_FILES["myfile"]["error"] == 0) {
        // File upload was successful
        $targetDir = "uploads/";
        $timestamp = time();
        $fileExtension = strtolower(pathinfo($_FILES["myfile"]["name"], PATHINFO_EXTENSION));
        $targetFile = $timestamp . '.' . $fileExtension;

        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetDir . $targetFile)) {
            // File was saved successfully
        } else {
            echo "Error: Unable to move uploaded file.";
            die();
        }
    } else {
        echo "Error: File upload failed.";
        die();
    }



    $sql = "INSERT into doc(FName, LName, Email, phone, doctype, gender, skills, qualifications, profile_image) 
    values('$FName', '$Lname', '$email', $phone, '$doc_type', '$gender', '$skills', '$qualifications', '$targetFile')";

    if (mysqli_query($conn, $sql)) {
        echo "Doctor information saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);
}



if (isset($_POST['delete'])) {
    $id = $_POST['docID'];
    $query = "DELETE from doc where id=$id";
    if (mysqli_query($conn, $query)) {
        echo "delete success";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
