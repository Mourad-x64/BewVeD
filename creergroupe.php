<?php
//Connexion à la base MySQL via PDO
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);

//Récupération de la promotion
$query = "SELECT st.firstname, st.lastname, st.age, s.name as session, g.name as gender
   FROM student as st
   INNER JOIN session as s ON s.id=st.session_id
   INNER JOIN gender as g ON g.id=st.gender_id
   ORDER BY gender ASC";
$statement = $pdo->query($query);
$studentList = $statement->fetchAll(PDO::FETCH_ASSOC);

$nbStudentsByGroup = 3;

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

// var_dump($distribution); die;

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
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="index.php"><img src="images/logo.png" alt="#" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item">
                                 <a class="nav-link" href="creergroupe.php">Créer groupes</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="index.php">Ajouter Apprenant</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="#">Contact</a>
                              </li>
                           </ul>
                           
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
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
      <footer>
         <div class="footer">
            
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <p>Copyright 2022 All Right Reserved By <a href="https://html.design/"> Mourad, Julien, Abdoul</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>
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
   </body>
</html>

