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

// Récupération de la promotion
$query = "SELECT st.firstname, st.lastname, st.age, s.name as session, g.name as gender, GROUP_CONCAT(sk.name) as skill
   FROM student as st
   INNER JOIN session as s ON s.id=st.session_id
   INNER JOIN gender as g ON g.id=st.gender_id
   INNER JOIN has_skill as hs ON st.id=hs.student_id
   INNER JOIN skill as sk ON sk.id=hs.skill_id
   GROUP BY st.firstname, st.lastname, st.age, session, gender
   ORDER BY gender ASC";
$statement = $pdo->query($query);
$studentList = $statement->fetchAll(PDO::FETCH_ASSOC);

$nbStudentsByGroup = 5;

function distribute($studentList, $nbStudentsByGroup) {
   $nbGroups = intdiv( count($studentList), $nbStudentsByGroup );
   if (
      (count($studentList) % $nbStudentsByGroup == ($nbStudentsByGroup - 2)) && (($nbStudentsByGroup - 2) > 1)
      || (count($studentList) % $nbStudentsByGroup == ($nbStudentsByGroup - 1)) && (($nbStudentsByGroup - 2) > 1)
      ) {
      $nbGroups = $nbGroups + 1;
   } //Permet de répartir des cas particuliers comme 25 en groupes de 9  ou 11 en groupes de 4

   //Génération des sous-groupes
   $groupList = [];
   for ($i = 0 ; $i < $nbGroups ; $i++) {
      $groupList[$i] = ["Groupe n° " . ($i + 1)];
   }

   //Répartition des apprenants dans les sous-groupes
   for ($i = 0; $i < count($studentList) ; $i++) {
      $j = $i ;
      while ($j > ($nbGroups - 1)) {
         $j = $j - $nbGroups;
      }
      array_push($groupList[$j],$studentList[$i]);
   }

   return array($groupList, $nbGroups);
}

$distribution = distribute($studentList, $nbStudentsByGroup);

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>BewVeD</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <?php include_once('header.php') ?>
      <!-- end header inner -->
      <!-- end header -->
     
      
      <!-- works -->
      <div class="works">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2><strong class="yellow">Session </strong><?= $studentList[0]['session']; ?> <strong class="yellow"> - Répartion en groupes</strong></h2>
                  </div>
               </div>
            </div>
            <div class="row">
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
            </div>
            <div class="row">
               <?php for ($i = 0 ; $i < $distribution[1] ; $i++) : ?>
                  <div class="col-md-4">
                     <div id="white_bg" class="works_box">
                        <h4><?php echo $i + 1; ?></h4>
                        <p>
                           <?php
                              for ($j = 0 ; $j < (count($distribution[0][$i]) -1 ) ; $j++) {
                                 echo $distribution[0][$i][$j + 1]['firstname'] . " " . $distribution[0][$i][$j + 1]['lastname'] . " " . $distribution[0][$i][$j + 1]['age'] . " " . $distribution[0][$i][$j + 1]['gender'];
                                 echo "</br>";
                             }
                           ?>
                        </p>
                     </div>
                  </div>
               <?php endfor; ?>
            </div>
         </div>
      </div>
      <!-- end works -->
      
      <!--  footer -->
      <?php include_once('footer.php') ?>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
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

