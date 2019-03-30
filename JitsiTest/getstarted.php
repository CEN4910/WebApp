<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Jitsi Test </title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script> 
    <script type="text/javascript" src="libs/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://meet.jit.si/external_api.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<header>
    <div class="center-spacebetween">
        <div id="logo">
            <a href="https://www.ucf.edu/"></a>
        </div>
        <div id="search">
            <div id="sign-in-logo">
                
            </div>
            <div id="search-bar">
                <form>
                    <input type="search" name="search">
                    <input type="submit" name="sub-btn">
                </form>
            </div>
        </div>
    </div>
</header>
<body>
   <form>
        <section id="callmade">
            <div id="meet">
                <?php 
                    $callName = $_POST['callName']
                ?>
                <script type="text/javascript">
                    $( document ).ready(function() {
                        var domain = "meet.jit.si";
                        var callName = "<?php echo $callName; ?>"
                        var options = {
                            roomName: callName,
                            width: 700,
                            height: 700,
                            parentNode: document.querySelector('#meet')
                        }
                        var api = new JitsiMeetExternalAPI(domain,options);
                    });
                </script>
            </div>
        </section>
   </form>
</body>
<footer>
    
</footer>
</html>