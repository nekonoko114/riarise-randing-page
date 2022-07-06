<?php 
function validation($data) {
    //空配列を生成
    $error = [];

    if (empty($data['yourName']) || 15 < mb_strlen($data['yourName'])) {
        $error[] = '氏名は15文字以内で入力してください。';
    }

    if( empty($data['yourFuri']) || 15 < mb_strlen($data['yourFuri'])) {
        $error[] = 'フリガナは15文字以内で入力してください';
    }

    if(empty($data['yourTell']) || (!preg_match('/^0[0-9]{9,10}\z/',$data['yourTell']))) {
        $error[] = "電話番号を入力してください";
    } 

    if (empty($data['yourMail']) || !filter_var($data['yourMail'],FILTER_VALIDATE_EMAIL)) {
        $error[] = 'メールアドレスは正しい形式で入力してください';
    }

    if (empty($data['yourGender'])) {
        $error[] = '性別を選択してくダサい';
    }

    if (($data['yourMessage']) || 300 < mb_strlen($data['yourMessage'])) {
        $error[] = 'お問い合わせ内容は、300文字以内で入力してください';
    }

    return $error;
   
}

function escape($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}