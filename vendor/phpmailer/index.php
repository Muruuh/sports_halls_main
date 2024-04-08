<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require dirname(__file__) . '/'.'/PHPMailer/src/Exception.php';
require dirname(__file__) . '/'.'/PHPMailer/src/PHPMailer.php';
require dirname(__file__) . '/'.'/PHPMailer/src/SMTP.php';
function email_sent_user_fun($to_user,$title_user,$subject_user,$body_user){
$mail = new PHPMailer(true);
  try {
      $mail->SMTPDebug = 2;
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'noreply.developer.server@gmail.com';
      $mail->Password   = 'osvmexifrgajdvfe';
      $mail->SMTPSecure = 'ssl';
      $mail->Port       = 465;
      $mail ->CharSet = "UTF-8";
      $mail->setFrom('noreply.developer.server@gmail.com', $title_user);
      $mail->addAddress($to_user, 'Эрхэм харилцагч таньд');
      $mail->addReplyTo('noreply.developer.server@gmail.com', 'Админ');
      $mail->isHTML(true);
      $mail->Subject = $subject_user;
      $mail->Body    = $body_user;
      $mail->AltBody = '';

      $mail->send();
      return true;

  } catch (Exception $e) {
    return false;
  }
}
function email_sent_user_fun_array($to_user,$title_user,$subject_user,$body_user){
  $mail = new PHPMailer(true);
  try {
      $mail->SMTPDebug = 2;
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'noreply.developer.server@gmail.com';
      $mail->Password   = 'osvmexifrgajdvfe';
      $mail->SMTPSecure = 'ssl';
      $mail->Port       = 465;
      $mail ->CharSet = "UTF-8";
      $mail->setFrom('noreply.developer.server@gmail.com', $title_user);
      foreach ($to_user as &$value_email) {
          $mail->addAddress($value_email, 'Эрхэм харилцагч таньд');
      }
      $mail->addReplyTo('noreply.developer.server@gmail.com', 'Админ');
      $mail->isHTML(true);
      $mail->Subject = $subject_user;
      $mail->Body    = $body_user;
      $mail->AltBody = '';
      $mail->send();
      return true;
  } catch (Exception $e) {
    return false;
  }
}
