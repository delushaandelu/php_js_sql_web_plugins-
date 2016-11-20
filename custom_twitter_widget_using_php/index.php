<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create custom Twitter Widget using PHP by CodexWorld</title>
<link href='style.css' rel='stylesheet' type='text/css'>
</head>

<body>
<?php
//Path to TwitterOAuth library
require_once("twitteroauth/twitteroauth.php");

//Configuration
$twitterID = (isset($_REQUEST['twitterUsername']) && !empty($_REQUEST['twitterUsername']))?$_REQUEST['twitterUsername']:"codexworldblog";
$tweetNum = 10;
$consumerKey = "InsertConsumerKey";
$consumerSecret = "InsertConsumerSecret";
$accessToken = "InsertAccessToken";
$accessTokenSecret = "InsertAccessTokenSecret"; 
if($twitterID && $consumerKey && $consumerSecret && $accessToken && $accessTokenSecret) {
      //Authentication with twitter
      $twitterConnection = new TwitterOAuth(
          $consumerKey,
          $consumerSecret,
          $accessToken,
          $accessTokenSecret
      );
      //Get user timeline feeds
      $twitterData = $twitterConnection->get(
          'statuses/user_timeline',
          array(
              'screen_name'     => $twitterID,
              'count'           => $tweetNum,
              'exclude_replies' => false
          )
      );

?>
    <div class="tweet-box">
          <h1>Tweets</h1>
          <div class="tweets-widget">            
             <ul class="tweet-list">
                <?php
                if(!empty($twitterData)) {
                    foreach($twitterData as $tweet):
                      $latestTweet = $tweet->text;
                      $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
                      $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a class="tweet-author" href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
                      $tweetTime = date("D M d H:i:s",strtotime($tweet->created_at));
                ?>
                <li class="tweet-wrapper">
                    <div class="tweet-thumb">
                      <span class="had-thumb"><a href="<?php echo $tweet->user->url; ?>" title="<?php echo $tweet->user->name; ?>"><img alt="" src="<?php echo $tweet->user->profile_image_url; ?>"></a></span>
                    </div>
                    <div class="tweet-content">
                        <h3 class="title" title="<?php echo $tweet->text; ?>"><?php echo $latestTweet; ?></h3>
                        <span class="meta"><?php echo $tweetTime; ?> - <span><span class="dsq-postid" rel="8286 http://www.techandall.com/?p=8286"><?php echo $tweet->favorite_count; ?> Favorite</span></span></span>
                    </div>
                </li>
                <?php 
                    endforeach; 
                }else{
                    echo '<li class="tweet-wrapper">Tweets not found for the given username.</li>'; 
                }
                ?>
             </ul>
        </div>
  	</div>
<?php   
}else{
      echo 'Authentication failed, please try again.';
}
?>

</body>
</html>

