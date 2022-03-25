

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
      <!-- end header -->
      <!-- banner -->
      <section class="banner_main">
         <div class="container">
         <div class="row d_flex">
            <div class="col-md-6">
               <div class="text-bg">
                  <h1>Ajouter apprenant</h1>
               </div>
            </div>
            <div class="col-md-12">
               <form id="request" class="main_form">
                  <div class="row">
                     <div class="col-md-12 ">
                        <input class="contactus" placeholder="Nom" type="text" name="Nom"> 
                     </div>
                     <div class="col-md-12 ">
                        <input class="contactus" placeholder="Prénom" type="text" name="Prenom"> 
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder=" âge" type="Number" name="age"> 
                     </div>
                     <div class="col-md-12">
                        <label name="Sexe">Sexe</label>
                        <select id="inputState" class="contactus" name="Sexe">
                          <option selected>H</option>
                          <option>F</option>
                        </select>                         
                     </div>
                     <div class="col-md-12">
                        <label name="Promotion">Promotion</label>
                        <select id="inputState" class="contactus" name="Promotion">
                          <option selected>Promotion PHP/Symfony</option>
                          <option>Promotion développeur...</option>
                        </select>
                     </div>
                     <div class="col-md-12">
                        <label name="Competence">Competence</label>
                       <select id="inputState" class="contactus" name="Competence">
                          <option selected>PHP</option>
                          <option value="1">JAVA</option>
                          <option value="2">C++</option>
                          <option value="3">JS</option>
                        </select>
                     </div>
                     

                     <div class="col-sm-12">
                        <button class="send_btn">Envoyer</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </section>
      <!-- end banner -->
      
      
      
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
   </body>
</html>

