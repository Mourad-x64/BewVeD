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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Formulaire de répartition</title>
</head>
  <body>
    <h1>Répartition en groupes de travail</h1>
    <form action="" method="get">
        <fieldset>
            <legend>Sélectionnez la session de formation</legend>
            <div>
                <label for="session">Promotion :</label>
                <select name="session" id="session-select">
                        <?php foreach ($sessions as $session) : ?>
                            <option value="<?= $session['id']; ?>"><?= $session['name']; ?></option>
                        <?php endforeach; ?>
                </select>
            </div>
        </fieldset>
        <fieldset>
            <legend>Indiquez le nombre d'apprenants par groupe</legend>
            <div>
                <label for="nbStudents">Nombre :</label>
                <input id="nbStudents" type="number" name="nbStudentsByGroup">
            </div>
        </fieldset>
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
            <div class="skillSelector" id="skill-select" >
            <label for="skill">Compétence :</label>
                <select name="skill" >
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

        $(document).ready(function(){
            $("#criteria-select").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    if(optionValue == "skill"){                        
                        $("#skill-select").show();
                    } else{
                        $("#skill-select").hide();                        
                    }
                });
            }).change();
        });

    </script>
  </body>
</html>