<?php
/**
 * Initialize of value
 */
$outputFlug = TRUE;
$jsonUrl = "./yojizyukugos/data.json";

/**
 * get file section ... 取得
 */
if($outputFlug) echo("Get a json file ... ");
if(file_exists($jsonUrl)){
    $json = file_get_contents($jsonUrl);
    if($outputFlug) echo("success! <br/>");
} else {
    exit("[failed!]: file is not exist. <br/>");
}

/**
 * data translation section ... 変更・加工
 */
if($outputFlug) echo("Translation of data ... ");
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$data = json_decode($json,true);
if(isset($data)) { if($outputFlug) echo("decode success! <br/>"); }
else { exit("[failed!]: failed to translation. <br/>"); }

/**
 * Make random number
 */
$sindex = time() % count($data);
$stext = $data[$sindex]["text"];
$sfurigana = $data[$sindex]["furigana"];
$sdescription = $data[$sindex]["description"];

/**
 * make the tweet template section ... テンプレート
 * 
 * ex:
 * 【無我夢中（むがむちゅう）】
 * 無我夢中！ ある事にすっかり心を奪われて、我を忘れてしまうさまのことさ！
 */
$tweettext = "【". $stext ."（". $sfurigana ."）】\n" . $stext . "！ " . $sdescription;

/**
 * oath twitter data section ... Twitter認証
 */
if($outputFlug) echo("Oath of twitter ... ");
require('common.php');
require('twitteroauth/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;
if($outputFlug) echo("success! <br/>");

/**
 * tweet action section ... ツイート実行
 */
if($outputFlug) echo("Tweet action ... ");
$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, OAUTH_TOKEN, OAUTH_TOKEN_SECRET);
$results = $twitter->post("statuses/update", array("status" => $tweettext));
if($outputFlug) echo("success! <br/>");

if($outputFlug){
    echo("ツイート内容： " . $tweettext . "<br/>");
}