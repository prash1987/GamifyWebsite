<?php
    if(isset($_SESSION['login_user'])) {
        $userLoggedIn = $_SESSION['login_user'];
    }
    else{
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GAMIFY</title>
    
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="sn_styles.css" rel="stylesheet" type="text/css">
    
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">
    <div class="header">
         <div class="container">
            <div class="row">
               
                  <!-- Logo -->
                  <div class="logo">
                     <h1><a href="index.php">GAMIFY</a></h1>
                 </div>

                <div class="search">
            
                <input type="search" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input" onsearch="getLiveSearchUsers('','')" />

                <div class="button_holder">
                    <img src="img/Search/magnifying_glass.png" alt="some image" id="image_button">
                </div>

            <div class="search_results">
            </div>

            <div class="search_results_footer_empty">
            </div>            

        </div>
        <script src="js/search.js"></script>
        <script type="text/javascript">
            function ready(){
                var div = document.getElementById("scroll_messages");
                div.scrollTop = div.scrollHeight;
            }

            function getLiveSearchUsers(value, user){
                $.post("ajax_search.php", {query:value, userLoggedIn:user}, function (data){
                    $(".search_results").html(data);
                });
            }
        </script>

        </div>
                <nav>
                        <a href="homepage.php"><i class="fa fa-home fa-lg" title="Homepage"></i></a> &nbsp;&nbsp;
                        <a href="message.php"><i class="fa fa-comments fa-lg" title="Chat"></i></a> &nbsp;&nbsp;
                        <a href="logout.php"><i class="fa fa-sign-out fa-lg" title="Sign out"></i></a>
                </nav>

            </div>
         </div>        
    </div>


    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/freelancer.min.js"></script>

</body>
</html>