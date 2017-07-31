<div id="container">
	<h1>My Library</h1>

	<div id="body">

		<?php if (isset($formLibrary) && $formLibrary != null) {
            foreach ($formLibrary as $key => $value) {
                echo ($value);
            }
            echo ('€ '. $total . ' - Total');
} ?>

<br><br>
		<form action="<?php echo site_url('welcome');?>" method="post" enctype="multipart/form-data">

			<tr>
				<td width="20%">Select file</td>
				<td width="80%"><input type="file" name="file" id="file" /></td>
			</tr>

			<tr>
				<td>Submit</td>
				<td><input type="submit" name="submit" /></td>
			</tr>

		</form>

		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>



	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.
		<?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
