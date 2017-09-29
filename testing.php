<!doctype html>
<html>
   <head>
      <meta charset = "utf-8">
      <title>jQuery UI Autocomplete functionality</title>
      <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      
      <!-- php script -->

      <?php

          $servername = "localhost";
          $username = "root";
          $password = "1234567";
          $dbname = "sys";
          $arr1 = array();
          $arr2 = array();

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT Name FROM Game";
          $result = $conn->query($sql);

          if ($result-> num_rows > 0) {
              
            while($row = $result->fetch_assoc()) {
               $arr1[] = $row["Name"];
              }
          }

          $sql = "SELECT Name FROM Location";
          $result = $conn->query($sql);

          if ($result-> num_rows > 0) {
              
            while($row = $result->fetch_assoc()) {
               $arr2[] = $row["Name"];
              }
          }
          $conn->close();
      ?>

      <!-- Javascript -->
      <script>
         $(function() {
            var jArray1= <?php echo json_encode($arr1 ); ?>;
            var jArray2= <?php echo json_encode($arr2 ); ?>;

            $( "#automplete-1" ).autocomplete({
               source: jArray1
            });

            $( "#automplete-2" ).autocomplete({
               source: jArray2
            });

         });
      </script>
   </head>
   
   <body>
      <!-- HTML --> 
      <div class = "ui-widget">
         <p>Autocomplete Test</p>
         <label for = "automplete-1">Games: </label>
         <input id = "automplete-1">
         <br><br><br>
         <label for = "automplete-2">Locations: </label>
         <input id = "automplete-2">
      </div>
   </body>
</html>