<?php
session_start();

if (isset($_POST['submit'])) {
    if (empty($_POST['name']) || empty($_POST['password'])) {
        echo "<p>Preencha todos os dados.</p>";
    } else {
        if (file_exists('users.json')) {
            $jsonContent = file_get_contents('users.json');
            $users = json_decode($jsonContent, true);
        } else {
            $users = [];
        }

        $userFound = false;
        foreach ($users as $user) {
            if ($_POST['name'] === $user['name']) {
                if (password_verify($_POST['password'], $user['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $user['name'];

                    header("Location: index.php");
                    exit;
                }
            }
        }
        if (!$userFound) {
            echo '<p>Usuário ou senha inválidos</p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <input type="password" class="form-control" id="inputPassword4" name="password" />
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary" name="submit">
                Login
            </button>
        </div>

    </form>
    <p><a href="register.php"
            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover m-4">Cadastre-se</a>
    </p>

</body>

</html>