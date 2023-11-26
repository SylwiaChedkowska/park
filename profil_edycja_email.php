<?php
  include 'polaczenie.php';
  include 'funkcje_pomocnicze.php';

  if (empty($_COOKIE['session_id'])) {
    redirect('logowanie.php', $conn);
  }

  $user = get_first_row($conn, "SELECT user.id, email FROM user JOIN session ON user.id = session.user_id WHERE session.id = $_COOKIE[session_id]");
  $user_id = $user[0];
  $email = $user[1];

  if (isset($_REQUEST['confirm'])) {
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    mysqli_query($conn, "UPDATE user SET email = '$email' WHERE id = $user_id");
    redirect('profil.php', $conn);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="style_profil.css" />
    <link href="polaczenie.php" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Parki</title>
  </head>
  <body>
    <a href="index.php"><img class="logo" src="svg/logo.svg" /></a>
    <?php include 'naglowek.php' ?>
    <div class="srodek">
      <div class="lewy">
        <p>Zmień e-mail</p>
        <form method="post">
          <input type="email" name="email" value="<?= $email ?>" required placeholder="E-mail" />
          <input type="hidden" name="confirm" />
          <input type="submit" id="zaloguj" value="Potwierdź zmianę" />
        </form>
      </div>
    </div>
    <div class="pasek_dolny"></div>
  </body>
</html>

<?php mysqli_close($conn) ?>