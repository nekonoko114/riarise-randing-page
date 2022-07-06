<!-- 
必須項目を設定する際に利用する
if(empty($password)) {
    引数の値がnullか0かfalseの際にtrueを返します。
    値が入っていなければエラーメッセージ表示されます。
    
}

文字列の長さに制限をかけ際に利用する
if(mb_strlen($password)) {
    文字列の長さに制限をかけ際に利用する
    mb_strlen()引数に渡された文字列の長さを渡す。返り値と上限を比較することで文字列の長さが制限範囲か判断する。
}

Eメールアドレスのバリデートに利用する
if(!filter_var($email,FILRER_VARIDATE_EMAIL)) {
    Eメールアドレスのバリデートに利用する
}

if(!in_array($gender,['female','male'])) {
    入力値を特定のリストの値にのみ制限したいときに利用する。
    in_array()関数
    入力値がリオスとの中に含まれていない赤判定する。
}
カスタム形式
preg_match(正規表現パターン,対象文字列)

郵便番号
if(preg_match("/[0-9]{3}-[0-9]{4}/",$value) === 0 ) {
    郵便番号の書式 000-0000で入力してください;
} -->


<!-- 必須項目を設定する際に利用する
if(empty($password)) {
    引数の値がnullか0かfalseの際にtrueを返します。
    値が入っていなければエラーメッセージ表示されます。
    
}

文字列の長さに制限をかけ際に利用する
if(mb_strlen($password)) {
    文字列の長さに制限をかけ際に利用する
    mb_strlen()引数に渡された文字列の長さを渡す。返り値と上限を比較することで文字列の長さが制限範囲か判断する。
}

Eメールアドレスのバリデートに利用する
if(!filter_var($email,FILRER_VARIDATE_EMAIL)) {
    Eメールアドレスのバリデートに利用する
}

if(!in_array($gender,['female','male'])) {
    入力値を特定のリストの値にのみ制限したいときに利用する。
    in_array()関数
    入力値がリオスとの中に含まれていない赤判定する。
}
カスタム形式
preg_match(正規表現パターン,対象文字列)

郵便番号
if(preg_match("/[0-9]{3}-[0-9]{4}/",$value) === 0 ) {
    郵便番号の書式 000-0000で入力してください; -->
}



<?
function validation($data)
{
    $error = array();
    $check = array();

    //名前のバリデーション
    if (empty($data['yourName'])) {
        $error[] =  "氏名を入力してください";
    } elseif (30 < mb_strlen($data['yourName'])) {
        $error[] = "氏名を入力してください";
    }

    //フリガナのバリデーション
    if (empty($data['yourFuli'])) {
        $error[] =  "フリガナを入力してください";
    } elseif (30 < mb_strlen($data['yourFuli'])) {
        $error[] = "フリガナを入力してください";
    }
    //電話のバリデーション
    if(empty($data['yourTell'])) {
        $error[] = "電話番号を入力してください";
    } elseif(!preg_match('/^0[0-9]{9,10}\z/',$data['yourTell']))

    //メールアドレスのバリデーション
    $check = explode('@',$data['yourEmail']);
    if ( empty ($data['yourEmail'])) {
        $error[] = "メールアドレスを入力してください";
    } elseif(!preg_match('/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/',$data['yourEmail'])) {
        $error[] = "正しいメールアドレスを記入してください";
    } elseif (!(checkdnsrr($check[1],'A')) ) {
        $error[] = '有効なドメイン化確認してください';
    } else {
        $error[] = "正しいメールアドレスを入力してください";
    }

    //性別のバリデーション
    if(empty($data['yourGender'])) {
        $error[] = '性別を選択してください';
    }
    //備考欄のバリデーション
    if (empty($data['yourMessage'])) {
        $error[] = "メッセージが入力してください";
    } elseif(preg_match('/http|https/',$data['yourMessage']))  {
        $error[] =  "メッセージにURLの鉢ルケは禁止しています。";
    } elseif(preg_match('/<(".*?"|\'.*?\'|[^\'"])*?>/',$data['yourMessage'])) {
        $error[] = "メッセージを入力してください";
    } elseif(1600 < mb_strlen($data['yourMessage'])) {
        $error[] = "1600文字以上は記入できません";
    }
    return $error;
    
}




