<?php
include './header.php';
require './functions/PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['submit'])){
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $id_samochodu = $_POST['id_samochodu'];
    $forma_kontaktu = $_POST['forma_kontaktu'];
    $kontakt = $_POST['kontakt'];

    $mail = new PHPMailer(true);

    try {
        $mail->setFrom('monika@domkiarianna.com.pl', 'Komis');
        $mail->addAddress('lmielewczyk@pjwstk.edu.pl', 'Łukasz');
        $mail->addReplyTo('komis@example.com', 'Komis');


        $mail->isHTML(true);
        $mail->Subject = 'Here is the subject';
        $mail->Body    = '<h1>Witaj!</h1><p>Twoje dane zostały wysłane do naszego komisu.</p>
                        <p>Imię: ' . $imie . '</p>
                        <p>Nazwisko: ' . $nazwisko . '</p>
                        <p>ID samochodu: ' . $id_samochodu . '</p>
                        <p>Preferowana forma kontaktu: ' . $forma_kontaktu . '</p>
                        <p>Kontakt: ' . $kontakt . '</p>';

        if (!$mail->send()) {
            echo 'Błąd mailera: ' . $mail->ErrorInfo;
        } else {
            echo 'Wiadomość wyslana!';
        }
    } catch (Exception $e) {
        echo "Wiadomość nie może zostać wysłana. Błąd mailera: {$mail->ErrorInfo}";
    }
}


?>

    <head>
        <meta charset="UTF-8">
        <title>Kontakt</title>
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
    <div class="container text-center">
        <h1>Kontakt</h1>
        <form method="POST"">
        <label for="imie">Imię:</label>
        <input type="text" name="imie" required><br><br>

        <label for="nazwisko">Nazwisko:</label>
        <input type="text" name="nazwisko" required><br><br>

        <label for="id_samochodu">ID samochodu:</label>
        <input type="text" name="id_samochodu" required><br><br>

        <label>Preferowana forma kontaktu:</label><br>
        <label>
            <input type="radio" name="forma_kontaktu" value="mail" required> Mail
        </label><br>
        <label>
            <input type="radio" name="forma_kontaktu" value="telefon" required> Telefon
        </label><br><br>

        <label for="kontakt">Kontakt:</label>
        <input type="text" name="kontakt" required><br><br>

        <input type="submit" name="submit" value="Wyślij">
        </form></div>

<?php
include './footer.php';
?>
