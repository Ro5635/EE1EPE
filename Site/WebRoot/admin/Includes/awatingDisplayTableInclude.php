 <div id="MessagesTable">
     <?php

     echo '<p>Messages Waiting to be displayed on cube:</p>';

		 //Create the table of messages that are waiting to be displayed:

     $stmt = $dbc->prepare('SELECT MessageID , MessageText, GivenName  FROM Messages WHERE Authorised = 1 ORDER BY MessageID ASC');
     $stmt->execute();
     $DataBaseMessagesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

     echo '<div class="MessagesAuthTable">';

     echo '<span class="TableLine">';
     echo '<span class="GivenNameColumn"><h3>Name</h3></span>';
     echo '<span class="MessageTextColumn"><h3>Message</h3></span>';
     echo '</span>';


     //JQuery Slide issue workaround:
     echo '<span class="TableLine">';
     echo '<span class="GivenNameColumn"></span>';
     echo '<span class="MessageTextColumn"></span>';
     echo '<span class="AuthoriseButton ButtonsBlock" ID="" ></span>';
     echo '<span class="DeleteButton ButtonsBlock" ID=""></span>';
     echo '</span><br><span class="LineSpacer"></span>';


     foreach ($DataBaseMessagesData as $key => $DataBaseLine) {
      echo '<span class="TableLine">';
      echo '<span class="GivenNameColumn">' . $DataBaseLine['GivenName'] . '</span>';
      echo '<span class="MessageTextColumn">' . $DataBaseLine['MessageText'] . '</span>';
      echo '<span class="DeleteButtonPendingDisplay ButtonsBlock" ID="' . $DataBaseLine['MessageID'] . '">Delete</span>';
      echo '</span><br><span class="LineSpacer"></span>';
    }

    echo '</div>';


    ?>
  </div>