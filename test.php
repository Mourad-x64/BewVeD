<!DOCTYPE html>
<html>
    <head>
        <title>Notre première instruction : echo</title>
        <meta charset="utf-8" />
    </head>
    <body>
        <h2>Affichage de texte avec PHP</h2>
        
        <p>            
            <?php 
                
                try
                {
                    // On se connecte à MySQL
                    $mysqlClient = new PDO('mysql:host=localhost;dbname=BewVeD;charset=utf8', 'root', 'root');
                }
                catch(Exception $e)
                {
                    // En cas d'erreur, on affiche un message et on arrête tout
                    die('Erreur : '.$e->getMessage());
                }

                $sqlQuery = 'SELECT GROUP_CONCAT(idstudent) AS idstudent, firstname, lastname, idgender, title, age, GROUP_CONCAT(idskill) AS idskill, GROUP_CONCAT(langage) AS langage 
                FROM `session_users` GROUP BY title, idgender, age, firstname, lastname  ORDER BY age ASC';
                $studentsStatement = $mysqlClient->prepare($sqlQuery);
                $studentsStatement->execute();

                //tableau avec les etudiants d'une promo
                $students = $studentsStatement->fetchAll(PDO::FETCH_ASSOC);              
                

                //transformation des groupes de valeurs en tableaux
                function splitskills($arr) {
                    //fonction de callback pour transformer les groupes de valeures en tableaux
                    $fn = function ($val){
                        if (strpos($val, ',')){
                            return explode(',',$val);
                        }else {
                            return $val;
                        }
                    };
                    
                    $testarray = array();

                    foreach ($arr as $key => $value) {
                        foreach ($value as $ke => $va) {
                            
                            $testarray[$key] = array_map($fn, $value);               
                            
                        }                    
                    }

                    return $testarray;
                }
                
                
                //trie les eleves par age
                function sortbyage($arr) {
                    
                    $sortedarray = array();
                    foreach ($arr as $key => $value) {
                        if(count($arr)-1 >= 0) {
                            array_push($sortedarray, array_pop($arr));                    
                            array_push($sortedarray, array_shift($arr));
                        }
                    }

                    array_pop($sortedarray);

                    return $sortedarray;
                }

                //sépare les eleves en groupes
                function splitstudents($arr, $nb){
                   //récupère le resultat entier du nombre de groupes 
                   $nbgroups = intdiv(count($arr),$nb);
                   
                   if(count($arr) % $nb > 0){
                       $nbgroups-=1;
                   }                   

                   return array_chunk($arr, $nbgroups);
                }
                
                
                
                $nbstudents = count($students);
                $students = splitskills($students);
                $students = sortbyage($students);
                //$students = splitstudents($students, 3);
          

                echo 'nombre étudiants : '.$nbstudents.'<br/>'; 
                echo '<pre>';
                print_r($students);
                echo '</pre>';
                               
                
                
            ?>
        </p>
    </body>
</html>