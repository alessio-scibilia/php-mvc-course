<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex align-items-center justify-content-between mb15">
            <h1><i class="fa fa-language"></i> <?php echo $view_model->translations->get('gestione_lingue'); ?></h1>
            <a class="btn btn-primary open-view-action-inside mb10"
               href="/backoffice/translations/languages">
                <i class="fa fa-plus"></i> <?php echo $view_model->translations->get('gestione_lingue'); ?>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><?php echo $view_model->translations->get('lista_traduzioni'); ?>
                        <select class="form-control lang-selector" id="lang-selector"
                                data-action="<?php echo $view_model->translations->get('link_traduzioni'); ?>"
                                data-title="tepds">
                            <?php
                            $lingua_selezionata = $view_model->languages->get_selected();
                            $lingueAll = $view_model->languages->list_all();
                            for ($i = 0; $i < sizeof($lingueAll); $i++) {
                                if ($lingua_selezionata->id == $lingueAll[$i]['shortcode_lingua'])
                                    echo '<option value="' . $lingueAll[$i]['abbreviazione'] . '" selected="selected">' . $lingueAll[$i]['nome_lingua'] . '</option>';
                                else
                                    echo '<option value="' . $lingueAll[$i]['abbreviazione'] . '">' . $lingueAll[$i]['nome_lingua'] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 100%">
                            <thead>
                            <tr>
                                <th>Shortcode</th>
                                <th><?php echo $view_model->translations->get('traduzione'); ?></th>
                                <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($view_model->translations->items as $item) { ?>
                                <tr<?php if (Translations::reserved($item['etichetta'])) echo ' style="background-color:#ff6e6e !important;color:#fff;border-radius:3px;"' ?>>
                                    <td>
                                        <div class="key-translation-<?php echo $item['etichetta']; ?>"><?php echo $item['etichetta']; ?></div>
                                    </td>
                                    <td>
                                        <div class="value-translation-<?php echo $item['etichetta']; ?>"><?php echo htmlspecialchars($item['valore']); ?></div>
                                    </td>
                                    <td>
                                        <form action="/backoffice/translations/<?php echo $item['id']; ?>"
                                              method="POST">
                                            <input type="hidden" name="valore" value=""/>
                                            <button type="button" class="btn btn-primary shadow btn-xs sharp mr-1"
                                                    data-target="<?php echo $item['etichetta']; ?>"
                                                    onclick="onClickForEdit(this)">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Shortcode</th>
                                <th><?php echo $view_model->translations->get('traduzione'); ?></th>
                                <th><?php echo $view_model->translations->get('azioni'); ?></th>
                            </tr>
                            </tfoot>
                        </table>
                        <script language="javascript">
                            var onClickForEdit = function (elem) {
                                let $button = $(elem);
                                let $i = $button.children();
                                let $target = $('.value-translation-' + $button.data('target'));
                                if ($i.hasClass('fa-pencil')) {
                                    $target.html('<input type="text" value="' + $target.text() + '">');
                                    $button.removeClass('btn-primary').addClass('btn-success');
                                    $i.removeClass('fa-pencil').addClass('fa-check');
                                } else {
                                    let $input = $target.children();
                                    let $hidden = $button.prev();
                                    $hidden.val($input.val());
                                    $button.get(0).form.submit();
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>