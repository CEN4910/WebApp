<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <section id="callmade">
            <div id="meet">
                <?php 
                    require_once('DB-info.php');//connect to DB.

                    if (isset($_POST['callName'])) {
                        $callName = $_POST['callName'];
                        $query = "INSERT INTO rooms (RoomName, URL) VALUES ( '$callName', 'https://meet.jitsi.si/$callName')";
                        $upResult = @mysqli_query($dbc, $query);
                        if (mysqli_affected_rows($dbc) == 1) {
                           echo "Update Sucessful!";
                        }
                    }
                    if (!isset($_POST['callName'])) {
                        $query = "SELECT RoomName FROM rooms ORDER BY ID DESC LIMIT 1";
                        $r = @mysqli_query($dbc, $query);
                       while( $row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
                            $callName = $row['RoomName'];
                       }
                    }
                ?>
                <script type="text/javascript">
                    $( document ).ready(function() {
                        var domain = "meet.jit.si";
                        var callName = "<?php echo $callName; ?>";
                        var options = {
                            roomName: callName,
                            width: 1280,
                            height: 720,
                            parentNode: document.querySelector('#meet')
                        }
                        var api = new JitsiMeetExternalAPI(domain,options);
                    });
                </script>
            </div>
            <?php 
                //This code makes a sorting mechanism that allows you to populate a "page" with data
                $display = 10;
                if (isset($_GET['p']) && is_numeric($_GET['p'])) {
                    $pages = $_GET['p'];
                }
                else{
                    $q = "SELECT COUNT(ID) FROM rooms";
                    $r = @mysqli_query($dbc, $q);
                    $row = @mysqli_fetch_array($r, MYSQLI_NUM);
                    $records = $row[0];
                    if ($records > $display) {
                        $pages = ceil($records/$display);
                    }else{
                        $pages = 1;
                    }
                }

                if (isset($_GET['s']) && is_numeric($_GET['s'])) {
                    $start = $_GET['s'];
                }else{
                    $start = 0;
                }

                $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'id';

                switch ($sort) {
                    case 'id':
                        $order_by = 'ID ASC';
                        break;

                    case 'RoomName':
                        $order_by = 'Name ASC';
                        break;

                    case 'URL':
                        $order_by = 'URL';
                        break;
                }
                $query = "SELECT ID AS ID, RoomName AS Room, URL AS URL FROM rooms ORDER BY $order_by LIMIT $start, $display";
                $r = @mysqli_query($dbc, $query);
                //Add links the TH elements to enable sorting.
                echo '<div class="middle">
                            <p>Room Name</p>
                    
                     </div>
                    <div id="container">';

                $bg = '#eeeeee';//Background color
                while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                    $bg = ($bg =='#eeeeee' ? '#fff' : '#eeeeee'); //Switch bg color
                    echo '
                        <div bgcolor ="' . $bg . '" class="room-box">
                            <iframe src="' . $row['URL'] .'" frameborder="0">
                                alternative content for browsers which do not support iframe.
                            </iframe>
                            <p><a href ="' . $row['URL'] .'">' . $row['Room'] . '</a></p>
                        </div>';
                }
                echo '</div>';
                mysqli_free_result($r);
                mysqli_close($dbc);
/*
                if ($pages > 1) {
                    echo "</br><p>";

                    $current_page = ($start/$display) + 1;

                    if ($current_page != 1) {
                        echo '<a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>getstarted?s=' . ($start - $display) . '&p=' . $pages . '$sorts=' . $sort . '">Previous</a>';
                    }

                    for($i = 1; $i <= $pages; $i++){
                        if($i != $current_page){
                            echo '<a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>getstarted?s=' . (($display * ($i -1))) . '&p=' . $pages . '$sorts=' . $sort . '">' . $i . '</a>';
                        }else{
                            echo $i . ' ';
                        }
                    }

                    if ($current_page != $pages) {
                        echo '<a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>getstarted?s=' . ($start + $display) . '&p=' . $pages . '$sorts' . $sort  . '">Next</a>';
                    }
                    echo '</p>';
                }
                */
            ?>
        </section> 
</body>
<footer>
    
</footer>
</html>


