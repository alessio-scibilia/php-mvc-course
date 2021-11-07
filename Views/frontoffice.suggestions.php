<div class="content-two-container" <?php if ($tab == 'sugg' || $tab == 'suggestions') echo 'style="display:block;"'; else if ($tab != false && $tab != 'sugg' && $tab != 'suggestions') echo 'style="display:none;"'; ?>>
    <h2 class="title-in-blue"><?php echo $view_model->translations->get('selezionati_per_voi'); ?></h2>
    <div class="center-self">
        <?php
        /*
        $strutture_collegate = getStruttureHotelID($dbh, $_SESSION['id_hotel']);
        $categorie_attive_strutture_collegate = array();

        if ($strutture_collegate != false) {
            for ($i = 0; $i < sizeof($strutture_collegate); $i++) {
                $id = $strutture_collegate[$i]['id'];
                $cats_struttura = getCatStruttura($dbh, $id);

                $dati = getDatiStruttura($dbh, $id);

                if (is_array($cats_struttura)) {
                    for ($z = 0; $z < sizeof($cats_struttura); $z++) {
                        if ($cats_struttura[$z]['id_categoria'] != 'e' && $dati[0]['indicizza'] == 1) // e = errore dell'api
                            array_push($categorie_attive_strutture_collegate, $cats_struttura[$z]['id_categoria']);
                    }
                }
            }
        }

        //A questo punto abbiamo un elenco di tutte le categorie di tutte le strutture collegate
        //Rimuoviamo quindi i doppioni dall'array
        $k = 0;
        $cats_final = array();
        for ($i = 0; $i < sizeof($categorie_attive_strutture_collegate); $i++) {
            $found = false;
            for ($x = $i + 1; $x <= sizeof($categorie_attive_strutture_collegate) - 1; $x++) {
                if ($categorie_attive_strutture_collegate[$i] == $categorie_attive_strutture_collegate[$x])
                    $found = true;
            }
            if ($found == false) {
                $cats_final[$k] = $categorie_attive_strutture_collegate[$i];
                $k++;
            }
        }

        $cats_final_lang = array();
        $z = 0;
        for ($i = 0; $i < sizeof($cats_final); $i++) {
            $query = "SELECT * FROM categorie_strutture WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $cats_final[$i], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                $current_id = $dati['related_id'];
                if (!empty($current_id)) {
                    $id_current_lang = $current_id + $_SESSION['lang'] - 1;
                    $cats_final_lang[$z] = $id_current_lang;
                    $z++;
                } else {
                    $cats_final_lang[$z] = $cats_final[$i];
                    $z++;
                }

            }
        }
        $final_array = array_unique($cats_final_lang);


        for ($i = 0; $i < sizeof($final_array); $i++) {
            $categoria = getCategoriaByID($dbh, $final_array[$i]);
            ?>
            <a class="card-service-cat" href="javascript:void()" onclick="open_cat(<?php echo $final_array[$i]; ?>);">
                <div class="overlay">
                    <img src="cp/<?php echo $categoria['immagine']; ?>" class="icon-cat" alt="" title=""/>
                </div>
                <label><?php echo $categoria['nome']; ?></label>
            </a>
        <?php }
        */
        ?>
    </div>
</div>