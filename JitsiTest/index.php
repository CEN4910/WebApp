<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <title>Jitsi Test </title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script> 
    <script type="text/javascript" src="libs/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://meet.jit.si/external_api.js"></script>
    <script type="text/javascript" src="userinterface.js"></script>
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
    <section id="makecall">
        <form id="callform" action="getstarted.php" method="post">
            <div>
                <input type="text" id="roomName" value="THISISATEST" name="callName">
                <input type="submit" id="startCall" value="Start Call">
            </div>
        </form>
    </section>
</body>
<footer>
    
</footer>
</html>
