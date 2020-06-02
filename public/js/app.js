//fixed multimodal
$('.modal').on('hidden.coreui.modal', function () {
    if ($('.modal:visible').length) {
        $('body').addClass('modal-open');
    }
});

if (typeof (toastr) != "undefined") {
    toastr.options = {
        "closeButton": true,
        "timeOut": "2000"
    }
}

/*
 * Function for bootstrap-table
 */

function getNumRow(table) {
    var tableOptions = $(table).bootstrapTable('getOptions');
    return ((tableOptions.pageNumber - 1) * tableOptions.pageSize) + 1;
}

function actLayout(value) {
    return `<div class = "dropdown" >
        <button class = "btn btn-ghost-primary" type = "button" id = "dropdownMenuButton" data-toggle = "dropdown" aria-expanded = "false">
        <i class ="fas fa-ellipsis-v"></i></button>
        <div class = "dropdown-menu" aria-labelledby = "dropdownMenuButton"> 
        ${((Array.isArray(value)) ? value.join('') : value)}
        </div></div>`;
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
        exportOptions: {
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

/**
 * Master for function confirm
 * @param object options  
 * @param mixed callback 
 * 
 * options =  {
 *  title: "",
 *  message: "",
 *  type:  ""
 *  confirmText: ""
 * };
 */
function confirm(options, callback) {
    Swal.fire({
        title: (options.title != undefined) ? options.title : "",
        text: (options.message != undefined) ? options.message : "",
        type: (options.type != undefined) ? options.type : "",
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                setTimeout(function () {
                    resolve();
                }, 500)
            })
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: (options.confirmText != undefined) ? options.confirmText : "",
        cancelButtonText: 'Tidak'
    }).then(callback);
}

function confirmDelete() {
    $('button[data-confirm], a[data-confirm]').on('click', function () {
        let table = '#table';
        let ids = '';
        let params = '';

        table = ($(this).data('id-table') != undefined) ? $(this).data('id-table') : table;

        let tableOptions = $(table).bootstrapTable('getOptions');

        if (tableOptions.sidePagination == 'client') {
            params = new URLSearchParams($(this).data('url').substring($(this).data('url').indexOf('?')));
            ids = (getSelected(table).length > 0) ? getSelected(table) : params.get('id');
        } else {
            ids = getSelected(table);
        }

        confirm({
            title: 'Peringatan',
            message: $(this).data('confirm'),
            type: 'warning',
            confirmText: 'Ya, Hapus!'
        }, (result) => {
            if (result.value) {
                if (tableOptions.sidePagination == "server") {
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
                    toastr.success('Data telah berhasil dihapus');
                    $(table).bootstrapTable('remove', {
                        field: 'id',
                        values: ids
                    })
                }
            }
        });
        $('.is-disabled').prop('disabled', true);
    });
}