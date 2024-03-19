<?php
$xmlFile = 'data.xml';

if(isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $xml = simplexml_load_file($xmlFile);
    $record = $xml->addChild('record');
    $record->addChild('name', $name);
    $record->addChild('age', $age);
    $record->addChild('email', $email);
    $xml->asXML($xmlFile);
    header('Location: index.php');
    exit;
}

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $xml = simplexml_load_file($xmlFile);
    foreach($xml->record as $record) {
        if ((string)$record->name == $name) {
            $record->age = $age;
            $record->email = $email;
            break;
        }
    }
    $xml->asXML($xmlFile);
    header('Location: index.php');
    exit;
}

if(isset($_POST['delete'])) {
    $name = $_POST['name'];

    $xml = simplexml_load_file($xmlFile);
    foreach($xml->record as $key => $record) {
        if ((string)$record->name == $name) {
            unset($xml->record[$key]);
            break;
        }
    }
    $xml->asXML($xmlFile);
    header('Location: index.php');
    exit;
}

if(isset($_POST['search'])) {
    $name = $_POST['name'];
    $xml = simplexml_load_file($xmlFile);
    $result = $xml->xpath("//record[name='$name']");
    if (!empty($result)) {
        foreach ($result as $record) {
            echo "Name: " . $record->name . "<br>";
            echo "Age: " . $record->age . "<br>";
            echo "Email: " . $record->email . "<br>";
        }
    } else {
        echo "Record not found.";
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Form</title>
</head>
<body>
    <h2>Add / Update / Delete / Search Records</h2>
    <form method="post">
        Name: <input type="text" name="name" required><br>
        Age: <input type="number" name="age" ><br>
        Email: <input type="email" name="email" r><br>
        <input type="submit" name="add" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="search" value="Search">
    </form>
</body>
</html>
