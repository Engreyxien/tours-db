<?php
// Simulate a user registration function
function register_user($username, $email, $password) {
    // Simulate storing user data in a database
    $users = json_decode(file_get_contents('users.json'), true);
    $user_id = uniqid();
    $users[$user_id] = [
        'username' => $username,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];
    file_put_contents('users.json', json_encode($users));
    return $user_id;
}

// Simulate a user login function
function login_user($email, $password) {
    // Simulate checking user credentials from a database
    $users = json_decode(file_get_contents('users.json'), true);
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            return true; // User found and password matches
        }
    }
    return false; // User not found or password does not match
}

// Simulate a user logout function
function logout_user() {
    // Simulate clearing user session
    session_destroy();
}

// Simulate updating user profile
function update_profile($user_id, $data) {
    // Simulate updating user data in a database
    $users = json_decode(file_get_contents('users.json'), true);
    if (isset($users[$user_id])) {
        foreach ($data as $key => $value) {
            $users[$user_id][$key] = $value;
        }
        file_put_contents('users.json', json_encode($users));
        return true; // Profile updated successfully
    }
    return false; // User not found
}
?>
