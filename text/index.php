
<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Trooce.PW - Home</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <link href="http://fonts.googleapis.com/css?family=Roboto:300,100" rel="stylesheet">
        <link href="css/social-font.css" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/shader.css" rel="stylesheet">

        <link href="css/demo.css" rel="stylesheet">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<script>
		
		var showText = function (target, message, index, interval) {   
		  if (index < message.length) {
			$(target).append(message[index++]);
			setTimeout(function () { showText(target, message, index, interval); }, interval);
		  }
		}
		
		function randomString(length, chars) {
			var result = '';
			for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
			return result;
		}
		
		function randomstringcool() {
		
			$("#random").text(randomString(1, '!,abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'));
		
			setTimeout(function() {
				randomstringcool();
			}, 100);

		}
		
		$(document).ready(function() {
			randomstringcool();
			showText("#msg", "Hello, my name is Gabe, I legit do online courses!", 0, 150);   
			setTimeout(function() {
				$("#random").hide();
			}, 5000);
		});
		
		</script>
		
    </head>

    <body class="theme-fire">

        <div id="background-container" class="background-container">
            <div id="background-output" class="background-output"></div>
            <div id="vignette" class="background-vignette"></div>
            <div id="noise" class="background-noise"></div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <h1 class="header col-sm-8 col-sm-offset-2"><span id="msg"></span><span id="random"></span></h1>
                </div>
            </div>

        </div>

        <script src="js/placeholders.min.js"></script>
        <script src="js/flat-surface-shader.js"></script>
        <script src="config/main.config.js"></script>
        <script src="js/shader.js"></script>
        <script src="js/demo.js"></script>
    </body>

</html>