<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sign Up</title>
  <meta name="description" content="Log into the website">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300&family=Montserrat&display=swap" rel="stylesheet">
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>

<body>

  <?php

require_once "functions.php";
$method = $_SERVER['REQUEST_METHOD'];
  if ($method === 'GET') {
    $query = "SELECT * FROM users";
    if (isset($_GET['user_id'])) {
        $query .= " WHERE user_id = :user_id";
        $stmt = $db->ready($query, ['user_id' => $_GET['user_id']]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->fetch();
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $stmt = $db->ready($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $result = $stmt->fetchAll();
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    if ($emailres->num_rows > 0) {
      echo "Email already exists.";
    } elseif ($userres->num_rows > 0) {
      echo "User already exists.";
    } else {
      if ($password === $cpassword) {
        $sql = "INSERT INTO users (username, password, email_address, fullname, country_id) VALUES ( :username, :password, :email_address, :fullname, :country_id)";
        $result = $conn->query($sql);
        $sql = "SELECT user_id FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $id = $row['user_id'];
            $sql = "INSERT into notifications(user_id, notification) VALUES('$id', 'Welcome to TravelLog')";
            $res = $conn->query($sql);
          }
        }
        redirect_to("login.php");
      } else {
        echo "Passwords not matching.";
      }
    }
    $conn->close();
  }
  ?>

  <!-- login form -->
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="signup-form">
    <div class="login-box">
      <h1 id="sutext">Sign Up</h1>
    <div class="textbox">
        <i class="fas fa-at"></i>
        <input type="text" placeholder="Username" name="username" id="username" required>
      <div class="textbox">
        <i class="fas fa-envelope"></i>
        <input type="email" placeholder="Email" name="email" id="email" required>
      </div>
      <div class="textbox">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="Fullname" name="name" id="name" required>
      </div>
      <div class="textbox">
        <i class="fas fa-key"></i>
        <input type="password" placeholder="Password" name="password" id="password" required>
      </div>
      <div class="textbox">
        <i class="fas fa-key"></i>
        <input type="password" placeholder="Confirm Password" name="confirm" id="confirm" required>
      </div>
      <div class="textbox">
  <i class="fas fa-globe"></i>
  <select name="country" id="country" required>
    <option value="Philippines" selected>Philippines</option>
    <script>
  // Fetch countries from country.php
  fetch('country.php')
    .then(response => response.json())
    .then(data => {
      const countrySelect = document.getElementById('country');
      data.forEach(country => {
        const option = document.createElement('option');
        option.value = country.country_name;
        option.textContent = country.country_name;
        countrySelect.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Error fetching countries:', error);
    });

  // Search functionality
  const searchButton = document.getElementById('searchButton');
  searchButton.addEventListener('click', () => {
    const searchTerm = prompt('Enter the country name to search:');
    if (searchTerm) {
      const countrySelect = document.getElementById('country');
      const options = countrySelect.options;
      for (let i = 0; i < options.length; i++) {
        if (options[i].value.toLowerCase().includes(searchTerm.toLowerCase())) {
          countrySelect.value = options[i].value;
          break;
        }
      }
    }
  });
</script>
  </select>
</div>

      <input type="checkbox" name="Agree" value="Yes" required> <span class="Acc">I Agree to the Terms and Conditions.</span>
      <input class="btn" type="submit" value="Sign Up" name="signup">
      <hr>
      <div class="Acc">
        Already have an account?
        <a href="login.php">Login!</a>
      </div>
    </div>
  </form>
</body>

</html>