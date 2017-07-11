<?php
session_start();
include("dbconnection.php");
$country_id=  mysql_real_escape_string($_REQUEST['country_id']);
?>
<div class="row" id="provinces">
                  <div class="col-md-2">
                    <label>Cities *</label>
                  </div>
                  <div class="col-md-8 nopad-right">
                    <select class="form-control" name="city_id"  id="city_id" style="width:97.5%;" onchange="return checkLocation()">
                      <option value="">Select your Cities</option>
                     <?php
                     $cities=  getAllCitiesByCountryId($country_id);
                     if($cities>0)
                     {
                        while($city=  mysql_fetch_array($cities))
                     {
                   ?>
                       <option value="<?php echo $city['city_id']; ?>"><?php echo $city['city_name']; ?></option>
                      <?php
                        }
                      }
                  ?>  
                   <option value="other">Other</option>
                    </select>
                  </div>
                
                 
            </div>
          <div id="other" style="display: none;">
          <div class="row"><div class="col-md-2" >
          <label for="username">Other location *</label>
          </div>
          <div class="col-md-8">
          <input class="form-control" type="text" name="otherlocation" id="otherlocation" value="<?php if(isset($otherlocation)) echo $otherlocation; ?>" autocomplete="off">
          </div> </div>
          </div>  

  
<script type='text/javascript'>
    function checkLocation()
    {
        var city_id=document.getElementById('city_id').value;
        if(city_id=='other')
        {
            document.getElementById('other').style.display="block";
        }
    }
    </script>