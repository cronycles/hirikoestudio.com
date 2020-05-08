<!DOCTYPE html>
<html>
<head>

</head>

<body>
<h3>Mensaje enviado desde: {{$fromName}}</h3>
<br/>
{{$content}}

<br/>
<br/>
@if($fromTelephone != null && !empty($fromTelephone))
    <h4>Teléfono: {{$fromTelephone}}</h4>
@endif
</body>
</html>
