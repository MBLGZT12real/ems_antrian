<script type="text/javascript">
    let optionLoket = ``;
    parseTypeAntrian.forEach(function(item, index) {
        optionLoket += `<option value="` + item.type_antrian + `">` + item.type_antrian + `</option>`;
    });

    var totalLoket = 0;

    const htmlType = `<div class="row block_row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-3">
                                        <input type="text" class="form-control"  name="type_antrian[]" placeholder="Tipe Antrian" required>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="mb-3">
                                        <input type="text" class="form-control"  name="code_antrian[]" placeholder="Kode Antrian" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-danger btn-sm mt-1 deleteType"><i class="bi-trash text-white"></i></button>
                            </div>
                        </div>
                    </div>`;

    $(document).on("click", ".addLoket", function(e) {
        totalLoket = $(this).data('total_loket');
        $(this).data('total_loket', (totalLoket + 1));

        const htmlLoket = `<div class="row block_row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-2">
                                    <div class="mb-3">
                                        <input type="text" class="form-control"  name="no_loket[]" placeholder="Nomor Loket" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <input type="text" class="form-control"  name="nama_loket[]" placeholder="Nama Loket" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <select class="form-control form-control-sm handleTypeAntrian" data-selected="[]" name="handle_type_antrian[` + (totalLoket + 1) + `][]" multiple="multiple">
                                        ` + optionLoket + `
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-danger btn-sm mt-1 deleteLoket"><i class="bi-trash text-white"></i></button>
                            </div>
                        </div>
                    </div>`;
        $("#blockLoket").append(htmlLoket);
        $(".handleTypeAntrian").select2({
            theme: "bootstrap-5",
            placeholder: "Pilih Type Antrian"
        });
    });

    $(document).on("click", ".addType", function(e) {
        $("#blockType").append(htmlType);
    });

    $(document).on("click", ".deleteLoket", function(e) {
        $(this).parents(".block_row").remove();
    });

    $(document).on("click", ".deleteType", function(e) {
        $(this).parents(".block_row").remove();
    });

    $(".handleTypeAntrian").select2({
        theme: "bootstrap-5",
        placeholder: "Pilih Type Antrian"
    });

    $(".handleTypeAntrian").each(function(e) {
        let selected = $(this).data('selected');
        let parseSelected = (selected.length > 0) ? JSON.parse(selected.replaceAll("'", '"')) : [];
        $(this).val(parseSelected).trigger('change');
    })

    let htmlPrinter = `<div class="row block_row mt-3">
                            <div class="col-6">
                                <input type="text" class="form-control" name="ip_komputer_printer[]" placeholder="Ip Komputer Printer" required>
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" name="port_komputer_printer[]" placeholder="Port Komputer Printer" required>
                            </div>
                            <div class="col-2">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger btn-sm deletePrinter"><i class="bi-trash text-white"></i></button>
                                </div>
                            </div>
                        </div>`;

    $(document).on("click", ".addPrinter", function(e) {
        $("#blockPrinter").append(htmlPrinter);
    });

    $(document).on("click", ".deletePrinter", function(e) {
        $(this).parents(".block_row").remove();
        let ip = $(this).data('ip_printer_delete');
        let printerAntrianDefault = localStorage.getItem('printerAntrianDefault');
        if (printerAntrianDefault !== null) {
            let parsePrinterAntrianDefault = JSON.parse(printerAntrianDefault);
            if (parsePrinterAntrianDefault.ip_printer === ip) {
                localStorage.removeItem('printerAntrianDefault');
            }
        }
    });

    $(document).on("click", ".defaultPrinter", function(e) {
        let ip = $(this).data('ip_printer');
        let port = $(this).data('port_printer');

        let printerAntrian = JSON.stringify({
            'ip_printer': ip,
            'port_printer': port
        });

        localStorage.setItem('printerAntrianDefault', printerAntrian);
        $(document).find('.defaultPrinter').each(function() {
            $(this).html('<i class="bi-check text-white"></i>');
        });
        $(this).html('Default');
    });

    let printerAntrianDefault = localStorage.getItem('printerAntrianDefault');
    if (printerAntrianDefault !== null) {
        let parsePrinterAntrianDefault = JSON.parse(printerAntrianDefault);
        if (parsePrinters.length > 0) {
            parsePrinters.forEach(function(printItem, printIndex) {
                let defaultPrinter = $('.body-printer').find(`[data-ip_printer="${printItem.ip_komputer_printer}"]`);

                if (defaultPrinter.data('ip_printer') === parsePrinterAntrianDefault.ip_printer) {
                    defaultPrinter.html('Default');
                }

            });
        }
    }

    var listPrinters = $('.body-printer').find('input[name="ip_komputer_printer[]"]');
    $(document).on('input', 'input[name="ip_komputer_printer[]"]', function() {
        let thisInputForm = $(this).val();
        if (listPrinters.length > 0) {
            listPrinters.toArray().forEach(function(item, index) {
                if (thisInputForm === $(item).val()) {
                    alert('Ip komputer printer telah digunakan!');
                }
            });
        }
    });

    $(document).on("submit", "#saveSetting", function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('type', 'save');

        $.ajax({
            type: 'POST',
            url: 'pages/setting/action.php',
            dataType: 'JSON',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                if (result.success === true) {
                    alert("Setting berhasil disimpan")
                    window.location.reload();
                } else {
                    alert(result.message);
                }
            },
        });
    });

    $(document).on("click", "#reset_antrian", function(e) {
        let message = "Apakah anda yakin ingin mereset antrian?";
        if (confirm(message) == true) {
            $.ajax({
                url: 'pages/setting/action.php',
                method: 'POST',
                data: {
                    type: 'reset_antrian'
                },
                async: false,
                cache: false,
                dataType: 'json',
                success: function(result) {
                    alert(result.message);
                }
            });
        }
    });

    $(document).on("click", "#logout", function(e) {
        $.ajax({
            type: 'POST',
            url: 'pages/setting/action.php',
            data: {
                type: 'logout'
            },
            dataType: 'json',
            success: function(result) {
                if (result.success === true) {
                    window.location.reload();
                } else {
                    alert("Eits ada masalah nih, hubungi IT Support yaa!");
                }
            },
        });
    });
</script>