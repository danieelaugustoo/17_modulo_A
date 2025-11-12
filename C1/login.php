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
        echo "<p>Preencha todos os dados.</p>";
    } else {
        $users = get_all_users();
        $loggedIn = false;
        foreach ($users as $user) {
            if ($_POST['name'] === $user['name']) {
                if (password_verify($_POST['password'], $user['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $user['name'];
                    $loggedIn = true;
                    header("Location: index.php");
                    exit;
                }
            }
        }
        if (!$loggedIn) {
            echo "<p>Usuário ou senha inválidos</p>";
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
                Login
            </button>
        </div>

    </form>
    <p><a href="register.php">Cadastre-se</a>
    </p>

</body>

</html>
<?php
exit;
?>