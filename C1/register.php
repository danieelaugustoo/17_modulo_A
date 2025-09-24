<?php
if (isset($_POST['submit'])) {
  if (empty($_POST['name']) || empty($_POST['password'])) {
    echo '<p class="m-3">Preencha todos os dados.</p>';
  } else {
    $username = $_POST['name'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $newUser = [
      'name' => $username,
      'password' => $hashedPassword
    ];
    if (file_exists('users.json')) {
      $readFile = file_get_contents('users.json');
      $users = json_decode($readFile, true);
      if (!is_array($users)) {
        $users = [];
      }
    } else {
      $users = [];
    }
    $users[] = $newUser;
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

    header("Location: index.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
</head>

<body>

  <form class="row g-3 m-3" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="col-md-6">
      <label for="inputName4" class="form-label">User Name</label>
      <input type="text" class="form-control" id="inputName4" name="name" />
    </div>
    <div class="col-md-6">
      <label for="inputPassword4" class="form-label">Password</label>
      <input type="password" class="form-control " id="inputPassword4" name="password" />
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary" name="submit">
        Sign in
      </button>
    </div>
  </form>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
  integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
  integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
</script>

</html>