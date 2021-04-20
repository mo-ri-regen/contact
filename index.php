<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';


//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

  session_start();    //セッション開始
  if($_POST['email'] === ''){
    //error
    $error['email'] = 'blank';
  }

  if($_POST['detail'] === ''){
    //error
    $error['detail'] = 'blank';
  }
  $_SESSION['join'] = $_POST;
  //if(!empty($_POST)){
  if(isset($_POST)){
    //クリックされたとき
    $message = '問い合わせ内容' . "\n" . '詳細' . "\n".  $_POST['detail'];
 //   $message = '問い合わせ内容' ;

    // mb_language("Ja") ;
    // mb_internal_encoding("UTF-8");
      
    // $header = "MIME-Version: 1.0\n";
    // $header .= "Content-Transfer-Encoding: 7bit\n";
    // $header .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
    // $header .= "Message-Id: <" . md5(uniqid(microtime())) . "@gmail.com>\n";
    // $header .= "from:" . $_POST['email'] . "\n";
    // $header .= "Reply-To:" . $_POST['email'] . "\n";
    // $header .= "Return-Path:" . $_POST['email'] . "\n";
    // $header .= "X-Mailer: PHP/". phpversion();
    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'user@example.com';                     //SMTP username
      $mail->Password   = 'secret';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
  
      //Recipients
      $mail->setFrom('from@example.com', 'Mailer');
      $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
      $mail->addAddress('ellen@example.com');               //Name is optional
      $mail->addReplyTo('info@example.com', 'Information');
      $mail->addCC('cc@example.com');
      $mail->addBCC('bcc@example.com');
  
      //Attachments
      $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
  
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Here is the subject';
      $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      $mail->setLanguage('ja', './PHPMailer-master/language/');

      $mail->send();
      echo 'Message has been sent';
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

 
    //mail($_POST['email'],'確認', $message);
  //  mb_send_mail($_POST['email'],'確認', $message,'ヘッダ');
  mb_send_mail($_POST['email'],'確認', $message,$header, "-f". $_POST['email'] ."");
    // /var_dump($_POST['email']);
  }
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
        <form action='' method='POST' enctype='multipart/form-data'>
          <!-- メールアドレス -->
          <div class='email'>
            <label for='email'>メールアドレス</label>
            <input type='email' name='email' id='email' value='<?php print(htmlspecialchars($_POST['email']));?>'>
            <?php
              if($error['email'] === 'blank'):
            ?>
            <p class='error'>メールアドレスを入力してください</p>
            <?php endif; ?>
          </div>

          <!-- 問い合わせ内容 -->
          <div class='contents'>
            <label for='contents'>問い合わせ内容</label>
            <select size='1' name='contents' id='contents'>
              <option value='test1'>test1</option>
              <option value='test2'>test2</option>
              <option value='test3'>test3</option>
            </select>
          </div>

          <!-- 詳細 -->
          <div class='detail'>
            <label for='detail'>詳細</label>
            <textarea id='detail' name='detail' cols='20' rows='4'>
              <?php
                print(htmlspecialchars($_POST['detail']));
              ?>
            </textarea>
            <?php
              if($error['detail'] === 'blank'):
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