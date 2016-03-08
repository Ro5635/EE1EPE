
						<div id="MessagesTable">
							<?php
							//Create the table of messages for authorisation:
								$stmt = $dbc->prepare('SELECT MessageID , MessageText, GivenName  FROM Messages WHERE Authorised = 0 ORDER BY MessageID DESC');
  								$stmt->execute();
  								$DataBaseMessagesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  								// echo '<pre>';
  								// var_dump($DataBaseMessagesData);
  								// echo '</pre>';

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
  										echo '<span class="AuthoriseButton ButtonsBlock" ID="' . $DataBaseLine['MessageID'] . '" >Send</span>';
  										echo '<span class="DeleteButton ButtonsBlock" ID="' . $DataBaseLine['MessageID'] . '">Delete</span>';
  										echo '</span><br><span class="LineSpacer"></span>';
  								}

  								echo '</div>';


							?>
						</div>