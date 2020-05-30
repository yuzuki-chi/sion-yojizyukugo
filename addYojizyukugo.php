<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sion YOJI-ZYUKUGO</title>
</head>
<body>
<?php

$jsonUrl = "./yojizyukugos/data.json";
if(file_exists($jsonUrl)){
    $json = file_get_contents($jsonUrl);
} else {
    exit("[failed!]: file is not exist. <br/>");
}
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$data = json_decode($json,true);

if(!empty($_POST)){
    $maxNum = count($data);
    $ptext = $_POST['text'];
    $pfurigana = $_POST['furigana'];
    $pdescription = $_POST['description'];
    $data = array_merge($data, array( $maxNum => array('text'=>$ptext, 'furigana'=>$pfurigana, 'description'=>$pdescription)));
    
	$newJson = json_encode($data, JSON_UNESCAPED_UNICODE );

    $fileName = "./yojizyukugos/data.json." . date('Y-m-d-His') . ".backup";
    file_put_contents($fileName, $json);

    $fileName = "./yojizyukugos/data.json";
    file_put_contents($fileName, $newJson);

    echo "<script> alert('JSONを保存しました');  location.href='./showYojizyukugo.php'; </script>";

}
?>

<div align="center">
    <h1>四字熟語を追加する</h1>
    <form action="./addYojizyukugo.php" method="post">
        四字熟語<br/><input type="text" name="text" id="text"><br/><br/>
        ふりがな<br/><input type="text" name="furigana" id="furigana"><br/><br/>
        詳細<br/><input type="text" name="description" id="description" size=100><br/><br/>
        <button type="submit">送信</button>
    </form>
</div>

</body>
</html>