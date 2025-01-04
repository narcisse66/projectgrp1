<!DOCTYPE html>
<html>

<head>
    <title>Confirmer votre compte parent</title>
</head>

<body>
    <p>Bonjour {{ $parent->name }},</p>
    <p>Veuillez confirmer la création de votre compte parent en cliquant sur le lien ci-dessous :</p>
    
    <a href="{{ env('FRONT_URL') .'/activation/'. $token }}">Confirmer mon compte</a>
</body>

</html>