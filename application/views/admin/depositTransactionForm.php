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
							<label for="name" class="col-sm-3 col-form-label">Jenis Deposit</label>
							<div class="col-sm-3">
								<input type="hidden" name="depositPoint" value="<?php echo $selValDeposit[0]['point'] ?>">
								<select class="form-control select2" name="depositKey">
									<?php foreach ($selValDeposit as $selValDepositKey => $selValDepositValue) { ?>
										<option value="<?php echo $selValDepositValue['pkey'] ?>"><?php echo $selValDepositValue['name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">X</div>
									</div>
									<input type="number" name="calculate" class="form-control" placeholder="1" value="1" min=1>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-prepend">
										<div class="input-group-text">Point</div>
									</div>
									<input type="text" class="form-control format-number" name="point" disabled value="<?php echo number_format($selValDeposit[0]['point']) ?>">
								</div>
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
<script>
	$(document).ready(function() {
		function formatnumber(number) {
			var number_string = number.toString(),
				sisa = number_string.length % 3,
				rupiah = number_string.substr(0, sisa),
				ribuan = number_string.substr(sisa).match(/\d{3}/g);

			if (ribuan) {
				separator = sisa ? ',' : '';
				rupiah += separator + ribuan.join(',');
				if (number_string.length < 3) {
					return number
				} else {
					return rupiah
				}
			} else {
				return number
			}
		}
		$('[name="calculate"]').change(function() {
			calculate()
		})

		function calculate() {
			var depositPoint = parseInt($('[name="depositPoint"]').val());
			var calculate = parseInt($('[name="calculate"]').val());
			$('[name="point"]').val(formatnumber(depositPoint * calculate));
		}
		$('[name="depositKey"]').change(function() {
			var depositKey = $(this).val()
			$.ajax({
					url: '<?php echo base_url('Admin/ajax') ?>',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'getDeposit',
						pkey: depositKey,
					},
				})
				.done(function(data) {
					data = data[0];
					$('[name="depositPoint"]').val(data.point);
					calculate()
				})
				.fail(function() {
					console.log('error');
				})

		})

	});
</script>