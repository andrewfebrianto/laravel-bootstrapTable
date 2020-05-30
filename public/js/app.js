//fixed multimodal
$('.modal').on('hidden.coreui.modal', function () {
    if ($('.modal:visible').length) {
        $('body').addClass('modal-open');
    }
});

toastr.options = {
    "closeButton": true,
    "timeOut": "2000"
}

/*
 * Function for bootstrap-table
 */

function getNumRow(table) {
    var tableOptions = $(table).bootstrapTable('getOptions');
    return ((tableOptions.pageNumber - 1) * tableOptions.pageSize) + 1;
}

function actLayout(value) {
    let buttons = '';
    buttons += '<div class = "dropdown" >' +
        '<button class = "btn btn-ghost-primary" type = "button" id = "dropdownMenuButton" data-toggle = "dropdown" aria-expanded = "false">' +
        '<i class ="fas fa-ellipsis-v"></i></button>' +
        '<div class = "dropdown-menu" aria-labelledby = "dropdownMenuButton">';
    if (Array.isArray(value)) {
        buttons += value.join('');
    } else {
        buttons += value;
    }

    buttons += '</div></div>';
    return buttons
}

function loadBootstrapTable(idTable = '#table') {
    $(idTable).bootstrapTable({
        classes: "table table-hover",
        theadClasses: "thead-dark",
        buttonsClass: "dark",
        method: 'post',
        pagination: true,
        mobileResponsive: true,
        clickToSelect: true,
        toolbar: "#toolbar",
        search: true,
        sidePagination: "server",
        showButtonText: "true",
        searchOnEnterKey: true,
        buttonsAlign: "left",
        showColumns: true,
        showFullscreen: true,
        showExport: true,
        showRefresh: true,
        ajaxOptions: 'getToken',
        onPostBody: function () {
            $('.fixed-table-toolbar').find('.btn').addClass('btn-app');
            $('.fixed-table-toolbar').find('button[name="fullscreen"]').addClass('d-md-down-none');
            $('.fixed-table-toolbar').find('.search').addClass('col-md-3 col-sm-12 px-0 pt-md-2');
            $('.fixed-table-toolbar').find('.btn').removeClass('dropdown-toggle');
            confirmDelete();
        },
        exportDataType: "all",
        exportTypes: ['csv', 'excel'],
        exportOptions:{
            ignoreColumn: ['check', 'action']
        }
    });

    $(idTable).on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
        $('.is-disabled').prop('disabled', !$(idTable).bootstrapTable(
                'getSelections')
            .length);
    });

}

window.getToken = {
    beforeSend: function (xhr) {
        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'))
    }
}

function getSelected(table = '#table') {
    var ids = $.map($(table).bootstrapTable('getSelections'), function (row) {
        return row.id;
    })
    return ids;
}

function confirmDelete() {
    $('button[data-confirm], a[data-confirm]').on('click', function () {
        var table = '#table';
        var ids = '';
        table = ($(this).data('id-table') != undefined) ? $(this).data('id-table') : table;
        ids = getSelected(table);
        
        Swal.fire({
            title: "Peringatan",
            text: $(this).data('confirm'),
            type: "warning",
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve()
                    }, 500)
                })
            },
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                if ($(this).data('url') != undefined) {
                    $.ajax({
                        type: 'DELETE',
                        url: $(this).data('url'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: ids
                        },
                        dataType: 'JSON',
                        success: function (data) {
                            toastr.success(data.success);
                            $(table).bootstrapTable('refresh');
                        }
                    });
                } else {
                    toastr.success('Data has been deleted');
                    $(table).bootstrapTable('remove', {
                        field: 'id',
                        values: ids.toString()
                    })
                };
            }
            $('.is-disabled').prop('disabled', true);
        });
    });
}