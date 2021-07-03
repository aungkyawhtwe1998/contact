<?php

function runQuery($sql){
    $con = conn();
    if(mysqli_query($con, $sql)){
        return true;
    }else{
        die("db error". mysqli_error($con));
    }
}

function linkTo($l){
    echo "<script> location.href = '$l'</script>";
}

function fetch($sql){
    $query = mysqli_query(conn(), $sql);
    $rows = mysqli_fetch_assoc($query);
    return $rows;
}

function fetchALL($sql){
    $con = conn();
    $query = mysqli_query($con, $sql);
    $rows = [];
    while($row = mysqli_fetch_assoc($query)){
        array_push($rows, $row);
    }
    return $rows;
}
function setError($inputName, $message){
    $_SESSION['error'][$inputName] = $message;
}

function getError($inputName){
    if(isset($_SESSION['error'][$inputName])){
        return $_SESSION['error'][$inputName];

    }else{
        return  "";
    }
}
function old($inputName){
    if(isset($_POST[$inputName])){
        return $_POST[$inputName];
    }else{
        return "";
    }
}

function clearError(){
    $_SESSION['error'] = [];
}



function textFilter($text){
    $text = trim($text);
    $text = htmlentities($text, ENT_QUOTES);
    $text = stripcslashes($text);
    return $text;
}


function addContact()
{
    $errorStatus = 0;
    $name = "";
    $email = "";
    $phone = "";
    $profile = "";
    $supportFileType = ['image/jpeg', 'image/png'];
    if (empty($_POST['name'])) {
        setError('name', 'Name is required');
        $errorStatus = 1;
    } else {
        if (strlen($_POST['name']) < 5) {
            setError('name', 'Name is too short');
            $errorStatus = 1;

        } else {
            if (strlen($_POST['name']) > 20) {
                setError('name', 'Name is too long');
                $errorStatus = 1;
            } else {
                $name = textFilter($_POST['name']);
            }
        }
    }


    if (empty($_POST['email'])) {
        setError('email', 'email is required');
        $errorStatus = 1;
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            setError('email', 'email format incorrect');
            $errorStatus = 1;
        } else {
            $email = textFilter($_POST['email']);
        }
    }

    if (empty($_POST['phone'])) {
        setError('phone', 'phone is required');
        $errorStatus = 1;
    } else {
        if (!preg_match("/^[0-9 ]*$/", $_POST['phone'])) {
            setError('phone', 'phone format is incorrect');
            $errorStatus = 1;
        } else {
            $phone = textFilter($_POST['phone']);
        }
    }

    if ($_FILES['profile']['name']) {
        $saveFolder = "store/";
        $tempFile = $_FILES['profile']['tmp_name'];
        $fileName = $_FILES['profile']['name'];
        $saveFolder = "store/";
        if (!in_array($_FILES['profile']['type'], $supportFileType)) {
            setError('profile', 'file not supported');
            $errorStatus = 1;
        }else {
            $profile =  $saveFolder.uniqid() . "_" . $fileName;
            move_uploaded_file($tempFile, $profile);
        }
    }
    else {
        setError('profile', 'file not found');
        $errorStatus = 1;
    }
    if (!$errorStatus) {
        $sql = "INSERT INTO contacts(name,email,phone,profile) VALUES ('$name','$email','$phone','$profile')";
        runQuery($sql);
        $name = "";
        $email = "";
        $phone = "";
        $profile = "";
    }

}

function getContacts(){
    $sql = "SELECT * FROM contacts";
    return fetchALL($sql);
}

function getContact($id){
    $sql = "SELECT * FROM contacts WHERE id = $id";
    return fetch($sql);
}

function contactDelete($id){
    $sql = "DELETE FROM contacts WHERE id = $id";
    return (runQuery($sql));
}

function updateContact(){
    {
        $errorUpdate = 0;
        $name = "";
        $email = "";
        $phone = "";
        $profile = "";
        $id = $_POST['id'];
        $suppotFile = ['image/jpeg', 'image/png'];
        if (empty($_POST['name'])) {
            setError('name', 'Name is required');
            $errorUpdate = 1;
        } else {
            if (strlen($_POST['name']) < 5) {
                setError('name', 'Name is too short');
                $errorUpdate = 1;

            } else {
                if (strlen($_POST['name']) > 20) {
                    setError('name', 'Name is too long');
                    $errorUpdate = 1;
                } else {
                    $name = textFilter($_POST['name']);
                }
            }
        }


        if (empty($_POST['email'])) {
            setError('email', 'email is required');
            $errorUpdate = 1;
        } else {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                setError('email', 'email format incorrect');
                $errorUpdate = 1;
            } else {
                $email = textFilter($_POST['email']);
            }
        }

        if (empty($_POST['phone'])) {
            setError('phone', 'phone is required');
            $errorUpdate = 1;
        } else {
            if (!preg_match("/^[0-9 ]*$/", $_POST['phone'])) {
                setError('phone', 'phone format is incorrect');
                $errorUpdate = 1;
            } else {
                $phone = textFilter($_POST['phone']);
            }
        }

        if ($_FILES['profile']['name']) {
            $saveFolder = "store/";
            $tempFile = $_FILES['profile']['tmp_name'];
            $fileName = $_FILES['profile']['name'];
            $saveFolder = "store/";
            if (!in_array($_FILES['profile']['type'], $suppotFile)) {
                setError('profile', 'file not supported');
                $errorUpdate = 1;
            } else {
                $profile = $saveFolder . uniqid() . "_" . $fileName;
                move_uploaded_file($tempFile, $profile);
            }
        } else {
            setError('profile', 'file not found');
            $errorUpdate = 1;
        }
        if (!$errorUpdate) {
            $sql = "UPDATE contacts SET name = '$name', email='$email', phone = '$phone',profile = '$profile' WHERE id = $id";
            return runQuery($sql);
            $name = "";
            $email = "";
            $phone = "";
            $profile = "";
        }
    }
}