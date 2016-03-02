            <span class="FormPartOne">
            	<form method='post' id="registerNewDevice">
            		<p>If you wish to register a new device for use please provide a name for the device that you wish to register:</p>
            		Device Name:
            		<br>
            		<input type='text' name='simpleName'/>
            		<input type = 'hidden' name = "TASK" value = "2"/>
            		<br>
            		<input type="submit" value="Submit">

            	</form>
            </span>
            <span class="FormSecondStage">
            	<p><h2>Success!</h2><br><span id="NewDeviceName"></span> has been succesfuly created.</p>
            	<p>Please copy the bellow device key, this will be needed for the devices configuration in order to allow meaningful communication with the server.</p>
            	<textarea id="DeviceHashValue"></textarea>
            </span>