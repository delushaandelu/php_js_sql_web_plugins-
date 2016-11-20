<?php
//Include and initialize Poll class 
include 'Poll.php';
$poll = new Poll;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<style type="text/css">
#container { text-align: center; margin: 20px; }
h2 { color: #CCC; }
a { text-decoration: none; color: #EC5C93; }

.bar-main-container {
  margin: 10px auto;
  width: 300px;
  height: 55px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  font-family: sans-serif;
  font-weight: normal;
  font-size: 0.8em;
  color: #FFF;
}

.wrap { padding: 8px; }

.bar-percentage {
  float: left;
  background: rgba(0,0,0,0.13);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 9px 0px;
  width: 18%;
  height: 16px;
  margin-top: -15px;
}

.bar-container {
  float: right;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  height: 10px;
  background: rgba(0,0,0,0.13);
  width: 78%;
  margin: 0px 0px;
  overflow: hidden;
}

.bar-main-container .txt{
    padding-top: 5px;
    font-size: 16px;
    font-weight: bold;
}

.bar {
  float: left;
  background: #FFF;
  height: 100%;
  -webkit-border-radius: 10px 0px 0px 10px;
  -moz-border-radius: 10px 0px 0px 10px;
  border-radius: 10px 0px 0px 10px;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
  filter: alpha(opacity=100);
  -moz-opacity: 1;
  -khtml-opacity: 1;
  opacity: 1;
}

/* COLORS */
.azure   { background: #38B1CC; }
.emerald { background: #2CB299; }
.violet  { background: #8E5D9F; }
.yellow  { background: #EFC32F; }
.red     { background: #E44C41; }

.h3 {
    font-size: 18px;
    color: #333;
    text-align: center;
    float: left;
    border-bottom: 2px solid #333;
    width: 100%;
    margin: 0 auto;
    padding-bottom: 10px;
}
</style>
</head>
<body>
<div id="container">
    <?php
      //Get poll result data
      $pollResult = $poll->getResult($_GET['pollID']);
    ?>
    <h3><?php echo $pollResult['poll']; ?></h3>
    <p><b>Total Votes:</b> <?php echo $pollResult['total_votes']; ?></p>
    <?php
    if(!empty($pollResult['options'])){ $i=0;
      //Option bar color class array
      $barColorArr = array('azure','emerald','violet','yellow','red');
      //Generate option bars with votes count
      foreach($pollResult['options'] as $opt=>$vote){
        //Calculate vote percent
        $votePercent = round(($vote/$pollResult['total_votes'])*100);
        $votePercent = !empty($votePercent)?$votePercent.'%':'0%';
        //Define bar color class
        if(!array_key_exists($i, $barColorArr)){
            $i=0;
        }
        $barColor = $barColorArr[$i];
    ?>
    <div class="bar-main-container <?php echo $barColor; ?>">
        <div class="txt"><?php echo $opt; ?></div>
        <div class="wrap">
          <div class="bar-percentage"><?php echo $votePercent; ?></div>
          <div class="bar-container">
            <div class="bar" style="width: <?php echo $votePercent; ?>;"></div>
          </div>
        </div>
    </div>
    <?php $i++; } } ?>
    <a href="index.php">Back To Poll</a>
</div>
</body>
</html>