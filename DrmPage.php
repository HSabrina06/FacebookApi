
<!-- Button trigger modal -->
<div class="container">
    <div class="row">
        <form class="form-inline col-md-12" name="form" action="" method="post"> 
            <div class="form-group mr-3"> 
               <lable>IP PAGE :  </label><input class="form-control" type="text" name="page_id" id="page_id" required value="152145558144448">
            </div>
            <div class="form-group mr-3"> 
                <lable>Access Token : </label><input class="form-control" type="text" name="token_acces" id="token_acces" required value="EAAKhSEP5bGYBAE8raAQO6NonZAQuPNn3hZAMyFIjr8YjP4t1sT0Ho1yODqw1oqWYzByOZBHf9y7ZBeEHVsfsKaJnQTryaD8bTqgHkyhXkRwnpoHZC5hGIVaoYhgvMFOm57lHyWEoCv8kanW3DQkaWVHgj2MOAXZAr8UciHhjn45SYwtCOMyokZC"> 
            </div>
            <div class="form-group mr-3"> 
               <input type="submit" name="submit" value="Import DATA FACEBOOK" class="btn btn-primary"/><br/>
            </div>
        </form>
    </div>

<?php
$fb_page = "152145558144448";
$access_token = "EAAKhSEP5bGYBAE8raAQO6NonZAQuPNn3hZAMyFIjr8YjP4t1sT0Ho1yODqw1oqWYzByOZBHf9y7ZBeEHVsfsKaJnQTryaD8bTqgHkyhXkRwnpoHZC5hGIVaoYhgvMFOm57lHyWEoCv8kanW3DQkaWVHgj2MOAXZAr8UciHhjn45SYwtCOMyokZC";
if (isset($_POST['submit']))
{
    $fb_page = $_POST['page_id'];
    $access_token = $_POST['token_acces'];
}
/** Get Profile Picture Page  **/
// $url="https://graph.facebook.com/v9.0/".$fb_page."/picture";
// $url_picture = file_get_contents($url);
/**  Get  Sharing Data From DRM  Facebook PAGE **/
$url="https://graph.facebook.com/".$fb_page."/feed?fields=likes.summary(true)&access_token=".$access_token;
$result=getData($url);
/**  Likes Information */
$i=0;
foreach($result->data as $likes){
    if($i>0){
       $Likes_Count[$likes->id]= $likes->likes->summary->total_count;
    }
    $i=$i+1;
}
/** Get Post  */
$url = "https://graph.facebook.com/" . $fb_page . "/feed?access_token=" . $access_token;
$data_share = getData($url);
$data_array=array();
$array=array();
?>
</div>

<table id="table" class="table table-striped table-bordered" style="width:100%">
<h4> Facebook Posts :</h4>
        <thead>
            <tr>
                <th>Created time</th>
                <th>Message</th>
                <th>Story</th>
                <th>Number of likes</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
      
<?php foreach ($data_share->data as $d){  ?> 
            <tr>
                <td><?php echo  date ('Y-m-d H:i:s',strtotime($d->created_time))  ?>   </td>
                <td><?php echo $d->message; ?>   </td>
                <td><?php echo $d->story; ?> </td>
                <td></span><img src="https://achat-followers.com/wp-content/uploads/2019/05/acheter-fans-facebook.png" width="31" height="25" ></span>
                   <b><?php if($Likes_Count[$d->id]!="")  {echo $Likes_Count[$d->id];} else echo "0";  ?></b>
                 </td>
                <td>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" onclick="getcomment(<?php echo '\''.$d->id.'\',\''.$access_token.'\''; ?>)" data-toggle="modal" data-target="#myModal">Comments</button>
                </td>
            </tr>
            <?php  }  ?>
        </tbody>
        
    </table>
</div>

<?php 

function getData($url){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);  
    curl_close($curl);
    $result = json_decode($result);
    return $result;
}

?>