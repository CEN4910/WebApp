<body>
   <form>
        <section id="callmade">
            <div id="meet">
                <?php 
                require_once('DB-info.php');//connect to DB.

                if (isset($_POST['callName'])) {
                    $callName = $_POST['callName'];
                    $query = "INSERT INTO rooms (RoomName, URL) VALUES ( '$callName', 'meet.jitsi.si/$callName')";
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
                            width: 700,
                            height: 700,
                            parentNode: document.querySelector('#meet')
                        }
                        var api = new JitsiMeetExternalAPI(domain,options);
                    });
                </script>
            </div>
            <?php 
                //This code makes a sorting mechanism that allows you to populate a "page" with data. Not yet Implemented
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
                        $order_by = 'RoomName ASC';
                        break;

                    case 'URL':
                        $order_by = 'URL';
                        break;
                }
                $querytwo = "SELECT ID AS ID, RoomName AS Room, URL AS URL FROM rooms ORDER BY $order_by LIMIT $start, $display";
                $r = @mysqli_query($dbc, $querytwo);

                echo '<table>
                        <tr>
                            <th>Room Name</th>
                            <th>URL</th>
                        </tr>';

                $bg = '#eeeeee';//Background color
                while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
                    $bg = ($bg =='#eeeeee' ? '#fff' : '#eeeeee'); //Switch bg color
                    echo '
                        <tr bgcolor ="' . $bg . '">
                            <td>' . $row['ID'] . '</td>
                            <td>' . $row['Room'] . '</td>
                            <td>' . $row['URL'] .'</td>
                        </tr>';
                }
                echo '</table>';
                mysqli_free_result($r);
                mysqli_close($dbc);


                //Page numbers to move through sets of data. Not yet implemented
              /*  if ($pages > 1) {
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
   </form>
</body>