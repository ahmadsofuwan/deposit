$(document).ready(function () {

    var obj = $('#content');
    obj.find('.format-number').val(0);
    if (obj.find('[name=action]').val() !== 'update') {
        var table = obj.find('[name=addDetail]').closest('table');
        var tbody = table.find('tbody');
        var tr = tbody.find('tr');
        var clone = $(tr[0]).clone(true);
        $(tbody).append(clone);
        $(tr[0]).hide();
    }
    obj.find('.closeDetail').click(function () {
        var tbody = $(this).closest('tbody');
        var tr = tbody.find('tr');
        if (tr.length != 1) {
            $(this).closest('tr').remove();
        }
    })
    obj.find('[name=addDetail]').click(function () {
        var table = $(this).closest('table');
        var tbody = table.find('tbody');
        var tr = tbody.find('tr');
        var clone = $(tr[0]).clone(true);
        $(tbody).append(clone);
        var newObj = $(this).closest('table').find('tbody');
        $(newObj.find('tr')[tr.length]).show();
        $('.select2').select2();
        obj.find('.select2').select2();
    });

    $('.select2').select2();

    function formatnumber(number) {

        var number_string = number.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? ',' : '';
            rupiah += separator + ribuan.join(',');
            return rupiah
        }
    }
    obj.find('input').change(function (e) {

        var iObj = obj.find('.format-number')

        $.each(iObj, function (key, value) {
            var val = iObj[key].value.replace(/,/g, '')

            iObj[key].value = formatnumber(parseInt(val))
            if (isNaN(val) || iObj[key].value == 'undefined')
                iObj[key].value = 0;
        });

    });

    obj.find('.excel').click(function () {
        var obj = $(this).attr('data');
        const d = new Date();
        $(obj).table2excel({
            exclude: ".noExl",
            name: "Excel Document Name",
            filename: "Export" + d.getDay() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear() + ".xls",
            fileext: ".xls",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true,
        });
    })




});


