<?php
$twitter_username = $settings['widget_twitter_username'];
$tweets_count = $settings['widget_twitter_tweets_count'];
?>
<div class="tabvn_tweet_widget widget_twitter">
  <ul id="twitter_update_list" class="footer-list tweets">
    <li>
    </li>
  </ul>
  <p><a href="http://twitter.com/<?php print $twitter_username; ?>" class="twitter-link"></a></p>
  <script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
  <script type="text/javascript" src="http://api.twitter.com/1/statuses/user_timeline/<?php print $twitter_username; ?>.json?callback=twitterCallback2&count=<?php print $tweets_count; ?>"></script>
  <div class="twitter_bird"></div>
</div>
