<?php
require_once('./common/header.php');
require_once('./varidate.php');
?>
<?php
session_start();
// 入力画面からのアクセスでなければ、戻す
if (!isset($_SESSION['form'])) {
    header('Location:contact.php');
    exit();
} else {
    $post = $_SESSION['form'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    mb_language("ja");
    mb_internal_encoding("UTF-8");

    // 件名を変数subjectに格納
    $subject = "［自動送信］メッセージ内容の確認";

    // メール本文を変数bodyに格納
    $body = <<< EOM
  {$post['name']}様
    
  職業紹介にお問い合わせいただいましてありがとうございます。
  以下の内容でメッセージを承りました。

  ===================================================

  < お名前 >
  {$post['name']}

  <フリガナ>
  {$post['furi']}

  <電話番号>
  {$post['tel']}

  < メールアドレス >
  {$post['email']}

  <性別>
  {$post['gender']}

  < メッセージ >
  {$post['message']}

  
  ===================================================

  ※当メールは送信専用となっております。
  ご返信いただいても、お答えいたしかねますのでご了承ください。
  尚、お問い合わせいただきました内容につきましては、担当者より内容を確認させて頂いた後にご連絡させていただきます。
  お問い合わせ内容によりお時間をいただくこともございます。
  予めご了承ください。

    リアライズ株式会社 - 採用担当 - より
  EOM;

    // 送信元のメールアドレスを変数fromEmailに格納(本番環境へのデプロイ時に正規のアドレスに変更すること！)
    $fromEmail = "yoshua0826@gmail.com";

    // 送信元の名前を変数fromNameに格納
    $fromName = "リアライズ株式会社";

    // ヘッダ情報を変数headerに格納する
    $header = "From: " . mb_encode_mimeheader($fromName) . "<{$fromEmail}>";

    // 受信用のメールアドレスを変数myEmailに格納(本番環境へのデプロイ時に正規のアドレスに変更すること！)
    $myEmail = "yoshua0826@gmail.com";

    // フォーム入力者へメールを送信する
    mb_send_mail($email, $subject, $body, $header);

    // サイト管理者へメールを送信する
    mb_send_mail($myEmail, $subject, $body, $header);

    unset($_SESSION['form']);
    header('Location:complete.php');
    exit();
}
?>

<!-- ビュー
================================================================================================ -->
<div class="section__area confirm">
    <div class="section__wrapper ">
        <div class="contact confirm__wrapper">
            <h2 class="section__title confirm__title">入力内容のご確認</h2>
            <p class="confirm__text confirm__text">下記の内容でメッセージを送信します。よろしければ「送信」ボタンを押してください。</p>
            <div class="contact__content">
                <form action="" method="post">
                    <dl class="contact__dl confirm__dl">
                        <dt>お名前</dt>
                        <dd><input type="hidden" id="yourName" name="name" value="<?php echo escape($post['name']); ?>"></dd>
                        <p><?php echo escape($post['name']); ?></p>
                    </dl>
                    <dl class="contact__dl confirm__dl">
                        <dt>フリガナ</dt>
                        <dd><input type="hidden" id="yourFuli" name="furi" value="<?php echo escape($post['furi']); ?>"></dd>
                        <p><?php echo escape($post['furi']); ?></p>
                    </dl>
                    <dl class="contact__dl confirm__dl">
                        <dt>電話番号</dt>
                        <dd><input type="hidden" id="yourTell" name="tel" value="<?php echo escape($post['tel']); ?>"></dd>
                        <p><?php echo escape($post['tel']); ?></p>
                    </dl>
                    <dl class="contact__dl confirm__dl">
                        <dt>メールアドレス</dt>
                        <dd><input type="hidden" id="yourEmail" name="email" value="<?php echo escape($post['email']); ?>"></dd>
                        <p><?php echo escape($post['email']); ?></p>
                    </dl>
                    <dl class="contact__dl confirm__dl">
                        <dt>性別</dt>
                        <dd><input type="hidden" id="yourSex" name="yourGender" value="<?php echo escape($post['gender']); ?>"></dd>
                        <p><?php echo escape($post['gender']); ?></p>gender
                    </dl>
                    <dl class="contact__dl confirm__dl">
                        <dt></dt>
                        <dd><input type="hidden" id="yourMessage" name="message" value="<?php echo escape($post['message']); ?>"></dd>
                        <p><?php echo nl2br(escape($post['message'])); ?></p>
                    </dl>
                    <div class="confirm__back">
                        <input class="confirm__back" type="button" value="修正" onclick="history.back(-1)">
                    </div>
                    <div class="confirm__submit">
                        <input class="confirm__submit" type="submit" value="送信" name="submit"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once('./common/footer.php') ?>