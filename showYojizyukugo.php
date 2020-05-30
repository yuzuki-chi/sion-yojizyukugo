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
?>

<div align="center">
    <h1>登録されている四字熟語</h1>
    <table border=1 >
        <tr>
            <td>四字熟語</td>
            <td>ふりがな</td>
            <td>内容</td>
        </tr>
        <?php
        foreach($data as $value): ?>
        <tr>
            <td><?= $value["text"] ?></td>
            <td><?= $value["furigana"] ?></td>
            <td><?= $value["description"] ?></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>

</body>
</html>