<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach ($banner as $bannerKey => $bannerValue) { ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $bannerKey ?>" <?php if (empty($bannerKey)) echo 'class="active"' ?>></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach ($banner as $bannerKey => $bannerValue) { ?>
            <?php
            $status = '';
            if (empty($bannerKey)) $status = 'active' ?>
            <div class="carousel-item text-center <?php echo $status ?>" style="align-items: center;">
                <img class="d-block w-100" src="<?php echo base_url('uploads/' . $bannerValue['img']) ?>">
            </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="container mt-5">
    <?php echo $content['content'] ?>
</div>

<div class="container-fluid">
    <div class="row py-5">
        <?php foreach ($reward as $rewardKey => $rewardValue) { ?>
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src="<?php echo base_url('uploads/' . $rewardValue['img']) ?>" class="img-fluid" style="max-height: 100%;">
                    </div>
                    <div class="col-sm-12 text-center text-dark" style="font-weight: bold;font-size: 1.5em;"><b><?php echo $rewardValue['title'] ?></b></div>
                    <div class="col-sm-12 text-center"><?php echo $rewardValue['name'] ?></div>
                    <div class="col-sm-12 text-center">Point : <?php echo number_format($rewardValue['point']) ?></div>
                    <div class="col-sm-6 text-center"> <a href="<?php echo $link['claim'] ?>" class="btn btn-primary btn-block my-1">Klaim Sekarang</a></div>
                    <div class="col-sm-6 text-center" style="font-size: x-large;"> <a href="<?php echo $link['wa'] ?>" class="btn btn-success btn-block my-1"><i class="fab fa-whatsapp"></i></i> Chat</a></div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#search').click(function() {
        var value = $('#inputSearch').val();
        $.ajax({
                url: '<?php echo base_url('Content/ajax') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'checkAccount',
                    name: value
                },
            })
            .done(function(data) {
                if (data.length == 1) {
                    data = data[0]
                    var element = '<div class="row">';
                    element += '<div class="col-sm-12 py-3">';
                    element += '<img src="<?php echo base_url('uploads/') ?>' + data.levelimg + '" alt="" style="max-height: 100px;">';
                    element += '</div>';
                    element += '<div class="col-sm-12" style="font-size: x-large;">';
                    element += '<b>' + data.name + '</b>';
                    element += '</div>';
                    element += '<div class="col-sm-12 text-primary">';
                    element += 'Point :' + data.point;
                    element += '</div>';
                    element += '</div>';


                    Swal.fire({
                        title: data.levelname,
                        icon: '',
                        html: element,
                        showCloseButton: true,
                        showCancelButton: false,
                        focusConfirm: false,
                        confirmButtonText: 'Ok',
                        confirmButtonAriaLabel: '',
                    })
                }
            })
            .fail(function() {
                Swal.fire('Data Tidak di temukan')
                console.log('error');
            })
    })
</script>