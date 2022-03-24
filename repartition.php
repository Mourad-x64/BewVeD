<?php
//Connexion à la base MySQL via PDO
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

//Récupération de la liste de compétences
$query = "SELECT * FROM skill";
$statement = $pdo->query($query);
$skills = $statement->fetchAll(PDO::FETCH_ASSOC);

//Récupération de la liste des promotions
$query = "SELECT * FROM session";
$statement = $pdo->query($query);
$sessions = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($_GET);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de répartition</title>
</head>
  <body>
    <h1>Répartition en groupes de travail</h1>
    <form action="" method="get">
        <div>
            <label for="session">Promotion :</label>
            <select name="session" id="session-select">
                    <?php foreach ($sessions as $session) : ?>
                        <option value="<?= $session['id']; ?>"><?= $session['name']; ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <!-- <fieldset>
            <legend>Sélectionnez le critère de répartition</legend>
            <div>
                <label for="gender">Genre :</label>
                <input type="checkbox" checked id="gender" name="gender_name">
            </div>
            <div>
                <label for="age">Âge :</label>
                <input type="checkbox" checked id="age" name="age">
            </div>
            <div>
                <label for="skill">Compétence :</label>
                <input type="checkbox" checked id="skill" name="skill_name">
                <select>
                    <?php foreach ($skills as $skill) : ?>
                        <option><?= $skill['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset> -->
        <fieldset>
            <legend>Sélectionnez le critère de répartition</legend>
            <div>
                <label for="criteria">Répartition par :</label>
                <select name="criteria" id="criteria-select">
                    <option value="age">Âge</option>
                    <option value="gender">Genre</option>
                    <option value="skill">Compétence</option>
                </select>
            </div>
            <div class="skillSelector" hidden>
                <label for="skill">Compétence :</label>
                <select name="skill" id="skill-select" disabled>
                    <?php foreach ($skills as $skill) : ?>
                        <option value="<?= $skill['id']; ?>"><?= $skill['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </fieldset>
        <div class="button">
            <button type="submit">Répartir</button>
        </div>
    </form>

    <script>
        const criteriaSelector = document.querySelector('#criteria-select');

        criteriaSelector.addEventListener('change', () => {
            console.log(criteriaSelector.value === 'skill')
            if (criteriaSelector.value === 'skill') {
                document.querySelector('.skillSelector').display("block")
            }
        });
    </script>
  </body>
</html>