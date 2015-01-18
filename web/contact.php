<?php
$myemail  = 'tom.scheduikat@gmail.com';

$name = check_input($_POST['name']);
$email    = check_input($_POST['email']);
$correctMail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$Kommentar = check_input($_POST['text']);
/* Check all form inputs using check_input function */
if (!$name
    || !$email
    || !$Kommentar
    || !$correctMail
) {
    echo json_encode(array('success' => false,
                            'msg' => 'Angaben Fehlerhaft! Bitte überprüfen Sie Ihre Eingaben!',
                            'mail' => $correctMail,
                            'name' => $name,
                            'text' => $Kommentar
                    ));
    exit();
}

$subject = "Kontaktanfrage ";

$message = "
Eine neue Kontaktanfrage wurde auf www.tomscheduikat.com abgeschickt:


Name: $name
E-mail: $email

Kommentar:
$Kommentar


-----------------------------------------------------------------------------
Bitte nicht auf diese Mail antworten - sie wurde automatisch generiert!
-----------------------------------------------------------------------------
";

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";
$headers .= 'From: tomscheduikat.com Webmailer' . "\r\n";

/* Send the message using mail() function */
mail($myemail, $subject, $message, $headers);

echo json_encode(array('success' => true, 'msg' => 'Erfolgreich abgesendet!'));
exit();
/* Functions we used */
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if (!$data || strlen($data) == 0)
    {
        return false;
    }
    return $data;
}

