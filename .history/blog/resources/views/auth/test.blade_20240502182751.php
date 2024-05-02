<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">     <head>         
<meta charset="utf-8">         
<meta name="viewport" content="width=device-width, initial-scale=1">          <title>Laravel</title>          
<!-- Fonts -->         
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">          <style>             
body {                 
font-family: 'Nunito', sans-serif;             
}         
</style>         
<script src="{{ asset('js/app.js') }}" defer>
</script>     
</head>     
<body class="antialiased">             
       
<script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous">
</script> 
        
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
</script>
         
<script>             
$(function(){                 
let socket = io('http://localhost:3000');             
});             
socket.on('connection');         
</script>     
</body> 
</html>