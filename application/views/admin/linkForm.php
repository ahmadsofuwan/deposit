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
							<label for="name" class="col-sm-3 col-form-label">Nama</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="name" name="name" placeholder="Nama">
							</div>
						</div>

						<div class="form-group row">
							<label for="wa" class="col-sm-3 col-form-label">link WhatsApp</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="wa" name="wa" placeholder="Link WhatsApp">
							</div>
						</div>
						<div class="form-group row">
							<label for="in" class="col-sm-3 col-form-label">link Masuk</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="in" name="in" placeholder="Link Masuk">
							</div>
						</div>
						<div class="form-group row">
							<label for="register" class="col-sm-3 col-form-label">link Daftar</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="register" name="register" placeholder="Link Daftar">
							</div>
						</div>
						<div class="form-group row">
							<label for="claim" class="col-sm-3 col-form-label">link Klaim</label>
							<div class="col-sm">
								<input type="text" class="form-control" id="claim" name="claim" placeholder="Link Klaim">
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