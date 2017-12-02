<?php
    require 'config.php';
    include("classes/UserClass.php");
    include("classes/PostClass.php");
    include("classes/MessageClass.php");


    if(isset($_SESSION['login_user'])) {
        $userLoggedIn = $_SESSION['login_user'];
        
        $time = time();
        $status_query = mysqli_query($con, "UPDATE user SET status_timestamp = '$time' WHERE User_id = '$userLoggedIn'");

        $user_details_query = mysqli_query($con, "SELECT * FROM user WHERE user_id='$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
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
        <link href="fa-css/css/font-awesome.min.css" rel="stylesheet">
        
        

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
                        <!--The above div is closed through php page so please dont close it-->
                        <!--div class='search_results_footer_empty'>
                        </div-->
                    </div>
                </div>
            </div>
        </div>   
                <nav>
                    <?php 
                        //Unread messages 
                        $message_obj = new MessageClass($con, $userLoggedIn);
                        $num_messages = $message_obj->getUnreadNumber();
                    ?>
                    <a href="<?php echo 'profile.php?profile_username=' .$userLoggedIn;?>" title="Profile">
                        <?php echo $user['first_name']; ?>
                    </a>&nbsp;&nbsp;

                    <a href="homepage.php"><i class="fa fa-home fa-lg" title="Homepage"></i></a>&nbsp;&nbsp;

                    <a href="javascript:void(0);" onclick="getDropdownData('<?php echo  $userLoggedIn; ?>','message')" title="Chat">
                        <i class="fa fa-comments fa-lg" title="Chat"></i><?php 
                        if($num_messages > 0)
                            echo "<span class='notification_badge' id='unread_message'>". $num_messages ."</span>";
                        ?></a>&nbsp;&nbsp;

                    <a href="message.php"><i class="fa fa-envelope fa-lg" title="Messages"></i></a>&nbsp;&nbsp;
                    <a href="groups.php"><i class="fa fa-users fa-lg" title="Groups"></i></a>&nbsp;&nbsp;

                    <a href="logout.php"><i class="fa fa-sign-out fa-lg" title="Sign out"></i></a>
                </nav>

                <div class="dropdown_data_window" style='height:0px; border:none;'>
                    <input type="hidden" id="dropdown_data_type" value="" name="">
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

            function getDropdownData(user, type){ 
                if($(".dropdown_data_window").css("height") == "0px"){
                    var pageName;

                    if(type == 'notification'){

                    }
                    else if(type == 'message'){
                        pageName = "ajax_load_messages.php";
                        $("span").remove("#unread_message");
                    }

                    var ajaxreq = $.ajax({
                        url: "handlers/" +pageName,
                        type: "POST",
                        data: "page=1&userLoggedIn=" + user,
                        cache:false,

                        success: function(response){
                            $(".dropdown_data_window").html(response);
                            $(".dropdown_data_window").css({"padding" : "0px" , "height" : "280px", "border" : "1px solid #DADADA", "z-index" : "10"});
                            $(".dropdown_data_type").val(type);
                        } 
                    });


                }
                else{
                    $(".dropdown_data_window").html("");
                    $(".dropdown_data_window").css({"padding" : "0px" , "height" : "0px" , "border" : "none"});
                }

            }

            // Function for infinite scrolling on message notification bar    
            var userLoggedIn = '<?php echo $userLoggedIn; ?>';

            $(document).ready(function() {

                $('.dropdown_data_window').scroll(function(){
                    var inner_height= $('.dropdown_data_window').innerHeight();
                    var scroll_top = $('.dropdown_data_window').scrollTop();
                    var page = $('.dropdown_data_window').find('.nextPageDropDownData').val();
                    var noMoreData = $('.dropdown_data_window').find('.noMoreDropDownData').val();

                    if((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {


                        var pageName;  // Holds name of page to send ajax request to
                        var type = $('#dropdown_data_type').val();

                        if (type == 'notification')
                            pageName = "ajax_load_notifications.php";
                        else if(type == 'message')
                            pageName = "ajax_load_messages.php";



                        var ajaxReq = $.ajax({
                            url:"handlers/" + pageName,
                            type:"POST",
                            data:"page=" + page + "&userLoggedIn=" + userLoggedIn,
                            cache:false,

                            success:function(response){
                                $('.dropdown_data_window').find('.nextPageDropDownData').remove(); // Removes current .nextpage
                                $('.dropdown_data_window').find('.noMoreDropDownData').remove();
                                $('.dropdown_data_window').append(response);
                            }
                        });
                    }
                }); 
            });
        </script>
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