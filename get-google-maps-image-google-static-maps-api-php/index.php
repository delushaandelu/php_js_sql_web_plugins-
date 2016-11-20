<!DOCTYPE html>
<html lang="en">
<head>
<title>Get Google Maps as an Image using Google Static Maps API by CodexWorld</title>
</head>
<body>
    <p>Google Map Image based on Address</p>
    <img src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=12&size=600x400"/>
    <br/>
    <p>Google Map Image based on Latitude & Longitude</p>
    <img src="https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&zoom=12&size=600x400"/>
    <br/>
    <p>Google Map Image with Marker based on Latitude & Longitude</p>
    <img src="https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&markers=color:red%7Clabel:C%7C40.718217,-73.998284&zoom=12&size=600x400"/>
    <br/>
    <p>Save Google Map as an Image using PHP</p>
    <?php
        $src = 'https://maps.googleapis.com/maps/api/staticmap?center=40.714728,-73.998672&markers=color:red%7Clabel:C%7C40.718217,-73.998284&zoom=12&size=600x400';
        $time = time();
        $desFolder = 'images/';
        $imageName = 'google-map_'.$time.'.PNG';
        $imagePath = $desFolder.$imageName;
        file_put_contents($imagePath,file_get_contents($src));
    ?>
    <img src="<?php echo $imagePath; ?>"/>
</body>
</html>