<tr>
				<td>city </td>
		   <td><div id="drpcity">
				<?php if(isset($_SESSION['cityerror']))
				{
					echo "<font color='red'>please select city</font>";
					unset($_SESSION['cityerror']);
				}
				?></td></tr>