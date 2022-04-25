<?php

use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;

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
							<label for="name" class="col-sm-3 col-form-label">Nama Pelanggan</label>
							<div class="col-sm-9">
								<select class="form-control select2" name="customerKey">
									<?php foreach ($selValCustomer as $selValCustomerKey => $selValCustomerValue) { ?>
										<option value="<?php echo $selValCustomerValue['pkey'] ?>"><?php echo $selValCustomerValue['name'] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">Reward</label>
							<div class="col-sm-9">
								<select class="form-control select2" name="rewardKey">
									<?php foreach ($selValReward as $selValRewardKey => $selValRewardValue) { ?>
										<option value="<?php echo $selValRewardValue['pkey'] ?>"><?php echo $selValRewardValue['title'] . ' - ' . number_format($selValRewardValue['point']) ?></option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="name" class="col-sm-3 col-form-label">Catatan</label>
							<div class="col-sm">
								<textarea class="form-control" name="note" rows="3"></textarea>
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