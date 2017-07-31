<div id="container">
	<h1>My Library</h1>

	<div id="body">

		<?php if (isset($formLibrary) && $formLibrary != null) {
            foreach ($formLibrary as $key => $value) {
                echo ($value);
            }
            echo ('€ '. $totalPrice . ' - Total <br>');
			echo('Total Books: '. $totalBooks);
} ?>

<br><br>
		<form action="<?php echo site_url('welcome');?>" method="post" enctype="multipart/form-data">

			<tr>
				<td width="20%">Select csv</td>
				<td width="80%"><input type="file" name="file" id="file" /></td>
			</tr>

			<tr>
				<td>Submit</td>
				<td><input type="submit" name="submit" /></td>
			</tr>

		</form>

	</div>

</div>
