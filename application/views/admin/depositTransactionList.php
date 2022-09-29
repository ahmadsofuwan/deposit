<div class="row">
    <div class="col-sm-2">
        <a href="<?php echo base_url($form) ?>"><i class="fa fa-plus fa-2x"></i></a>
    </div>
</div>
<!-- <form method="POST">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" name="search" class="form-control form-control-sm" placeholder="Search" aria-controls="dataTable"></label></div>
        </div>
    </div>
</form> -->
<table class="table table-responsive-sm" id="tableServer">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col">Pelanggan</th>
            <th scope="col">Jenis Deposit</th>
            <th scope="col">Kelipatan</th>
            <th scope="col">Point</th>
            <th scope="col">Waktu Transaksi</th>
            <th scope="col">Dibuat Oleh</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<div class="row">
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
            <?php echo $pagenation ?>
        </div>
    </div>
</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#tableServer').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?= base_url('Admin/getTarnsaction') ?>',
                type: 'POST',
            },
        });
        window.onclick = function(event) {
            $('tbody').find('[name=delete]').click(function() {
                var pkey = $(this).val();
                var obj = $(this);
                var tbl = obj.attr('data');
                Swal.fire({
                    title: 'yakin?',
                    text: "Data Akan Di Hapus Secara Permanen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                                url: '<?= base_url('Admin/ajax') ?>',
                                type: 'POST',
                                data: {
                                    action: 'delete',
                                    pkey: pkey,
                                    tbl: tbl,
                                },
                            })
                            .done(function(a) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Berhasil Di Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                obj.closest('tr').remove();
                                $.each($('tbody').find('tr > th'), function(index, elemt) {
                                    $(elemt).html(index + 1)
                                });
                            })
                            .fail(function(a) {
                                console.log("error");
                                console.log(a);
                            })



                    }
                })
            })
            // $('.current').addClass('bg-blue-900');
        }

    });
</script>