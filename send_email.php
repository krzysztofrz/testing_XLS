<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     // Pobierz dane z formularza
    $name = trim($_POST['inputName']);
    $company = trim($_POST['inputCompanyName']);
    $email = trim($_POST['inputEmail']);
    $phone = trim($_POST['inputPhone']);
    $consent1 = isset($_POST['checkbox1']) ? 'Tak' : 'Nie';
    $consent2 = isset($_POST['checkbox2']) ? 'Tak' : 'Nie';

     // Sprawdź, czy wymagane pola są wypełnione
    if (empty($name) || empty($company) || empty($email)) {
        echo "Proszę wypełnić wszystkie wymagane pola.";
        exit;
    }

    // Walidacja adresu e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Proszę podać poprawny adres e-mail.";
        exit;
    }

    // Przygotuj treść e-maila
    $to = 'nb@slx.pl';
    $subject = 'Nowy formularz z landing page';
    $message = "Imię i Nazwisko: $name\n";
    $message .= "Firma: $company\n";
    $message .= "Email: $email\n";
    $message .= "Telefon: $phone\n";
    $message .= "Zgoda na kontakt w sprawie zapytania: $consent1\n";
    $message .= "Zgoda na kontakt w przyszłości: $consent2\n";

   // Nagłówki e-maila
    $headers = "From: no-reply@twojadomena.pl\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

   // Wyślij e-mail
    if (mail($to, $subject, $message, $headers)) {
        echo "Dziękujemy za wysłanie formularza.";
    } else {
        echo "Wystąpił błąd podczas wysyłania formularza.";
    }
}
?>

