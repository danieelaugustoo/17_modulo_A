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
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="col-md-6">
            <label for="inputName4">User Name</label>
            <input type="text" id="inputName4" name="name" />
        </div>
        <div>
            <label for="inputPassword4">Password</label>
            <input type="password" id="inputPassword4" name="password" />
        </div>

        <div>
            <button type="submit" name="submit">
                Login
            </button>
        </div>

    </form>
    <p><a href="register.php">Cadastre-se</a>
    </p>

</body>

</html>