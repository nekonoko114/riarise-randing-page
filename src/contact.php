<?php
session_start();
require_once('./common/header.php');
require_once('./varidate.php');
$error = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post = filter_input_array(INPUT_POST, $_POST);

  // フォームの送信時にエラーをチェックする
  if ($post['name'] === '' || 15 < mb_strlen($name)) {
    $error['name'] = 'blank';
  }
  if ($post['furi'] === '' || 15 < mb_strlen($furi)) {
    $error['furi'] = 'blank';
  }

  if (empty($post['tel'])  /*(preg_match('/^0[0-9]{9,10}\z/',$tell))*/) {
    $error['tel'] = 'blank';
  }
  if ($post['email'] === '') {
    $error['email'] = 'blank';
  } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
    $error['email'] = 'email';
  }
  if (300 < mb_strlen($post['message'])) {
    $error['message'] = 'blank';
  }

  if (count($error) === 0) {
    $_SESSION['form'] = $post;
    header('Location:confirm.php');
    exit();
  }
} else {
  if (isset($_SESSION['form'])) {
    $post = $_SESSION['form'];
  }
}
?>
<section class="section__area contact" id="sec10">
  <div class="contact__wrapper inner">
    <h2 class="contact__title section__title">
      お問い合わせ<span>contact</span>
    </h2>
    <form action="" method="post" name="form" novalidate>
      <div class="contact__content">
        <dl class="contact__dl">
          <dt><label for="yourName">お名前</label></dt>
          <dd>
            <input name="name" type="text" id="yourName" placeholder="お名前を入力してください" required>
            <?php if ($error['name'] == 'blank') : ?>
              <div class="">(!) 名前を入力して下さい</div>
            <?php endif; ?>

          </dd>
        </dl>
        <dl class="contact__dl">
          <dt><label for="yourFuli">フリガナ</label></dt>
          <dd>
            <input name="furi" type="text" id="yourFuli" placeholder="フリガナを入力してください" pattern="[\u30A1-\u30F6]*" required />
            <?php if ($error['furi'] === 'blank') : ?>
              <div class="">(!) フリガナを入力してください</div>
            <?php endif; ?>


          </dd>
        </dl>
        <dl class="contact__dl">
          <dt><label for="yourTell">電話番号</label></dt>
          <dd>
            <input name="tel" type="tel" id="yourTell" placeholder="09012455678" pattern="\d{2,4}-?\d{3,4}-?\d{3,4}" required />
            <?php if ($error['tel'] === 'blank') : ?>
              <div class="">(!) 電話番号が入力されていません</div>
            <?php endif; ?>

          </dd>
        </dl>
        <dl class="contact__dl">
          <dt><label for="yourEmail">メールアドレス</label></dt>
          <dd>
            <input name="email" type="email" id="yourEmail" placeholder="aaa@example.com" pattern=".+\.[a-zA-Z0-9][a-zA-Z0-9-]{0,61}[a-zA-Z0-9]" required />
            <?php if ($error['email'] === 'blank') : ?>
              <div class="">(!) 正しいメールアドレスの形式で入力して下さい</div>
            <?php endif; ?>
          </dd>

        </dl>
        <dl class="contact__radio">
          <dt><label for="gender">性別</label></dt>
          <dd>
            <label><input id="gender" type="radio" name="gender" value="男性" checked /><span></span>男性</label>
          </dd>
          <dd>
            <label><input id="" type="radio" name="gender" value="女性" /><span></span>女性</label>
          </dd>
        </dl>
        <dl class="contact__dl">
          <dt>備考欄</dt>
          <textarea name="message" id="message" cols="30" rows="10" placeholder="ご質問等ご記入ください"></textarea>
        </dl>
        <p class="contact__guide"></p>
        <div class="contact__submit">
          <input type="submit" class="btn btn-green" value="送信" />
        </div>
      </div>
    </form>
  </div>
</section>

<?php
require_once('./common/footer.php');
?>