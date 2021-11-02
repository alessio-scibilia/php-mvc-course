<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-start mb15">
            <h1><i class="fa fa-upload"></i> <?php echo $view_model->translations->get('carica_ospiti'); ?></h1>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('seleziona_file'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="file_ospiti">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <a href="javascript:void()" class="btn btn-success" id="uploadGuestsDo"
                                   data-success="<?php echo $view_model->translations->get('ospiti_caricati'); ?>"
                                   data-failure="<?php echo $view_model->translations->get('errore_salvataggio'); ?>"
                                   data-function="uploadGuests"><?php echo $view_model->translations->get('carica'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><?php echo $view_model->translations->get('scarica_modello'); ?></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <a download="modello_ospiti.csv" href="modelli/modello_ospiti.csv"
                                       class="btn btn-primary" id="" data-function=""><i
                                                class="fa fa-file-o"></i> <?php echo $view_model->translations->get('scarica_csv'); ?>
                                    </a><br/><br/>
                                    <a download="modello_ospiti.xls" href="modelli/modello_ospiti.xls"
                                       class="btn btn-primary" id="" data-function=""><i
                                                class="fa fa-file-excel-o"></i> <?php echo $view_model->translations->get('scarica_excel'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>

    $('#uploadGuestsDo').click(function () {
        var successo = jQuery(this).attr("data-success");
        var failure = jQuery(this).attr("data-failure");

        var form_data = new FormData();

        // Read selected files
        var totalfiles = document.getElementById('file_ospiti').files.length;
        for (var index = 0; index < totalfiles; index++) {
            form_data.append("file_ospiti[]", document.getElementById('file_ospiti').files[index]);
        }

        // AJAX request(".notification-message").html(data);
        $(".notification-message").removeClass("nm-error");
        $(".notification-message").addClass("nm-success");
        $(".notification-message").fadeIn();
        $(".notification-message").html(successo);
        $.ajax({
            url: 'process/loadGuests.php',
            type: 'post',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
            }

        });

    });

</script>