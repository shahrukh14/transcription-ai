<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lendor</title>
</head>

<body>
    <p>First Name : {{ $contactData['name'] }}</p>
    <p>Last Name : {{ $contactData['lname'] }}</p>
    <p>Phone : {{ $contactData['phone'] }}</p>
    <p>E-mail: {{ $contactData['email'] }}</p>
    <p>Message: {{ $contactData['message'] }}</p>
</body>

</html>