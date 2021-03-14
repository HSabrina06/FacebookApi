<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Facebook Data</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>data facebook</title>
      
        <?php include_once("css.php"); ?>
   
</head>

	<body>
       <!-- Menu  -->
    <?php include ("nav.php"); ?>
    <!-- Le corps -->
    <div id="corps" class="container" >
        <?php
            if (isset($_GET['page'])) {
                $page = htmlspecialchars(addslashes($_GET['page']));
                if ($page ==  'drm') {
                    include_once("DrmPage.php");
                } else if ($page ==  'merter') {
                    include_once("Merter.php");
                } else {
                    echo "<p>ERROR</p>";
                }
            }
        ?>
    </div>

    <?php include_once("js.php") ?>
        
    <script>
        $(document).ready(function(){
            $("#table").DataTable({
                dom: 'Bfrtip',
               buttons: [
                   'csv', 'excel'
              ]
            });
        });
      
 
        function getcomment (id,access) {
        
        $.ajax({
            url:"GetComments.php",   
            type: "post",   
            data: "id=" + id + "&access_token=" + access,
            success:function(result){
                var json = $.parseJSON(result);
                $('#row_comment').empty();
                for (var x = 0; x < json.data.length; x++) {
                console.log(json.data[x].created_time);
                console.log(json.data[x].message);
                var $tr =
                     $('<tr>').append(
                     $('<td>').text(new Date(json.data[x].created_time)),
                     $('<td>').text(json.data[x].message),
                    ).appendTo('#row_comment');
                } 
            }
          });
    }
        
    </script>
</body>

<?php 
    if ($page == 'drm') {
        include_once("modal.php");
    }
?>

</html>
