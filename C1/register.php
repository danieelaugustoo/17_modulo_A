<?php
session_start();
function get_all_users()
{
  $arquivo = 'users.json';
  if (file_exists($arquivo)) {
    $jsonContent = file_get_contents($arquivo);
    $users = json_decode($jsonContent, true);
    if (is_array($users)) {
      return $users;
    }
  }
  return [];
}
if (isset($_POST['submit'])) {
  if (empty($_POST['name']) || empty($_POST['password'])) {
    echo '<p class="m-3">Preencha todos os dados.</p>';
  } else {
    $username = $_POST['name'];
    $password = $_POST['password'];
    $users = get_all_users();
    $userExists = false;
    foreach ($users as $user) {
      if ($username === $user['name']) {
        echo "<p>O nome desse usuário já está em uso.</p>";
        $userExists = true;
        break;
      }
    }
    if (!$userExists) {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $newUser = [
        'name' => $username,
        'password' => $hashedPassword
      ];
      $users[] = $newUser;
      file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
      header("Location: index.php");
      exit;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro</title>

<body>

  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div>
      <label for="inputName4">User Name</label>
      <input type="text" id="inputName4" name="name" />
    </div>
    <div>
      <label for="inputPassword4">Password</label>
      <input type="password" id="inputPassword4" name="password" />
    </div>
    <div>
      <button type="submit" name="submit">
        Sign in
      </button>
    </div>
  </form>

</body>

</html>