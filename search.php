<?php
include("config.php");
include("classes/SiteResultsProvider.php");


    if(isset($_GET["term"])){
        $term = $_GET["term"];
    }
    else{
        exit("Moras uneti search term");
    }

    $type = isset($_GET["type"]) ? $_GET["type"] : 'sites' ;
    

?>

<!DOCTYPE html> 

<html lang="en">

<head>

    <link rel="stylesheet" href="assets/css/style.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boogle Search</title>
</head>

<body>
    
<div class="wrapper ">

    <div class="header">
        <div class="headerContent">
            <div class="logoContainer">

                 <a href="index.php"> <img src="assets//images/boogle.png" > </a>
            </div>

            <div class="searchContainer">
                <form action="search.php" method="GET">
                    <div class="searchBarContainer">
                        
                        <input class="searchBox" type="text" name="term">

                        <button class="searchButton">
                            <img src="assets/images/icons/slikaBTN.png" >
                        </button>
                    </div>

                </form>

            </div>

        </div>

        <div class="tabsContainer">
            <ul class="tabList">

                <li class=" <?php  echo $type == 'sites' ? 'active' : '' ;?> " > 
                    <a   href='   <?php echo "search.php?term=$term&type=sites"; ?>   '   >
                        Sites
                    </a>
                </li>

                <li class="<?php echo $type == 'images' ? 'active' : '' ;?> "> 
                    <a   href='   <?php echo "search.php?term=$term&type=images" ;?>  '   >
                        Images
                    </a>
                </li>
                

            </ul>
        </div>





    </div>



    <div class="mainResultsSection">

        <?php
            $resultsProvider = new SiteResultsProvider($con);
            
            $numResults = $resultsProvider->getNumResults($term);

            echo "<p class='resultsCount'>$numResults results found </p>";

            echo $resultsProvider->getResultsHtml(1, 20, $term);
        ?>

    </div>







</div>

</body>


</html>

