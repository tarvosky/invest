<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("{{ asset('tax/completed/'.$data['filename']) }}");
  /* Full height */
  height: 98%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>
<body style="text-align:center;">


    <img width="800px" height="1060px" style="margin:0;padding-top:20px;"
    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('tax/completed/'.$data['filename']))) }}">

</body>
</html>
