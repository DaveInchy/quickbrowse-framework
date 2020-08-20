<?php
  $error = '';
  if($QB->USER->is_logged_in()){
    header('Location: ' . $QUICKBROWSE->DOMAIN . '/dashboard/index');
    exit;
  }else{
    if(isset($_POST['btn_login'])){
      if(isset($_POST['form_email']) && isset($_POST['form_password']) && !empty($_POST['form_email']) && !empty($_POST['form_password'])){
        if($QB->USER->login($_POST['form_email'], $_POST['form_password'])){
          header('Location: ' . $QUICKBROWSE->DOMAIN . '/dashboard/index');
          exit;
        }else{
          $error = $QB->USER->ERROR;
        }
      }else{
        $error = 'Please make sure you filled in all fields.';
      }
    }
  }
?>