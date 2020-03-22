<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8" />
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <title>R0013E Microservices - Metrics requirements 1 Clément</title>
        <meta name="Description" content="R0013E Microservices - Metrics requirements 1 Clément"/>

    </head>

    <body>
        <div class="wrapper">
            <div id="formdiv">
            	<form id="form" method="post">
            		<label id="label">Enter URL : </label>
            		<input type="text" name="url" id="url"></input>
                </form>
            	<input id="submit" type="BUTTON" value="Get Results">
            </div>

            <div>
                <h1 class=titleResults>Results :</h1>
            </div>
            <br>
            <br>
            <div id="validator">
                <h1 class=titlevalidator></h1>
            </div>
            <br>
            <br>
            <div id="links">
                <h1 class=titlelinks></h1>
            </div>
            <br>
            <br>
            <div id="js">
                <h1 class=titlejs></h1>
            </div>
        </div>
        <script type="text/javascript">

           $(function() {
                
                        $("#submit").click(function() {

                            var form = $('#form');
                            var str = form.serialize();
                            $('.titlevalidator').text('1. HTML / CSS Validator - Number of Error : Loading');
                            $('.titlelinks').text('2. Number Broken Links : Loading');
                            $('.titlejs').text('3. Javascript Library used : Loading');
                            $('#formdiv').text('');

                            $.ajax( {
                                type: "POST",
                                url: 'html-css-validator.php',
                                data: str,
                                success: function( response ) {
                                    $('#validator').html( response );
                                },
                                error: function( response ) {
                                    $('#validator').text('Error');
                                }                       
                            } );

                            $.ajax( {
                                type: "POST",
                                url: 'broken-link.php',
                                data: str,
                                success: function( response ) {
                                    $('#links').html( response );
                                },
                                error: function( response ) {
                                    $('#links').text('Error');
                                }                       
                            } );

                           $.ajax( {
                                type: "POST",
                                url: 'js-checker.php',
                                data: str,
                                success: function( response ) {
                                    $('#js').html( response );
                                },
                                error: function( response ) {
                                    $('#js').text('Error');
                                }                       
                            } );
                        });

                    });
        </script>
    </body>
</html>