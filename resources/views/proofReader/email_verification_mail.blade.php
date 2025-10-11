<!DOCTYPE html>
<html>
    <head>
        <title>Site Name</title>
    </head>
    <body>
        <h1>{{ $mailData['title'] }}</h1>
        <p>{{ $mailData['message'] }}</p>
        <p><a href="{{$mailData['link']}}">{{$mailData['link']}}</a></p>
        <p>Thank you</p>
    </body>
</html>