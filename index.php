<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/631fc7d278.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type =text/css href="index.css">
    <title>Weather-App</title>
</head>
<body>
    <div class="container">
    <div class ="main_container">
<div class = "nav_bar">
<form method="GET">
      <input type="search" name="city" class="wsearch" placeholder="your city" value="<?php echo isset($_GET['city']) ? htmlspecialchars($_GET['city']) : ''; ?>">
      <input type="submit" value="Search"><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
    </form>

    </div>
 
    <div class="main_temp">
        <?php
          if (isset($_GET['city']) && !empty($_GET['city'])) {
            $city = urlencode($_GET['city']); // Replace with the desired city name
          
        
        $api_key = "4880711b674eedaf52026431962e92fd";
        $url = "http://api.openweathermap.org/data/2.5/forecast?q=$city&appid=4880711b674eedaf52026431962e92fd&units=metric  ";

        $contents = file_get_contents($url);

            $clima = json_decode($contents);

        
            if ($clima !== null) {
                if (isset($clima->list) && is_array($clima->list)) {
                
                $first_entry = $clima->list[0];
                $theCity = $clima->city->name;
                $main_date=$first_entry->dt_txt;
                $main_temp=$first_entry->main->temp;
                $main_min_temp=$first_entry->main->temp_min;
                $main_max_temp=$first_entry->main->temp_max;
                $main_weather_description = $first_entry->weather[0]->description;
                $icon =$first_entry->weather[0]->icon;

            }
            $image_url="https://openweathermap.org/img/wn/$icon@2x.png";

            echo "<div class='weather_card1'>";
            echo'<h1>Weather in - '.$theCity.'<br></h1>';               
            echo $main_date . "<br>";
           
            echo "<p>Temperature: $main_temp &deg C</p>";
            echo 'Min Temperature:'. $main_min_temp.' &deg;C <i class="fa-solid fa-temperature-low : " style="color: #75a8ff;"></i><br>';
            echo 'Max Temperature:'. $main_max_temp.' &deg;C <i class="fa-solid fa-temperature-high : " style="color: #ff0000;"></i><br>';

            echo "<p>Weather Condition: $main_weather_description</p>"; 
            
            echo  "<img class =here src=".$image_url.">";
            echo "</div>";
   
        }
  
        }
        if (empty($_GET['city'])){
            echo '<div class="alert">';

            echo " <div class ='content'> Please enter a city name <i class='fa-solid fa-city' style='color: #FFFFFF;'></i></div>
            ";
            echo'</div>';
          }?>
   


     </div>
    </div>
<div class='Forcast'>
    <p><h2> Weather Forcast </h2></p>  
    <br>
    </div>
<div class="sub_temp">
<?php
/////////////loop

if (isset($_GET['city']) && !empty($_GET['city'])) {
  
                if ($clima !== null) {
                    if (isset($clima->list) && is_array($clima->list)) {
                        // Looping through
                        foreach ($clima->list as $entry) {
                            // storing needed data
                            $datetime = $entry->dt_txt;
                            $temperature = $entry->main->temp;
                            $temp_min = $entry->main->temp_min;
                            $temp_max = $entry->main->temp_max;
                            $weather_description = $entry->weather[0]->description;
                            $icon_sub=$entry->weather[0]->icon;

                            $image2_url="https://openweathermap.org/img/wn/$icon_sub@2x.png";
                            // Displaying the forecast information for the given city for the next 5 days and every 3 hours
                            echo "<div class='weather_card'>";
                           
                            echo "<p><u>At  $datetime </u></p>";
                            echo "<p>Temperature: $temperature &deg C</p>";
                            echo "<p>Possibility: $weather_description</p>"; 
                            echo  "<img class =here src=".$image2_url.">";
                            echo "</div>";
                           
                         
                            
                        }
                       
                    } else {
                        echo "Error: array not accessible";
                    }
                } else {
                    echo "Error: Failed to decode // the API response is empty.";
                }
                
            }
                if(empty($_GET['city'])){
                    echo "";
            }




?>
</div>

    </div>
</body>
</html>
