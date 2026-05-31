{{-- resources/views/emails/contact-form.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Nouveau message de contact</title>
</head>
<body>
    <h2>Nouveau message de {{ $data['name'] }}</h2>
    <p><strong>Email :</strong> {{ $data['email'] }}</p>
    <p><strong>Sujet :</strong> {{ $data['subject'] }}</p>
    <h3>Message :</h3>
    <p>{{ nl2br(e($data['message'])) }}</p>
</body>
</html>