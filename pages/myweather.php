<?php
session_start();
if (!isset($_SESSION['userid'])) {
    // user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
// user is logged in, get their information from the session
$user_id = $_SESSION['userid'];
// continue with the rest of your code
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="../assets/icons/font-awesome-4.7.0/css/font-awesome.min.css">
    
    <style>
        
.weather-icon {
  margin-bottom: 10px;
}

.weather-icon img {
  max-width: 100px;
  max-height: 100px;
}

.weather-info p {
  margin: 5px;
  font-size: 18px;
}

.weather-info strong {
  font-weight: bold;
}

#current-temperature, #entered-temperature {
    background: #e67e22;
    color: white;
 
}

#current-humidity, #entered-humidity {
  
  background: #3498db;
    color: white;
}

#current-wind, #entered-wind {
  
  background: #27ae60;
    color: white;
}
.button {
  background-color: rgba(225,179,130,1);
  color: black;
  display: inline-block;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
  box-shadow: 0 4px 8px 0 rgb(45,84,94, 0.9);
}
input {
    padding: 1rem;
    border-radius: 25px;
    border: none;
    background-color: #fff;
    font-family: inherit;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    min-width: 300px;
    font-size: 1rem;
}
input:focus {
    outline: none;
}
#city-form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-bottom: 1rem;
  padding: 10px;
}





    </style>
    <title>MyJUB</title>
</head>


<?php include 'frame_top.php'; ?>
<div class="view1">
  <div class="box">
    <h2>This is the Weather at your location!</h2>
    <p><strong>Location:</strong> <span id="current-location"></span></p>
    <div class="weather-icon">
      <img id="current-icon" src="" alt="Weather Icon">
    </div>
    <div class="weather-info">
      <p><strong>Temperature:</strong> <span id="current-temperature"></span></p>
      <p><strong>Humidity:</strong> <span id="current-humidity"></span></p>
      <p><strong>Wind:</strong> <span id="current-wind"></span></p>
    </div>
  </div>
  <div class="box">
  <h2>Enter a city to know what's the weather there!</h2>
  <form id="city-form">
    <label for="location-input">Enter city name:</label><br>
    <input type="text" id="location-input" name="location-input"><br>
    <button type="submit" class="button" id="search-button">Get Weather</button>
  </form>
  </div>
  <div class="box hide">
    <h2>Weather for Entered City</h2>
    <p><strong>Location:</strong> <span id="entered-location"></span></p>
    <div class="weather-icon">
      <img id="entered-icon" src="" alt="Weather Icon">
    </div>
    <div class="weather-info">
      <p><strong>Temperature:</strong> <span id="entered-temperature"></span></p>
      <p><strong>Humidity:</strong> <span id="entered-humidity"></span></p>
      <p><strong>Wind:</strong> <span id="entered-wind"></span></p>
    </div>
  </div>
</div>
<script>
    
  const apiKey = "c7469299c8cdabe5249816cebb33b80e";
  const geocodeApiKey = "47373ba39710416e8856bf7c8bc2d949";
  


  // Set up variables to store location data
  let currentLocation = null;
  let enteredLocation = null;

  // Get the user's current location
  navigator.geolocation.getCurrentPosition(position => {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    // Get the full address using OpenCage Geocoder API
    fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=${geocodeApiKey}&pretty=1&no_annotations=1`)
      .then(response => response.json())
      .then(data => {
        const address = data.results[0].formatted;

        // Display the current location name
        document.getElementById("current-location").textContent = address;

        // Make a request to the OpenWeatherMap API for the current location
        return fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${apiKey}&units=metric`);
      })
      .then(response => response.json())
      .then(data => {
        // Display the temperature, humidity, and wind information for the current location
        document.getElementById("current-temperature").textContent = `${data.main.temp} °C`;
        document.getElementById("current-humidity").textContent = `${data.main.humidity}%`;
        document.getElementById("current-wind").textContent = `${data.wind.speed} m/s`;

        // Display the weather icon for the current location
        const iconCode = data.weather[0].icon;
        const iconUrl = ' http://openweathermap.org/img/w/${iconCode}.png' ;
const iconElement = document.getElementById("current-icon");
iconElement.setAttribute("src", iconUrl);
// Save the current location data
currentLocation = { latitude, longitude };
  })
  .catch(error => console.error(error));
});
// Handle the form submission
const form = document.getElementById("city-form");
form.addEventListener("submit", event => {
  event.preventDefault();

  // Get the value of the input field
  const locationInput = document.getElementById("location-input");
  const location = locationInput.value;

  // Make a request to the OpenWeatherMap API for the entered location
  fetch(`https://api.openweathermap.org/data/2.5/weather?q=${location}&appid=${apiKey}&units=metric`)
    .then(response => response.json())
    .then(data => {
      // Display the location name
      document.getElementById("entered-location").textContent = data.name;

      // Display the temperature, humidity, and wind information for the entered location
      document.getElementById("entered-temperature").textContent = `${data.main.temp} °C`;
      document.getElementById("entered-humidity").textContent = `${data.main.humidity}%`;
      document.getElementById("entered-wind").textContent = `${data.wind.speed} m/s`;

      // Display the weather icon for the entered location
      const iconCode = data.weather[0].icon;
      const iconUrl = `http://openweathermap.org/img/w/${iconCode}.png`;
      const iconElement = document.getElementById("entered-icon");
      iconElement.setAttribute("src", iconUrl);

      // Save the entered location data
      enteredLocation = { latitude: data.coord.lat, longitude: data.coord.lon };

      // Show the box for the entered location weather data
      const enteredBox = document.querySelector(".box.hide");
      enteredBox.classList.remove("hide");
    })
    .catch(error => console.error(error));

  // Reset the input field value
  locationInput.value = "";
});


</script>

<?php include 'frame_down.php'; ?>