<?php
  session_start();//セッション開始
  if($_POST['email'] === ''){
    //error
    $error['email'] = 'blank';
  }

  if($_POST['detail'] === ''){
    //error
    $error['detail'] = 'blank';
  }
  $_SESSION['join'] = $_POST;
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='css/styles.css'>
    <title>問い合わせ</title>
  </head>
  <body>
    <main>
      <div class='contact'>
        <h1>お問い合わせフォーム</h1>
        <form method='POST' action='' enctype='multipart/form-data'>
          <div class='email'>
            <label for='email'>メールアドレス</label>
            <input type='email' name='email' id='email'>
            <?php
              if($error['email'] === 'blank'):
            ?>
            <p class='error'>メールアドレスを入力してください</p>
            <?php endif; ?>
          </div>

          <div class='contents'>
            <label for='contents'>問い合わせ内容</label>
            <select size='1' name='contents' id='contents'>
              <option value='test1'>test1</option>
              <option value='test2'>test2</option>
              <option value='test3'>test3</option>
            </select>
          </div>

          <div class='detail'>
            <label for='detail'>詳細</label>
            <textarea id='detail' name='detail' cols='20' rows='4'>
            </textarea>
            <?php
              if($error['email'] === 'blank'):
            ?>
            <p class='error'>詳細を入力してください</p>
            <?php endif; ?>
          </div>
          <div>
        
            
            
            <button type="submit" name='send'>送信</button>
            
            
          </div>
        </form>
      </div>    
    </main> 
    
  </body>
</html>