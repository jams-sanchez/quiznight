<?php
session_start();

include_once './models/Quiz.php';

if (isset($_POST['start-quiz'])) {
    $selectIdQuiz = $_POST['start-quiz'];
    $_SESSION['selectIdQuiz'] = $selectIdQuiz;
};

$newQuiz = new Quiz();
$quizUser = $newQuiz->getAllQuizByUser();


var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./asset/css/header-footer.css">
<link rel="stylesheet" href="./asset/css/style_connexion.css">
<link rel="stylesheet" href="./asset/css/style_quiz-jeu.css">
<link rel="stylesheet" href="./asset/css/style_autor-page.css">
<link rel="stylesheet" href="./asset/css/style_index.css">

<title>S-Quiz Game</title>
</head>

<body>
    <header class="header">
        <div class="logo-box">
            <a href="index.php">
                <img src="./asset/img/accueil-logo.png" class="logo-header" />
            </a>
        </div>
        <div class="box-symbol">
            <img class="symbol-header" src="./asset/img/titre-logo.png" />
        </div>

        <?php if (isset($_SESSION['user'])) : ?>
            <form method="post">
                <button class="disconnect_btn login" type="submit" name="deconnexion">Déconnexion</button>
            </form>
            <?php
            if (isset($_POST['deconnexion'])) {
                $_SESSION = array();
                session_destroy();
                header("Location:index.php");
            }
            ?>
        <?php else : ?>
            <div class="login">
                <a href="./page/connexion.php">Connexion</a>
            </div>
        <?php endif ?>

    </header>

    <main class="autor-page">
        <h1 class="titreh1">Clique sur un quiz pour lancer les questions !</h1>
        <section class="quiz">
            <?php foreach ($quizUser as $quiz): ?>
                <article class="quiz-card">
                    <h2 class="quiz-card-title"><?= $quiz['titre'] ?></h2>
                    <div class="quiz-card-img">
                        <img src="./asset/img/sonGoku.jpg" alt="Image du quiz">
                    </div>
                    <p class="quiz-card-description"><?= $quiz['description'] ?></p>
                    <form method="post" action="">
                        <button type="submit" name="start-quiz" id="button" class="button valider button-center" value="<?= $quiz['id'] ?>">Valider</button>
                        <?php if (isset($_POST['start-quiz'])) {
                            header("location:./page/quiz-jeu.php");
                        };
                        ?>
                    </form>
                    <p class="quiz-autor">Créé par : <?= $quiz['pseudo'] ?></p>
                </article>
            <?php endforeach; ?>

        </section>
    </main>

    <?php include './component/footer.php'; ?>