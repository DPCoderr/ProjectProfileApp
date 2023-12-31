<?php 

// require 'database.php';


if (isset($_POST['submit-btn'])) {

    // SANITIZE PASSWORD?????
    $password = $_POST['password'];
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    $firstName = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
    $biography = filter_input(INPUT_POST, 'biography', FILTER_SANITIZE_SPECIAL_CHARS);
    $dob = $_POST['dob'];

    if (empty($username)) {
        echo "You forgot to fill in your username";
    } else if (empty($email)) {
        echo "You forgot to fill in your email";
    } else if (empty($password)) {
        echo "You forgot to fill in your password";
    } else {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        
        require 'database.php';

        $sqlUser = "INSERT INTO users (username, password, email) 
        VALUES (:username, :password, :email)";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->bindParam(':username', $username);
        $stmtUser->bindParam(':password', $hashPassword);
        $stmtUser->bindParam(':email', $email);
        $stmtUser->execute();

        // $sqlUser = "INSERT INTO users (username, password, email) 
        // VALUES ('$username', '$hashPassword', '$email')";
        // $stmtUser = $conn->prepare($sqlUser);
        // $stmtUser->execute();


        $lastInsertUserId = $conn->lastInsertId();

        // $sqlProfile = "INSERT INTO profiles 
        // (user_id, firstname, lastname, biography, dob) 
        // VALUES ('$lastInsertUserId', '$firstName', '$lastName', '$biography', '$dob')";
        // $stmtProfile = $conn->prepare($sqlProfile);
        // $stmtProfile->execute();

        $sqlProfile = "INSERT INTO profiles 
        (user_id, firstname, lastname, biography, dob) 
        VALUES (:user_id, :firstname, :lastname, :biography, :dob)";
        $stmtProfile = $conn->prepare($sqlProfile);
        $stmtProfile->bindParam(':user_id', $lastInsertUserId);
        $stmtProfile->bindParam(':firstname', $firstName);
        $stmtProfile->bindParam(':lastname', $lastName);
        $stmtProfile->bindParam(':biography', $biography);
        $stmtProfile->bindParam(':dob', $dob);
        $stmtProfile->execute();

        header('Location: /login');
        exit();


    } 
}

// require 'database.php';

// $sql = "SELECT * FROM profiles";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
// $profiles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo "<ul>";
//     foreach ($profiles as $profile) {
//         echo "<li><a href='profiles.php?id=" . $profile['user_id'] . "'>Profile " . $profile['firstname'] . " " . $profile['lastname'] . "</a></li><br>";
//     }
// echo "</ul>";


// $sql = "SELECT * FROM users";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
// $users = $stmt->fetchAll(PDO::FETCH_ASSOC);