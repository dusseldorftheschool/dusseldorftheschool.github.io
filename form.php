<?php
if(isset($_POST['Email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $Email_to = "dusseldorftheschool@gmail.com";
    $Email_subject = "New request received.";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Phone']) ||
        !isset($_POST['Message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $Name = $_POST['Name']; // required
    $Email_from = $_POST['Email']; // required
    $Phone = $_POST['Phone']; // not required
    $Message = $_POST['Message']; // required
 
    $error_message = "";
    $Email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($Email_exp,$Email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$Name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($Message) < 2) {
    $error_message .= 'The Message you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $Email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $Email_message .= "First Name: ".clean_string($Name)."\n";
    $Email_message .= "Email: ".clean_string($Email_from)."\n";
    $Email_message .= "Phone: ".clean_string($Phone)."\n";
    $Email_message .= "Message: ".clean_string($Message)."\n";
 
// create Email headers
$headers = 'From: '.$Email_from."\r\n".
'Reply-To: '.$Email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($Email_to, $Email_subject, $Email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
 
}
?>