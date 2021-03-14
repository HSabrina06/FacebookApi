<div class="container-fluid">
<?php
$fb_page      = "1663615883883134";
$access_token = "EAAKhSEP5bGYBAE8raAQO6NonZAQuPNn3hZAMyFIjr8YjP4t1sT0Ho1yODqw1oqWYzByOZBHf9y7ZBeEHVsfsKaJnQTryaD8bTqgHkyhXkRwnpoHZC5hGIVaoYhgvMFOm57lHyWEoCv8kanW3DQkaWVHgj2MOAXZAr8UciHhjn45SYwtCOMyokZC";

$url_picture = "https://graph.facebook.com/" . $fb_page . "/picture?fields=url";
$result_pic = getData($url_picture);

/**  Get  Page Infromation */
$url  = "https://graph.facebook.com/" . $fb_page . "?fields=name,hours,visitor_posts,about,emails,category,category_list,description,location,phone,link,website&access_token=" . $access_token;
$result_info =getData($url);
/**       Count  Page Fans */
$url_fans = "https://graph.facebook.com/" . $fb_page . "/?fields=fan_count&access_token=" . $access_token;
$resultfans =getData($url_fans);
?>
 
  <div class="row">
  <div class="col-md-5">
     <h2> <?php echo $result_info->name; ?><h2>
      </div>
      <div class="col-md-3">
  <button type="button" class="btn btn-primary"><b>  Likes </b><span class="badge"> <?php
echo "<b>".$resultfans->fan_count."</b>";
?>
 <img src="https://achat-followers.com/wp-content/uploads/2019/05/acheter-fans-facebook.png" width="31" height="25" >
 </span></button>
  </div>
  </div>
  <br/>
  <div class="row" >
  <div class="col-md-7">
  <div class="container-fluid">
     <!-- Information Table-->
  <table class="table">
  <tbody>
    <tr class="table-active">
      <th scope="row"> Email   </th>
      <td colspan="2" class="table-active"><?php echo $result_info->emails[0];?></td>
    </tr>
    <tr>
      <th scope="row">Phone </th>
      <td colspan="2" class="table-active"><?php echo $result_info->phone;?></td>
    </tr>
    <tr>
      <th scope="row">WebSite </th>
      <td colspan="2" class="table-active"><?php echo $result_info->website;?></td>
    </tr>
    <tr>
      <th scope="row">Country  </th>
      <td colspan="2" class="table-active"><?php echo $result_info->location->country;?></td>
    </tr>
    <th scope="row">City  </th>
      <td colspan="2" class="table-active"><?php echo  $result_info->location->city;?></td>
    </tr>
    <th scope="row">Street  </th>
      <td colspan="2" class="table-active"><?php echo $result_info->location->street;?></td>
    </tr>
    <tr>
      <th scope="row">Category </th>
      <td colspan="2" class="table-active"><?php  foreach($result_info->category_list as $c){
                                               echo $c->name ."<br />";}
                                               ?></td>
    </tr>
    <tr>
      <th scope="row">About </th>
      <td colspan="2" class="table-active"><?php echo $result_info->about; ?></td>
    </tr>

    <tr>
      <th scope="row">Description </th>
      <td colspan="2" class="table-active"><?php echo $result_info->description;?></td>
    </tr>
  </tbody>
</table>
</div>
</div>
<div class="col-md-3 pull-right">
<h3> <span class="glyphicon glyphicon-time">  Hours</span> </h3>
     <!-- Hours-->
<table class="table">
  <thead class="table-dark">
  <th>Day </th><th> Open </th><th> Close </th>
  </thead>
  <tbody>
  <tr>
  <td>Monday</td>
  <td><?php echo $result_info->hours->mon_1_open;?></td>
  <td><?php echo $result_info->hours->mon_1_close;?></td>
  </tr>
  <tr>
  <td>Tuesday</td>
  <td><?php echo $result_info->hours->tue_1_open;?></td>
  <td><?php echo $result_info->hours->tue_1_close;?></td>
  </tr>
  <tr>
  <td>Wednesday</td>
  <td><?php echo $result_info->hours->wen_1_open;?></td>
  <td><?php echo $result_info->hours->wen_1_close;?></td>
  </tr>
  <tr>
  <td>Thursday</td>
  <td><?php echo $result_info->hours->thu_1_open;?></td>
  <td><?php echo $result_info->hours->thu_1_close;?></td>
  </tr>
  <tr>
  <td>Friday</td>
  <td><?php echo $result_info->hours->fri_1_open;?></td>
  <td><?php echo $result_info->hours->fri_1_close;?></td>
  </tr>
  <tr>
  <td>Saturday</td>
  <td><?php echo $result_info->hours->sat_1_open;?></td>
  <td><?php echo $result_info->hours->sat_1_close;?></td>
  </tr>

  </tbody>
</table>
</div>
 </div>
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