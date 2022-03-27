<?php
$action = 'add';
$display = '';
if (isset($_POST['action']))
	$action = $_POST['action'];
if ($action == 'update')
	$display = 'style="display: none;"'
?>
<div class="row justify-content-center">
	<div class="col-lg-10">
		<div class="row">
			<div class="col-lg">
				<div class="p-5">
					<?php echo $err ?>
					<h3 class="text-center"><b><?php echo strtoupper($title) ?></b></h3>
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" name="pkey" value="">
						<input type="hidden" name="action" value="<?php echo $action ?>">

						<div class="form-group row">
							<label for="title" class="col-sm-3 col-form-label">Title</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="title" name="title" placeholder="Title">
							</div>
						</div>

						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">Nama Reward</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="name" name="name" placeholder="Nama Reward">
							</div>
						</div>

						<div class="form-group row">
							<label for="point" class="col-sm-3 col-form-label">Jumlah Point</label>
							<div class="col-sm">
								<input type="text" class="form-control format-number" id="point" name="point" placeholder="Jumlah Point">
							</div>
						</div>

						<div class="form-group row">
							<label for="img" class="col-sm-3 ">Gambar Reward</label>
							<div class="col-sm">
								<input type="file" class="form-control-file" id="img" name="img">
							</div>
						</div>


						<div class="form-group row mt-5">
							<div class="col-sm">
								<button type="submit" class="btn btn-primary btn-block">Submit</button>
							</div>
							<div class="col-sm">
								<a href="<?php echo base_url($baseUrl . 'List') ?>" class="btn btn-warning btn-block">Cancel</a>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>