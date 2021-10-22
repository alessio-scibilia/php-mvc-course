<?php
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/User.class.php';
require_once 'Views/JsonView.class.php';

class BackofficeApiController
{
    protected $user_repository;

    public function __construct()
    {
        $this->user_repository = new UserRepository();
    }

    public function http_get(array &$params): JsonView
    {
        $use = $params['use']; //Funzione da utilizzare


        //DA IMPLEMENTARE ANCHE LA CHIAVE API? ERA SETTATA SU MAIN.PHP

        if (isset($_POST['parameters']) && !is_array($_POST['parameters'])) //da aggiornare
            $params = json_decode(stripslashes($_POST['parameters']));


        switch ($use) {

            case 'delRelatedStrutturaEvento':
                $result = delRelatedStrutturaEvento($dbh, $_POST['type'], $_POST['id'], $_POST['id_evento']);

            case 'delRelatedHotel':
                $result = delRelatedHotel($dbh, $params);

            case 'setScriptTable':
                $result = setScriptTable($dbh);

            case 'verifyReset':
                $email = $_POST['email'];
                $code = $_POST['code'];
                $result = verifyReset($dbh, $email, $code);

            case 'getResetCode':
                $params = $_POST['parameters'];
                $result = getResetCode($dbh, $params);

            case 'updateConvenzione':
                $params = $_POST['parameters'];
                $id_struttura = $_POST['id_struttura'];
                $result = updateConvenzione($dbh, $params, $id_struttura);

            case 'delStruttura':
                $result = delStruttura($dbh, $params);

            case 'delGuest':
                $result = delGuest($dbh, $params);

            case 'addAdmin':
                $result = addAdmin($dbh, $params);

            case 'enableGuest':
                $result = enableGuest($dbh, $params);

            case 'disableGuest':
                $result = disableGuest($dbh, $params);

            case 'addGuest':
                $result = addGuest($dbh, $params);

            case 'updateGuest':
                $result = updateGuest($dbh, $params);

            case 'delNotifica':
                $result = delNotifica($dbh, $params);

            case 'delAdmin':
                $result = delAdmin($dbh, $params);

            case 'getUserInfo':
                $result = getUserInfo($dbh, $params);

            case 'updateAdmin':
                $result = updateAdmin($dbh, $params);

            case 'addLanguage':
                $result = addLanguage($dbh, $params);

            case 'getLangsN':
                $result = getLangsN($dbh, $params);

            case 'updateLanguage':
                $result = updateLanguage($dbh, $params);

            case 'updateCurrentUserInfo':
                $result = updateCurrentUserInfo($dbh, $params);

            case 'updateCurrentUserPassword':
                $result = updateCurrentUserPassword($dbh, $params);

            case 'getHotels':
                $result = getHotels($dbh, $params);

            case 'enableLanguage':
                $result = enableLanguage($dbh, $params);

            case 'disableLanguage':
                $result = disableLanguage($dbh, $params);

            case 'delLang':
                $result = delLang($dbh, $params);

            case 'enableHotel':
                $result = enableHotel($dbh, $params);

            case 'disableHotel':
                $result = disableHotel($dbh, $params);

            case 'enableAdmin':
                $result = enableAdmin($dbh, $params);

            case 'disableAdmin':
                $result = disableAdmin($dbh, $params);

            case 'enableCategoria':
                $result = enableCategoria($dbh, $params);

            case 'disableCategoria':
                $result = disableCategoria($dbh, $params);

            case 'delHotel':
                $result = delHotel($dbh, $params);

            case 'addCategory':
                $result = addCategory($dbh, $params);

            case 'delEvento':
                $result = delEvento($dbh, $params);

            case 'enableEvento':
                $result = enableEvento($dbh, $params);

            case 'disableEvento':
                $result = disableEvento($dbh, $params);

            case 'enableStruttura':
                $result = enableStruttura($dbh, $params);

            case 'disableStruttura':
                $result = disableStruttura($dbh, $params);

            case 'updateCategory':
                $result = updateCategory($dbh, $params);

            case 'delCategory':
                $result = delCategory($dbh, $params);

            case 'addHotel':
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $sito = $_POST['sito'];
                $telefono = $_POST['telefono'];
                $indirizzo = $_POST['indirizzo'];
                $latitudine = $_POST['latitudine'];
                $longitudine = $_POST['longitudine'];
                $password = md5($_POST['password']);
                $utente_abilitato = $_POST['utente_abilitato'];
                $pro = $_POST['pro'];
                $num_services = $_POST['num_services'];
                $descrizioni_ospiti = $_POST['descrizioni_ospiti'];
                $nomi_servizi = $_POST['nomi_servizi'];
                $abilitato = $_POST['abilitato'];
                $descrizioni_servizi = $_POST['descrizioni_servizi'];
                $immagine_servizio = $_POST['immagine_servizio'];
                $lunedi = $_POST['lunedi'];
                $martedi = $_POST['martedi'];
                $mercoledi = $_POST['mercoledi'];
                $giovedi = $_POST['giovedi'];
                $venerdi = $_POST['venerdi'];
                $sabato = $_POST['sabato'];
                $domenica = $_POST['domenica'];
                $default_image = $_POST['default_image'];
                $immagini_hotel = $_POST['immagini_hotel'];
                $result = addHotel($dbh, $nome, $email, $sito, $telefono, $indirizzo, $latitudine, $longitudine, $password, $utente_abilitato, $pro, $num_services, $descrizioni_ospiti, $nomi_servizi, $abilitato, $descrizioni_servizi, $immagine_servizio, $lunedi, $martedi, $mercoledi, $giovedi, $venerdi, $sabato, $domenica, $immagini_hotel, $default_image);

            case 'addEvento':
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $sito = $_POST['sito'];
                $telefono = $_POST['telefono'];
                $indirizzo = $_POST['indirizzo'];
                $latitudine = $_POST['latitudine'];
                $longitudine = $_POST['longitudine'];
                $data_inizio = $_POST['data_inizio'];
                $nome_evento = $_POST['nome_evento'];
                $data_fine = $_POST['data_fine'];
                $ora_inizio = $_POST['ora_inizio'];
                $ora_fine = $_POST['ora_fine'];
                $benefit = $_POST['descrizione_benefit'];
                $img_evento = $_POST['img_evento'];
                $recupera = $_POST['recupera'];
                $descrizione_evento = $_POST['descrizione_evento'];
                $recupera_convenzione = $_POST['recupera_convenzione'];
                $struttura_associata = $_POST['struttura_associata'];
                $result = addEvento($dbh, $nome, $email, $sito, $telefono, $indirizzo, $latitudine, $longitudine, $data_inizio, $ora_inizio, $data_fine, $ora_fine, $benefit, $img_evento, $recupera, $recupera_convenzione, $struttura_associata, $nome_evento, $descrizione_evento);

            case 'updateEvento':
                $nome = $_POST['nome'];
                $id_evento = $_POST['id_evento'];
                $email = $_POST['email'];
                $sito = $_POST['sito'];
                $telefono = $_POST['telefono'];
                $indirizzo = $_POST['indirizzo'];
                $latitudine = $_POST['latitudine'];
                $longitudine = $_POST['longitudine'];
                $data_inizio = $_POST['data_inizio'];
                $nome_evento = $_POST['nome_evento'];
                $data_fine = $_POST['data_fine'];
                $ora_inizio = $_POST['ora_inizio'];
                $ora_fine = $_POST['ora_fine'];
                $benefit = $_POST['descrizione_benefit'];
                $descrizione_evento = $_POST['descrizione_evento'];
                $img_evento = $_POST['img_evento'];
                $recupera = $_POST['recupera'];
                $recupera_convenzione = $_POST['recupera_convenzione'];
                $struttura_associata = $_POST['struttura_associata'];
                $result = updateEvento($dbh, $nome, $email, $sito, $telefono, $indirizzo, $latitudine, $longitudine, $data_inizio, $ora_inizio, $data_fine, $ora_fine, $benefit, $img_evento, $recupera, $recupera_convenzione, $struttura_associata, $nome_evento, $id_evento, $descrizione_evento);

            case 'updateEventoSmall':
                $id_evento = $_POST['id_evento'];
                $benefit = $_POST['descrizione_benefit'];
                $result = updateEventoSmall($dbh, $benefit, $id_evento);

            case 'updateHotel':
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $sito = $_POST['sito'];
                $telefono = $_POST['telefono'];
                $indirizzo = $_POST['indirizzo'];
                $latitudine = $_POST['latitudine'];
                $longitudine = $_POST['longitudine'];
                $utente_abilitato = $_POST['utente_abilitato'];
                $pro = $_POST['pro'];
                $num_services = $_POST['num_services'];
                $descrizioni_ospiti = $_POST['descrizioni_ospiti'];
                $nomi_servizi = $_POST['nomi_servizi'];
                $abilitato = $_POST['abilitato'];
                $descrizioni_servizi = $_POST['descrizioni_servizi'];
                $immagine_servizio = $_POST['immagine_servizio'];
                $lunedi = $_POST['lunedi'];
                $martedi = $_POST['martedi'];
                $mercoledi = $_POST['mercoledi'];
                $giovedi = $_POST['giovedi'];
                $venerdi = $_POST['venerdi'];
                $sabato = $_POST['sabato'];
                $domenica = $_POST['domenica'];
                $default_image = $_POST['default_image'];
                $immagini_hotel = $_POST['immagini_hotel'];
                $id_hotel = $_POST['hotel_id'];
                $result = updateHotel($dbh, $nome, $email, $sito, $telefono, $indirizzo, $latitudine, $longitudine, $password, $utente_abilitato, $pro, $num_services, $descrizioni_ospiti, $nomi_servizi, $abilitato, $descrizioni_servizi, $immagine_servizio, $lunedi, $martedi, $mercoledi, $giovedi, $venerdi, $sabato, $domenica, $immagini_hotel, $default_image, $id_hotel);

            case 'addStruttura':
                $hotel_associati = $_POST['hotel_associati'];
                $categorie_associate = $_POST['categorie_associate'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $sito = $_POST['sito'];
                $telefono = $_POST['telefono'];
                $indirizzo = $_POST['indirizzo'];
                $latitudine = $_POST['latitudine'];
                $longitudine = $_POST['longitudine'];
                $utente_abilitato = $_POST['utente_abilitato'];
                $num_eccellenze = $_POST['num_eccellenze'];
                $descrizioni_normali = $_POST['descrizioni_normali'];
                $descrizione_benefit = $_POST['descrizione_benefit'];
                $nomi_eccellenza = $_POST['nomi_eccellenza'];
                $abilitato = $_POST['abilitato'];
                $descrizioni_eccellenza = $_POST['descrizioni_eccellenza'];
                $immagine_eccellenze = $_POST['immagini_hotel'];
                $lunedi = $_POST['lunedi'];
                $martedi = $_POST['martedi'];
                $mercoledi = $_POST['mercoledi'];
                $giovedi = $_POST['giovedi'];
                $venerdi = $_POST['venerdi'];
                $sabato = $_POST['sabato'];
                $domenica = $_POST['domenica'];
                $indicizza = $_POST['indicizza'];
                $tipo_viaggio = $_POST['tipo_viaggio'];
                $convenzionato = $_POST['convenzionato'];
                $default_image = $_POST['default_image'];
                $immagini_hotel = $_POST['immagini_hotel'];
                $immagini_didascalia = $_POST['immagini_didascalia'];
                $testi_didascalia = $_POST['testi_didascalia'];
                $result = addStruttura($dbh, $nome, $email, $telefono, $sito, $indirizzo, $latitudine, $longitudine, $utente_abilitato, $num_eccellenze, $descrizioni_normali, $descrizione_benefit, $nomi_eccellenza, $abilitato, $descrizioni_eccellenza, $immagine_eccellenze, $lunedi, $martedi, $mercoledi, $giovedi, $venerdi, $sabato, $domenica, $immagini_hotel, $default_image, $hotel_associati, $categorie_associate, $indicizza, $convenzionato, $immagini_didascalia, $testi_didascalia, $tipo_viaggio);

            case 'updateStruttura':
                $hotel_associati = $_POST['hotel_associati'];
                $categorie_associate = $_POST['categorie_associate'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $sito = $_POST['sito'];
                $telefono = $_POST['telefono'];
                $indirizzo = $_POST['indirizzo'];
                $latitudine = $_POST['latitudine'];
                $longitudine = $_POST['longitudine'];
                $utente_abilitato = $_POST['utente_abilitato'];
                $num_eccellenze = $_POST['num_eccellenze'];
                $descrizioni_normali = $_POST['descrizioni_normali'];
                $descrizione_benefit = $_POST['descrizione_benefit'];
                $nomi_eccellenza = $_POST['nomi_eccellenza'];
                $abilitato = $_POST['abilitato'];
                $descrizioni_eccellenza = $_POST['descrizioni_eccellenza'];
                $immagine_eccellenze = $_POST['immagine_eccellenze'];
                $lunedi = $_POST['lunedi'];
                $martedi = $_POST['martedi'];
                $mercoledi = $_POST['mercoledi'];
                $giovedi = $_POST['giovedi'];
                $venerdi = $_POST['venerdi'];
                $sabato = $_POST['sabato'];
                $domenica = $_POST['domenica'];
                $indicizza = $_POST['indicizza'];
                $convenzionato = $_POST['convenzionato'];
                $default_image = $_POST['default_image'];
                $immagini_hotel = $_POST['immagini_hotel'];
                $id_struttura = $_POST['id_struttura'];
                $immagini_didascalia = $_POST['immagini_didascalia'];
                $testi_didascalia = $_POST['testi_didascalia'];
                $tipo_viaggio = $_POST['tipo_viaggio'];
                $result = updateStruttura($dbh, $nome, $email, $telefono, $sito, $indirizzo, $latitudine, $longitudine, $utente_abilitato, $num_eccellenze, $descrizioni_normali, $descrizione_benefit, $nomi_eccellenza, $abilitato, $descrizioni_eccellenza, $immagine_eccellenze, $lunedi, $martedi, $mercoledi, $giovedi, $venerdi, $sabato, $domenica, $immagini_hotel, $default_image, $hotel_associati, $categorie_associate, $indicizza, $convenzionato, $id_struttura, $immagini_didascalia, $testi_didascalia, $tipo_viaggio);

            case 'updateTranslation':
                if (isset($_POST['id_lingua']) && isset($_POST['translation']) && isset($_POST['key'])) {
                    $id_lingua = json_decode(stripslashes($_POST['id_lingua']));
                    $translation = json_decode(stripslashes($_POST['translation']));
                    $key = json_decode(stripslashes($_POST['key']));

                    $result = updateTranslation($dbh, $id_lingua, $translation, $key);
                } else
                    $result = 'error';
        }

        return new JsonView($result);
    }


    //
    function addAdmin($dbh, $params)
    {
        $query = "SELECT email FROM users WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params[2], PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = 'error';
        } else {
            $query = "INSERT INTO users (nome,cognome,email,level,password,abilitato) VALUES (?,?,?,?,?,1)";
            $password = md5($params[4]);

            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
            $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
            $stmt->bindParam(3, $params[2], PDO::PARAM_STR);
            $stmt->bindParam(4, $params[3], PDO::PARAM_INT);
            $stmt->bindParam(5, $password, PDO::PARAM_STR);

            $stmt->execute();
            $result = 'success';
        }

        return $result;
    }

    protected function add_admin(array $params): string
    {
        $user = $this->user_repository->get_by_email($params['email']);

        if ($user == null) {
            $id = $this->user_repository->add($params);

            if ($id === false)
                return 'error';
            else
                return 'success';
        } else {
            return 'error';
        }
    }


    function delAdmin($dbh, $params)
    {
        session_start();
        $id = $params;
        if ($_SESSION['level'] <= 2) {
            $query = "DELETE FROM users WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = 'success';
        } else $result = 'error';

        return $result;
    }


    function delGuest($dbh, $params)
    {
        session_start();
        $id = $params;
        $query = "DELETE FROM ospiti_hotel WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = 'success';

        return $result;
    }


    function delHotel($dbh, $params)
    {
        session_start();
        $id = $params;
        if ($_SESSION['level'] <= 2) {
            $query = "SELECT related_id FROM hotel WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                $rel_id = $dati['related_id'];

                $query = "DELETE FROM hotel WHERE related_id = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $rel_id, PDO::PARAM_INT);
                $stmt->execute();

                $str_hot = '1-' . $rel_id;
                $query = "DELETE FROM strutture_eventi WHERE id_struttura = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $str_hot, PDO::PARAM_INT);
                $stmt->execute();

                $query = "DELETE FROM strutture_hotel WHERE id_hotel = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $rel_id, PDO::PARAM_INT);
                $stmt->execute();

                $query = "DELETE FROM servizi WHERE hotel_associato = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $rel_id, PDO::PARAM_INT);
                $stmt->execute();

                $result = 'success';

            } else $result = 'error';

        } else $result = 'error';

        return $result;
    }


    function delLang($dbh, $params)
    {
        session_start();
        $id = $params;
        if ($_SESSION['level'] <= 2) {
            //ToDO query unica
            $query = "DELETE FROM traduzioni_backend_4 WHERE shortcode_lingua = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            $query = "DELETE FROM traduzioni_backend_3 WHERE shortcode_lingua = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            $query = "DELETE FROM traduzioni_backend_2 WHERE shortcode_lingua = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            $query = "DELETE FROM traduzioni_backend WHERE shortcode_lingua = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            $result = 'success';
        } else $result = 'error';

        return $result;
    }


    function getLevelText($livello)
    {
        switch ($livello) {
            case 0:
                $result = 'Developer User';
                break;
            case 1:
                $result = 'Superadmin';
                break;
            case 2:
                $result = 'Admin';
                break;
            case 3:
                $result = 'Hotel Pro';
                break;
            case 4:
                $result = 'Hotel';
                break;


        }
        return $result;
    }


    function getUserInfo($dbh, $id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result['nome'] = $dati['nome'];
                $result['cognome'] = $dati['cognome'];
                $result['email'] = $dati['email'];
                $result['livello'] = $dati['level'];
                $result['id'] = $dati['id'];
            }
        } else {
            $result = 'error';
        }
        return $result;
    }

    function updateAdmin($dbh, $params)
    {
        session_start();
        if ($_SESSION['level'] <= 2) {
            $query = "UPDATE users SET nome = ?, cognome = ?, email = ?, level = ? WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
            $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
            $stmt->bindParam(3, $params[2], PDO::PARAM_STR);
            $stmt->bindParam(4, $params[3], PDO::PARAM_STR);
            $stmt->bindParam(5, $params[4], PDO::PARAM_STR);
            $stmt->execute();
            $result = 'success';
        } else $result = 'error';

        return $result;
    }


    function getListaTraduzioni($dbh, $id_lingua)
    {
        if ($id_lingua == false)
            $id_lingua = 1;

        $query = "SELECT * FROM traduzioni_backend_4 WHERE shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $arrayColumn = array_keys($dati);
            for ($i = 0; $i < sizeof($arrayColumn); $i++) {
                $result[$arrayColumn[$i]] = $dati[$arrayColumn[$i]];
            }
        }

        $query = "SELECT * FROM traduzioni_backend_3 WHERE shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $arrayColumn = array_keys($dati);
            for ($i = 0; $i < sizeof($arrayColumn); $i++) {
                $result[$arrayColumn[$i]] = $dati[$arrayColumn[$i]];
            }
        }

        $query = "SELECT * FROM traduzioni_backend_2 WHERE shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $arrayColumn = array_keys($dati);
            for ($i = 0; $i < sizeof($arrayColumn); $i++) {
                $result[$arrayColumn[$i]] = $dati[$arrayColumn[$i]];
            }
        }

        $query = "SELECT * FROM traduzioni_backend WHERE shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $arrayColumn = array_keys($dati);
            for ($i = 0; $i < sizeof($arrayColumn); $i++) {
                $result[$arrayColumn[$i]] = $dati[$arrayColumn[$i]];
            }
        }

        return ($result);
    }


    function updateTranslation($dbh, $id_lingua, $translation, $key)
    {
        $query = "UPDATE traduzioni_backend SET " . $key . " = ? WHERE abbreviazione = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $translation, PDO::PARAM_STR);
        $stmt->bindParam(2, $id_lingua, PDO::PARAM_STR);
        $stmt->execute();


        $query = "UPDATE traduzioni_backend SET " . $key . " = ? WHERE abbreviazione = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $translation, PDO::PARAM_STR);
        $stmt->bindParam(2, $id_lingua, PDO::PARAM_STR);
        $stmt->execute();

        return ('success');

    }

    function addLanguage($dbh, $params)
    {
        $query = "SELECT shortcode_lingua FROM traduzioni_backend ORDER BY shortcode_lingua DESC LIMIT 1";
        $stmt = $dbh->query($query);
        if ($stmt->rowCount() > 0)
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
        $last_shortcode = $dati['shortcode_lingua'];
        $next_shortcode = $last_shortcode + 1;

        $query = "INSERT INTO traduzioni_backend (nome_lingua,abbreviazione,shortcode_lingua,id_lingua) VALUES (?,?,?,?)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
        $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
        $stmt->bindParam(3, $next_shortcode, PDO::PARAM_INT);
        $stmt->bindParam(4, $next_shortcode, PDO::PARAM_INT);

        $stmt->execute();


        $query = "INSERT INTO traduzioni_backend_2 (nome_lingua,abbreviazione,shortcode_lingua,id_lingua,lingua_abilitata) VALUES (?,?,?,?,0)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
        $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
        $stmt->bindParam(3, $next_shortcode, PDO::PARAM_INT);
        $stmt->bindParam(4, $next_shortcode, PDO::PARAM_INT);

        $stmt->execute();

        $query = "INSERT INTO traduzioni_backend_3 (nome_lingua,abbreviazione,shortcode_lingua,id_lingua) VALUES (?,?,?,?)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
        $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
        $stmt->bindParam(3, $next_shortcode, PDO::PARAM_INT);
        $stmt->bindParam(4, $next_shortcode, PDO::PARAM_INT);

        $stmt->execute();


        $query = "INSERT INTO traduzioni_backend_4 (nome_lingua,abbreviazione,shortcode_lingua,id_lingua) VALUES (?,?,?,?)";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
        $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
        $stmt->bindParam(3, $next_shortcode, PDO::PARAM_INT);
        $stmt->bindParam(4, $next_shortcode, PDO::PARAM_INT);

        $stmt->execute();

        return ('success');
    }


    function getLanguageInfo($dbh, $id_lingua)
    {
        $query = "SELECT id,abbreviazione,nome_lingua,shortcode_lingua FROM traduzioni_backend WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);

            $result['id'] = $dati['id'];
            $result['nome_lingua'] = $dati['nome_lingua'];
            $result['abbreviazione'] = $dati['abbreviazione'];
            $result['shortcode_lingua'] = $dati['shortcode_lingua'];

            return $result;
        } else
            return ("error");
    }


    function updateLanguage($dbh, $params)
    {
        $id_lingua = $params[3];
        $nome = $params[0];
        $abbreviazione = $params[1];
        $shortcode = $params[2];

        $query = "UPDATE traduzioni_backend SET nome_lingua = ?, abbreviazione = ?, shortcode_lingua = ? WHERE id_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->bindParam(2, $abbreviazione, PDO::PARAM_STR);
        $stmt->bindParam(3, $shortcode, PDO::PARAM_INT);
        $stmt->bindParam(4, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();

        $query = "UPDATE traduzioni_backend_2 SET nome_lingua = ?, abbreviazione = ?, shortcode_lingua = ? WHERE id_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->bindParam(2, $abbreviazione, PDO::PARAM_STR);
        $stmt->bindParam(3, $shortcode, PDO::PARAM_INT);
        $stmt->bindParam(4, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();

        $query = "UPDATE traduzioni_backend_3 SET nome_lingua = ?, abbreviazione = ?, shortcode_lingua = ? WHERE id_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->bindParam(2, $abbreviazione, PDO::PARAM_STR);
        $stmt->bindParam(3, $shortcode, PDO::PARAM_INT);
        $stmt->bindParam(4, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();

        $query = "UPDATE traduzioni_backend_4 SET nome_lingua = ?, abbreviazione = ?, shortcode_lingua = ? WHERE id_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->bindParam(2, $abbreviazione, PDO::PARAM_STR);
        $stmt->bindParam(3, $shortcode, PDO::PARAM_INT);
        $stmt->bindParam(4, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();
        return ("success");
    }


    function updateCurrentUserInfo($dbh, $params)
    {
        session_start();
        $email_user = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email_user, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $query = "UPDATE users SET nome = ?, cognome = ?, email = ? WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
            $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
            $stmt->bindParam(3, $params[2], PDO::PARAM_STR);
            $stmt->bindParam(4, $_SESSION['id_user'], PDO::PARAM_INT);
            $stmt->execute();
            $_SESSION['name'] = $params[0];
            $_SESSION['surname'] = $params[1];
            $_SESSION['email'] = $params[2];
            $result = 'success';
        } else {
            $query = "SELECT * FROM hotel WHERE email = ? LIMIT 1";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $email_user, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $query = "UPDATE hotel SET nome = ?, email = ? WHERE id = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
                $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
                $stmt->bindParam(3, $_SESSION['id_user'], PDO::PARAM_INT);
                $stmt->execute();
                $_SESSION['email'] = $params[1];
                $_SESSION['name'] = $params[0];
                $result = 'success';
            } else $result = 'error';

        }

        return $result;
    }


    function updateCurrentUserPassword($dbh, $params)
    {
        session_start();
        $password = md5($params[0]);
        if ($password == md5($params[1])) {
            $query = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $password, PDO::PARAM_STR);
            $stmt->bindParam(2, $_SESSION['email'], PDO::PARAM_STR);
            $stmt->execute();

            $query = "UPDATE hotel SET password = ? WHERE email = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $password, PDO::PARAM_STR);
            $stmt->bindParam(2, $_SESSION['email'], PDO::PARAM_STR);
            $stmt->execute();
            echo 'success';
        } else echo 'error';
    }


    function getHotels($dbh)
    {
        $shortcode_lingua = $_SESSION['lang'];
        $query = "SELECT * FROM hotel WHERE shortcode_lingua = ? ORDER BY nome DESC";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $shortcode_lingua, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['id'] = $dati['id'];
                $result[$i]['nome'] = $dati['nome'];
                $result[$i]['immagine_principale'] = $dati['immagine_principale'];
                $result[$i]['indirizzo'] = $dati['indirizzo'];
                $result[$i]['telefono'] = $dati['telefono'];
                $result[$i]['sito_web'] = $dati['sito_web'];
                $result[$i]['email'] = $dati['email'];
                $result[$i]['password'] = $dati['password'];
                $result[$i]['immagini_secondarie'] = $dati['immagini_secondarie'];
                $result[$i]['descrizione_ospiti'] = $dati['descrizione_ospiti'];
                $result[$i]['abilitato'] = $dati['abilitato'];
                $result[$i]['livello'] = $dati['livello'];
                $result[$i]['related_id'] = $dati['related_id'];
                $i++;
            }
        } else $result = 'error';

        return $result;

    }


    function getStrutture($dbh)
    {
        if ($_SESSION['level'] <= 2) {
            $query = "SELECT * FROM strutture WHERE shortcode_lingua = ? ORDER BY nome_struttura DESC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $_SESSION['lang'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $i = 0;
                while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[$i]['id'] = $dati['id'];
                    $result[$i]['nome'] = $dati['nome_struttura'];
                    $result[$i]['immagine_principale'] = $dati['immagine_principale'];
                    $result[$i]['indirizzo'] = $dati['indirizzo_struttura'];
                    $result[$i]['telefono'] = $dati['telefono'];
                    $result[$i]['sito_web'] = $dati['sito_web'];
                    $result[$i]['email'] = $dati['email'];
                    $result[$i]['abilitata'] = $dati['abilitata'];
                    $result[$i]['created_by'] = $dati['created_by'];
                    $i++;
                }
            } else $result = 'error';
        } else {
            $query = "SELECT * FROM strutture WHERE shortcode_lingua = ? ORDER BY nome_struttura DESC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $_SESSION['lang'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $i = 0;
                while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($dati['created_by'] == 0 || $dati['created_by'] == $_SESSION['id_user']) {
                        $result[$i]['id'] = $dati['id'];
                        $result[$i]['nome'] = $dati['nome_struttura'];
                        $result[$i]['immagine_principale'] = $dati['immagine_principale'];
                        $result[$i]['indirizzo'] = $dati['indirizzo_struttura'];
                        $result[$i]['telefono'] = $dati['telefono'];
                        $result[$i]['sito_web'] = $dati['sito_web'];
                        $result[$i]['email'] = $dati['email'];
                        $result[$i]['abilitata'] = $dati['abilitata'];
                        $result[$i]['created_by'] = $dati['created_by'];
                        $i++;
                    }
                }
            } else $result = 'error';
        }

        return $result;

    }


    function getEventi($dbh)
    {

        if ($_SESSION['level'] <= 2) {
            $query = "SELECT * FROM eventi  ORDER BY nome_evento DESC";
            $stmt = $dbh->query($query);
            if ($stmt->rowCount() > 0) {
                $i = 0;
                while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[$i]['id'] = $dati['id'];
                    $result[$i]['nome'] = $dati['nome_evento'];
                    $result[$i]['created_by'] = $dati['created_by'];
                    $result[$i]['nome_luogo'] = $dati['nome_struttura'];
                    $result[$i]['indirizzo'] = $dati['indirizzo'];
                    $result[$i]['struttura_collegata'] = $dati['struttura_collegata'];
                    $result[$i]['abilitato'] = $dati['abilitato'];
                    $result[$i]['data'] = $dati['data_inizio_evento'];


                    $i++;
                }
            } else $result = 'error';
        } else {
            $query = "SELECT * FROM strutture_eventi WHERE id_struttura = ? AND shortcode_lingua = ?";
            $stmt = $dbh->prepare($query);
            $id_struttura = '1-' . $_SESSION['id_user'];
            $stmt->bindParam(1, $id_struttura, PDO::PARAM_STR);
            $stmt->bindParam(2, $_SESSION['lang'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $i = 0;
                while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $query_bis = "SELECT * FROM eventi WHERE id = ?";
                    $stmt_bis = $dbh->prepare($query_bis);
                    $stmt_bis->bindParam(1, $dati['id_evento'], PDO::PARAM_INT);
                    $stmt_bis->execute();
                    if ($stmt_bis->rowCount() > 0) {
                        $dati_bis = $stmt_bis->fetch(PDO::FETCH_ASSOC);
                        $result[$i]['id'] = $dati_bis['id'];
                        $result[$i]['nome'] = $dati_bis['nome_evento'];
                        $result[$i]['nome_luogo'] = $dati_bis['nome_struttura'];
                        $result[$i]['created_by'] = $dati_bis['created_by'];
                        $result[$i]['struttura_collegata'] = $dati_bis['struttura_collegata'];
                        $result[$i]['abilitato'] = $dati_bis['abilitato'];
                        $result[$i]['data'] = $dati_bis['data_inizio_evento'];
                        $i++;
                    }
                }
            } else return ("error");
        }

        return $result;

    }


    function getNomeHotel($dbh, $id)
    {
        $query = "SELECT * FROM hotel WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $result['nome'] = $dati['nome'];
            return $result;
        } else return ("error");
    }

    function getNomeStruttura($dbh, $id)
    {
        $query = "SELECT * FROM strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $result['nome'] = $dati['nome_struttura'];
            return $result;
        } else return ("error");
    }


    function getCategorie($dbh, $id_lingua)
    {
        $query = "SELECT * FROM categorie_strutture WHERE shortcode_lingua = ? ORDER BY nome DESC";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['id'] = $dati['id'];
                $result[$i]['nome'] = $dati['nome'];
                $result[$i]['immagine'] = $dati['immagine'];
                $result[$i]['slug'] = $dati['slug'];
                $result[$i]['abilitata'] = $dati['abilitata'];
                $result[$i]['related_id'] = $dati['related_id'];
                $i++;
            }
        } else $result = 'error';

        return $result;

    }


    function enableLanguage($dbh, $params)
    {
        $query = "UPDATE traduzioni_backend_2 SET lingua_abilitata = 1 WHERE shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $shortcode = $params[0];
        $stmt->bindParam(1, $shortcode, PDO::PARAM_INT);
        $stmt->execute();
        $result = 'success';

        return $result;

    }


    function enableAdmin($dbh, $params)
    {
        $query = "UPDATE users SET abilitato = 1 WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $id = $params;
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = 'success';

        return $result;

    }

    function disableAdmin($dbh, $params)
    {
        $query = "UPDATE users SET abilitato = 0 WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $id = $params;
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = 'success';

        return $result;

    }


    function enableHotel($dbh, $params)
    {
        $query = "SELECT email FROM hotel WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $id = $params;
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $dati['email'];
        }
        $query = "UPDATE hotel SET abilitato = 1 WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = 'success';

        return $result;

    }

    function enableCategoria($dbh, $params)
    {
        $query = "SELECT immagine FROM categorie_strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $id = $params;
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $nome_cat = $dati['immagine'];
        }
        $query = "UPDATE categorie_strutture SET abilitata = 1 WHERE immagine = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $nome_cat, PDO::PARAM_STR);
        $stmt->execute();
        $result = 'success';

        return $result;

    }


    function disableCategoria($dbh, $params)
    {
        $query = "SELECT immagine FROM categorie_strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $id = $params[0];
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $nome_cat = $dati['immagine'];
        }
        $query = "UPDATE categorie_strutture SET abilitata = 0 WHERE immagine = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $nome_cat, PDO::PARAM_STR);
        $stmt->execute();
        $result = 'success';

        return $result;

    }


    function disableHotel($dbh, $params)
    {
        $query = "SELECT email FROM hotel WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $id = $params;
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $dati['email'];
        }
        $query = "UPDATE hotel SET abilitato = 0 WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = 'success';

        return $result;

    }


    function disableLanguage($dbh, $params)
    {
        $query = "UPDATE traduzioni_backend_2 SET lingua_abilitata = 0 WHERE shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $shortcode = $params[0];
        $stmt->bindParam(1, $shortcode, PDO::PARAM_INT);
        $stmt->execute();
        $result = 'success';

        return $result;

    }

    function getGuests($dbh)
    {
        $result = false;
        if ($_SESSION['level'] >= 3 || $_SESSION['super_level'] == true) {
            $query = "SELECT * FROM ospiti_hotel WHERE hotel_associato = ? ORDER BY id ASC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $_SESSION['id_user'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $i = 0;
                while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[$i]['id'] = $dati['id'];
                    $result[$i]['nome'] = $dati['nome'];
                    $result[$i]['cognome'] = $dati['cognome'];
                    $result[$i]['telefono'] = $dati['telefono'];
                    $result[$i]['email'] = $dati['email'];
                    $result[$i]['data_checkin'] = $dati['data_checkin'];
                    $result[$i]['abilitato'] = $dati['abilitato'];
                    $result[$i]['data_checkout'] = $dati['data_checkout'];
                    $i++;
                }
            } else $result = false;
        }

        return $result;
    }

    function updateHotel($dbh, $nome, $email, $sito, $telefono, $indirizzo, $latitudine, $longitudine, $password, $utente_abilitato, $pro, $num_services, $descrizioni_ospiti, $nomi_servizi, $abilitato, $descrizioni_servizi, $immagine_servizio, $lunedi, $martedi, $mercoledi, $giovedi, $venerdi, $sabato, $domenica, $immagini_hotel, $default_image, $id_hotel)
    {

        session_start();


        $path_imgs_hotel = '';
        for ($i = 0; $i < sizeof($immagini_hotel); $i++) {
            $path_imgs_hotel .= $immagini_hotel[$i] . '|';
        }

        $query = "SELECT related_id FROM hotel WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_hotel, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_hotel = $dati['related_id'];
        }

        if ($_SESSION['level'] >= 3) {
            $utente_abilitato = 0;

            $query = "SELECT abilitato FROM hotel WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id_hotel, PDO::PARAM_INT);
            $stmt->execute();
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $utente_abilitato = $dati['abilitato'];

            $pro = $_SESSION['level'];
        }

        $query = "DELETE FROM servizi WHERE hotel_associato = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_hotel, PDO::PARAM_INT);
        $stmt->execute();

        $lingue = getLangsShortcode($dbh);

        for ($i = 0; $i < sizeof($lingue); $i++) {

            //Controllo se esiste già un record per questo hotel con la lingua attualmente utilizzata dal ciclo
            $query = "SELECT id FROM hotel WHERE shortcode_lingua = ? AND related_id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
            $stmt->bindParam(2, $id_hotel, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {

                $shortcode_lingua = $lingue[$i]['shortcode_lingua'];
                $query = "UPDATE hotel SET nome = ?,email = ?,sito_web = ?,telefono = ?,indirizzo = ?,latitudine = ?,longitudine = ?,abilitato = ?,livello = ?,descrizione_ospiti = ?,immagini_secondarie = ?,shortcode_lingua = ?,immagine_principale = ? WHERE related_id = ? AND shortcode_lingua = ?";
                $stmt = $dbh->prepare($query);
                //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt->bindParam(1, $nome, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $sito, PDO::PARAM_STR);
                $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
                $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
                $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
                $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
                $stmt->bindParam(8, $utente_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(9, $pro, PDO::PARAM_INT);
                $stmt->bindParam(10, $descrizioni_ospiti[$i], PDO::PARAM_STR);
                $stmt->bindParam(11, $path_imgs_hotel, PDO::PARAM_STR);
                $stmt->bindParam(12, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                $stmt->bindParam(13, $default_image, PDO::PARAM_STR);
                $stmt->bindParam(14, $id_hotel, PDO::PARAM_INT);
                $stmt->bindParam(15, $lingue[$i]['shortcode_lingua'], PDO::PARAM_STR);
                $stmt->execute();
            } else {
                //In questo caso il record non esiste, dunque aggiungo un nuovo record per la lingua attualmente utilizata dal ciclo
                $query = "INSERT INTO hotel (nome,email,sito_web,telefono,indirizzo,latitudine,longitudine,password,abilitato,livello,descrizione_ospiti,immagini_secondarie,shortcode_lingua,immagine_principale,related_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $dbh->prepare($query);
                //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt->bindParam(1, $nome, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $sito, PDO::PARAM_STR);
                $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
                $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
                $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
                $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
                $stmt->bindParam(8, $password, PDO::PARAM_STR);
                $stmt->bindParam(9, $utente_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(10, $pro, PDO::PARAM_INT);
                $stmt->bindParam(11, $descrizioni_ospiti[$i], PDO::PARAM_STR);
                $stmt->bindParam(12, $path_imgs_hotel, PDO::PARAM_STR);
                $stmt->bindParam(13, $shortcode_lingua, PDO::PARAM_INT);
                $stmt->bindParam(14, $default_image, PDO::PARAM_STR);
                $stmt->bindParam(15, $id_hotel, PDO::PARAM_INT);
                $stmt->execute();
            }
        }

        //Aggiungo i servizi
        for ($i = 0; $i < sizeof($lingue); $i++) {

            $nome_servizio = explode("||", $nomi_servizi[$i]);
            $nome_servizio = $nome_servizio[$i]; //in lingua corrente

            for ($z = 0; $z < sizeof($descrizioni_servizi); $z++) {
                $descrizione_servizio = $descrizioni_servizi[$z];
                $descrizione_servizio = explode("||", $descrizione_servizio);
                //echo '<br/>servizio '.$z.' lang '.$i.' ->'.$descrizione_servizio[$i];
            }

            for ($z = 0; $z < sizeof($nomi_servizi); $z++) {
                $nome_servizio = $nomi_servizi[$z];
                $nome_servizio = explode("||", $nome_servizio);
                //echo '<br/>servizio '.$z.' lang '.$i.' ->'.$nome_servizio[$i];
            }

            //echo $descrizioni_servizi[$i];
            //echo '<br/>'.$nome_servizio.'<br/>';
            //echo $nome_servizio;

            for ($z = 0; $z < $num_services; $z++) {

                $is_abilitato = explode("||", $abilitato[$z]);
                $is_abilitato = $is_abilitato[0];

                $descrizione_servizio = $descrizioni_servizi[$z];
                $descrizione_servizio = explode("||", $descrizione_servizio);

                $nome_servizio = $nomi_servizi[$z];
                $nome_servizio = explode("||", $nome_servizio);

                $query = "INSERT INTO servizi (hotel_associato,titolo,descrizione,lunedi,martedi,mercoledi,giovedi,venerdi,sabato,domenica,immagine,abilitato,shortcode_lingua) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $dbh->prepare($query);
                //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt->bindParam(1, $id_hotel, PDO::PARAM_INT);
                $stmt->bindParam(2, $nome_servizio[$i], PDO::PARAM_STR);
                $stmt->bindParam(3, $descrizione_servizio[$i], PDO::PARAM_STR);
                $stmt->bindParam(4, $lunedi[$z + 1], PDO::PARAM_STR);
                $stmt->bindParam(5, $martedi[$z + 1], PDO::PARAM_STR);
                $stmt->bindParam(6, $mercoledi[$z + 1], PDO::PARAM_STR);
                $stmt->bindParam(7, $giovedi[$z + 1], PDO::PARAM_STR);
                $stmt->bindParam(8, $venerdi[$z + 1], PDO::PARAM_STR);
                $stmt->bindParam(9, $sabato[$z + 1], PDO::PARAM_STR);
                $stmt->bindParam(10, $domenica[$z + 1], PDO::PARAM_STR);
                $stmt->bindParam(11, $immagine_servizio[$z], PDO::PARAM_STR);
                $stmt->bindParam(12, $is_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(13, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                $stmt->execute();
            }
        }

        if ($_SESSION['level'] <= 2) {
            $da = 0;
            $a = $email;
            $tipo = 1;
        } else {
            $a = 0;
            $da = $_SESSION['id_user'];
            $tipo = 0;
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $nome;
        }

        $query = "INSERT INTO notifiche (da,a,tipo,data,letto) VALUES (?,?,?,?,0)";
        $stmt = $dbh->prepare($query);
        $today = date('d/m/Y H:i');

        $stmt->bindParam(1, $da, PDO::PARAM_STR);
        $stmt->bindParam(2, $a, PDO::PARAM_STR);
        $stmt->bindParam(3, $tipo, PDO::PARAM_INT);
        $stmt->bindParam(4, $today, PDO::PARAM_STR);
        $stmt->execute();
    }


    function addHotel($dbh, $nome, $email, $sito, $telefono, $indirizzo, $latitudine, $longitudine, $password, $utente_abilitato, $pro, $num_services, $descrizioni_ospiti, $nomi_servizi, $abilitato, $descrizioni_servizi, $immagine_servizio, $lunedi, $martedi, $mercoledi, $giovedi, $venerdi, $sabato, $domenica, $immagini_hotel, $default_image)
    {


        $query = "SELECT id FROM hotel WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $path_imgs_hotel = '';
            for ($i = 0; $i < sizeof($immagini_hotel); $i++) {
                $path_imgs_hotel .= $immagini_hotel[$i] . '|';
            }

            $lingue = getLangsShortcode($dbh);

            if ($i == 0)
                $related_id = null;

            for ($i = 0; $i < sizeof($lingue); $i++) {
                $shortcode_lingua = $lingue[$i]['shortcode_lingua'];

                $query = "INSERT INTO hotel (nome,email,sito_web,telefono,indirizzo,latitudine,longitudine,password,abilitato,livello,descrizione_ospiti,immagini_secondarie,shortcode_lingua,immagine_principale,related_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $dbh->prepare($query);
                //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt->bindParam(1, $nome, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $sito, PDO::PARAM_STR);
                $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
                $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
                $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
                $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
                $stmt->bindParam(8, $password, PDO::PARAM_STR);
                $stmt->bindParam(9, $utente_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(10, $pro, PDO::PARAM_INT);
                $stmt->bindParam(11, $descrizioni_ospiti[$i], PDO::PARAM_STR);
                $stmt->bindParam(12, $path_imgs_hotel, PDO::PARAM_STR);
                $stmt->bindParam(13, $shortcode_lingua, PDO::PARAM_INT);
                $stmt->bindParam(14, $default_image, PDO::PARAM_STR);
                $stmt->bindParam(15, $related_id, PDO::PARAM_INT);
                $stmt->execute();

                //Recupero l'id del primo inserito, da usare come relativo.
                if ($i == 0) {
                    $query = "SELECT id FROM hotel WHERE email = ? ORDER BY id ASC LIMIT 1";
                    $stmt = $dbh->prepare($query);
                    $stmt->bindParam(1, $email, PDO::PARAM_STR);
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                        $related_id = $dati['id'];
                    }

                    $query = "UPDATE hotel SET related_id = ? WHERE id = ?";
                    $stmt = $dbh->prepare($query);
                    $stmt->bindParam(1, $related_id, PDO::PARAM_INT);
                    $stmt->bindParam(2, $related_id, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }

            //Aggiungo i servizi
            for ($i = 0; $i < sizeof($lingue); $i++) {

                $nome_servizio = explode("||", $nomi_servizi[$i]);
                $nome_servizio = $nome_servizio[$i]; //in lingua corrente

                for ($z = 0; $z < sizeof($descrizioni_servizi); $z++) {
                    $descrizione_servizio = $descrizioni_servizi[$z];
                    $descrizione_servizio = explode("||", $descrizione_servizio);
                    //echo '<br/>servizio '.$z.' lang '.$i.' ->'.$descrizione_servizio[$i];
                }

                for ($z = 0; $z < sizeof($nomi_servizi); $z++) {
                    $nome_servizio = $nomi_servizi[$z];
                    $nome_servizio = explode("||", $nome_servizio);
                    //echo '<br/>servizio '.$z.' lang '.$i.' ->'.$nome_servizio[$i];
                }

                //echo $descrizioni_servizi[$i];
                //echo '<br/>'.$nome_servizio.'<br/>';
                //echo $nome_servizio;

                for ($z = 0; $z < $num_services; $z++) {

                    $is_abilitato = explode("||", $abilitato[$z]);
                    $is_abilitato = $is_abilitato[0];

                    $descrizione_servizio = $descrizioni_servizi[$z];
                    $descrizione_servizio = explode("||", $descrizione_servizio);

                    $nome_servizio = $nomi_servizi[$z];
                    $nome_servizio = explode("||", $nome_servizio);

                    $query = "INSERT INTO servizi (hotel_associato,titolo,descrizione,lunedi,martedi,mercoledi,giovedi,venerdi,sabato,domenica,immagine,abilitato,shortcode_lingua) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt = $dbh->prepare($query);
                    //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt->bindParam(1, $related_id, PDO::PARAM_INT);
                    $stmt->bindParam(2, $nome_servizio[$i], PDO::PARAM_STR);
                    $stmt->bindParam(3, $descrizione_servizio[$i], PDO::PARAM_STR);
                    $stmt->bindParam(4, $lunedi[$z + 1], PDO::PARAM_STR);
                    $stmt->bindParam(5, $martedi[$z + 1], PDO::PARAM_STR);
                    $stmt->bindParam(6, $mercoledi[$z + 1], PDO::PARAM_STR);
                    $stmt->bindParam(7, $giovedi[$z + 1], PDO::PARAM_STR);
                    $stmt->bindParam(8, $venerdi[$z + 1], PDO::PARAM_STR);
                    $stmt->bindParam(9, $sabato[$z + 1], PDO::PARAM_STR);
                    $stmt->bindParam(10, $domenica[$z + 1], PDO::PARAM_STR);
                    $stmt->bindParam(11, $immagine_servizio[$z], PDO::PARAM_STR);
                    $stmt->bindParam(12, $is_abilitato, PDO::PARAM_INT);
                    $stmt->bindParam(13, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
        } else echo 'exists';
    }


    function getHotel($dbh, $param)
    {
        $query = "SELECT * FROM hotel WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $param, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $key => $value) {
                $result[$key] = $value;
            }
            return $result;
        }
    }

    function getHotelLang($dbh, $email, $id_lang)
    {
        $query = "SELECT * FROM hotel WHERE email = ? AND shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->bindParam(2, $id_lang, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $key => $value) {
                $result[$key] = $value;
            }
            return $result;
        }
    }


    function getDatiHotelLang($dbh, $email, $lang)
    {
        $query = "SELECT * FROM hotel WHERE email = ? AND shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params, PDO::PARAM_INT);
        $stmt->bindParam(2, $lang, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $key => $value) {
                $result[$key] = $value;
            }
            return $result;
        }

    }


    function getDatiServizi($dbh, $id_hotel, $lang)
    {
        $query = "SELECT * FROM servizi WHERE hotel_associato = ? AND shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_hotel, PDO::PARAM_INT);
        $stmt->bindParam(2, $lang, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['titolo'] = $dati['titolo'];
                $result[$i]['descrizione'] = $dati['descrizione'];
                $result[$i]['lunedi'] = $dati['lunedi'];
                $result[$i]['martedi'] = $dati['martedi'];
                $result[$i]['mercoledi'] = $dati['mercoledi'];
                $result[$i]['giovedi'] = $dati['giovedi'];
                $result[$i]['venerdi'] = $dati['venerdi'];
                $result[$i]['sabato'] = $dati['sabato'];
                $result[$i]['domenica'] = $dati['domenica'];
                $result[$i]['immagine'] = $dati['immagine'];
                $result[$i]['abilitato'] = $dati['abilitato'];
                $i++;
            }
            return $result;
        }

    }


    function getDatiEccellenze($dbh, $id_hotel, $lang)
    {
        $query = "SELECT * FROM eccellenze WHERE struttura_collegata = ? AND shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_hotel, PDO::PARAM_INT);
        $stmt->bindParam(2, $lang, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['titolo'] = $dati['titolo'];
                $result[$i]['testo'] = $dati['testo'];
                $result[$i]['immagine'] = $dati['immagine'];
                $result[$i]['abilitato'] = $dati['abilitato'];
                $i++;
            }
            return $result;
        }

    }


    function getNumServices($dbh, $id)
    {

        $query = "SELECT * FROM servizi WHERE hotel_associato = ? AND shortcode_lingua = 1";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    function getNumEccellenze($dbh, $id)
    {
        $query = "SELECT * FROM eccellenze WHERE struttura_collegata = ? AND shortcode_lingua = 1";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }


    function getNotifications($dbh)
    {
        if ($_SESSION['level'] <= 2)
            $to = 0;
        else
            $to = $_SESSION['email'];

        $query = "SELECT * FROM notifiche WHERE a = ? ORDER BY id ASC";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $to, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['id'] = $dati['id'];
                $result[$i]['da'] = $dati['da'];
                $result[$i]['tipo'] = $dati['tipo'];
                $result[$i]['data'] = $dati['data'];
                $result[$i]['letto'] = $dati['letto'];
                $i++;
            }
        } else $result = null;
        return $result;
    }


    function delNotifica($dbh, $id_notifica)
    {
        $query = "DELETE FROM notifiche WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_notifica, PDO::PARAM_STR);
        $stmt->execute();
        $result = 'success';

        return $result;
    }


    function addCategory($dbh, $params)
    {
        $img = $params[0];
        $lingue = getLangsShortcode($dbh);
        $related_id = '';
        for ($i = 0; $i < sizeof($lingue); $i++) {

            $shortcode = $lingue[$i]['shortcode_lingua'];

            if ($i == 0) {
                $query = "INSERT INTO categorie_strutture (nome,immagine,abilitata,shortcode_lingua) VALUES (?,?,0,?)";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $params[$lingue[$i]['shortcode_lingua']], PDO::PARAM_STR);
                $stmt->bindParam(2, $img, PDO::PARAM_STR);
                $stmt->bindParam(3, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                $stmt->execute();

                $query = "SELECT * FROM categorie_strutture ORDER BY id DESC LIMIT 1";
                $stmt = $dbh->query($query);
                if ($stmt->rowCount() > 0) {
                    $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                    $related_id = $dati['id'];

                    $query = "UPDATE categorie_strutture SET related_id = ? WHERE id = ?";
                    $stmt = $dbh->prepare($query);
                    $stmt->bindParam(1, $related_id, PDO::PARAM_INT);
                    $stmt->bindParam(2, $related_id, PDO::PARAM_INT);
                    $stmt->execute();

                }


            } else {
                $query = "INSERT INTO categorie_strutture (nome,immagine,abilitata,shortcode_lingua,related_id) VALUES (?,?,0,?,?)";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $params[$lingue[$i]['shortcode_lingua']], PDO::PARAM_STR);
                $stmt->bindParam(2, $img, PDO::PARAM_STR);
                $stmt->bindParam(3, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                $stmt->bindParam(4, $related_id, PDO::PARAM_INT);
                $stmt->execute();
            }


            $result = 'success';
        }
        return $result;
    }

    function updateCategory($dbh, $params)
    {
        $img = $params[0];
        $lingue = getLangsShortcode($dbh);
        $params_size = sizeof($params);
        $lingue_size = sizeof($lingue);
        for ($i = 0; $i < sizeof($lingue); $i++) {
            $shortcode = $lingue[$i]['shortcode_lingua'];
            $query = "UPDATE categorie_strutture SET nome = ?, immagine = ? WHERE related_id = ? AND shortcode_lingua = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $params[$i], PDO::PARAM_STR);
            $stmt->bindParam(2, $params[$params_size - 2], PDO::PARAM_STR);
            $stmt->bindParam(3, $params[$params_size - 1], PDO::PARAM_INT);
            $stmt->bindParam(4, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
            $stmt->execute();
            $result = 'success';
        }
        return $result;
    }

    function delCategory($dbh, $id_categoria)
    {
        $query = "SELECT * FROM categorie_strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $immagine = $dati['immagine'];
            }
            $query = "DELETE FROM categorie_strutture WHERE immagine = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $immagine, PDO::PARAM_STR);
            $stmt->execute();
            $result = 'success';
        } else $result = 'error';

        return $result;
    }


    function addGuest($dbh, $params)
    {
        session_start();
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO ospiti_hotel (nome,cognome,telefono,email,data_checkin,data_checkout,hotel_associato,numero_ospiti,password,abilitato,numero_stanza) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        if ($_SESSION['super_level'] == true)
            $id_user = 0;
        else
            $id_user = $_SESSION['id_user'];


        $password = md5($params[7]);
        if (empty($params[7]))
            $password = mt_rand(100000, 999999);

        $checkin = date("d-m-Y", strtotime($params[2]));
        $checkout = date("d-m-Y", strtotime($params[3]));
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
        $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
        $stmt->bindParam(3, $params[6], PDO::PARAM_STR);
        $stmt->bindParam(4, $params[5], PDO::PARAM_STR);
        $stmt->bindParam(5, $checkin, PDO::PARAM_STR);
        $stmt->bindParam(6, $checkout, PDO::PARAM_STR);
        $stmt->bindParam(7, $id_user, PDO::PARAM_INT);
        $stmt->bindParam(8, $params[4], PDO::PARAM_INT);
        $stmt->bindParam(9, $password, PDO::PARAM_STR);
        $stmt->bindParam(10, $params[9], PDO::PARAM_INT);
        $stmt->bindParam(11, $params[10], PDO::PARAM_INT);

        $stmt->execute();

        $link = 'wellcox.cluster031.hosting.ovh.net/index?strh=' . $id_user;

        /*
            //invio la mail con il codice di recupero
            require_once 'vendor/autoload.php';

            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
              ->setUsername('your username')
              ->setPassword('your password')
            ;

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message('OGGETTO QUI'))
              ->setFrom(['john@doe.com' => 'John Doe'])
              ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
              ->setBody('MESSAGGIO E LINK QUI '.$link)
              ;

            // Send the message
            $result = $mailer->send($message);

            */

    }

    function updateGuest($dbh, $params)
    {
        session_start();

        if (strlen($params[7]) != 0) {
            $query = "UPDATE ospiti_hotel SET nome = ?, cognome = ?, telefono = ?, email = ?, data_checkin = ?, data_checkout = ?, hotel_associato = ?, numero_ospiti = ?, password = ?, abilitato = ?, numero_stanza = ? WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $id_user = $_SESSION['id_user'];
            $password = md5($params[7]);
            $checkin = date("d-m-Y", strtotime($params[2]));
            $checkout = date("d-m-Y", strtotime($params[3]));
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
            $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
            $stmt->bindParam(3, $params[6], PDO::PARAM_STR);
            $stmt->bindParam(4, $params[5], PDO::PARAM_STR);
            $stmt->bindParam(5, $checkin, PDO::PARAM_STR);
            $stmt->bindParam(6, $checkout, PDO::PARAM_STR);
            $stmt->bindParam(7, $id_user, PDO::PARAM_INT);
            $stmt->bindParam(8, $params[4], PDO::PARAM_INT);
            $stmt->bindParam(9, $password, PDO::PARAM_STR);
            $stmt->bindParam(10, $params[9], PDO::PARAM_INT);
            $stmt->bindParam(11, $params[10], PDO::PARAM_STR);
            $stmt->bindParam(12, $params[11], PDO::PARAM_INT);
        } else {
            $query = "UPDATE ospiti_hotel SET nome = ?, cognome = ?, telefono = ?, email = ?, data_checkin = ?, data_checkout = ?, hotel_associato = ?, numero_ospiti = ?, abilitato = ?, numero_stanza = ? WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $id_user = $_SESSION['id_user'];
            $checkin = date("d-m-Y", strtotime($params[2]));
            $checkout = date("d-m-Y", strtotime($params[3]));
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $params[0], PDO::PARAM_STR);
            $stmt->bindParam(2, $params[1], PDO::PARAM_STR);
            $stmt->bindParam(3, $params[6], PDO::PARAM_STR);
            $stmt->bindParam(4, $params[5], PDO::PARAM_STR);
            $stmt->bindParam(5, $checkin, PDO::PARAM_STR);
            $stmt->bindParam(6, $checkout, PDO::PARAM_STR);
            $stmt->bindParam(7, $id_user, PDO::PARAM_INT);
            $stmt->bindParam(8, $params[4], PDO::PARAM_INT);
            $stmt->bindParam(9, $params[9], PDO::PARAM_INT);
            $stmt->bindParam(10, $params[10], PDO::PARAM_STR);
            $stmt->bindParam(11, $params[11], PDO::PARAM_INT);
        }
        $stmt->execute();


        /*
            //invio la mail con il codice di recupero
            require_once 'vendor/autoload.php';

            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
              ->setUsername('your username')
              ->setPassword('your password')
            ;

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message('Wonderful Subject'))
              ->setFrom(['john@doe.com' => 'John Doe'])
              ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
              ->setBody('Here is the message itself')
              ;

            // Send the message
            $result = $mailer->send($message);

            */


        return ('success');
    }


    function enableGuest($dbh, $id_guest)
    {
        $query = "UPDATE ospiti_hotel SET abilitato = 1 WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_guest, PDO::PARAM_INT);
        $stmt->execute();
        return ("success");
    }

    function disableGuest($dbh, $id_guest)
    {
        $query = "UPDATE ospiti_hotel SET abilitato = 0 WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_guest, PDO::PARAM_INT);
        $stmt->execute();
        return ("success");
    }


    function getHotelAssociati($dbh, $id_struttura)
    {
        $query = "SELECT * FROM strutture_hotel WHERE id_struttura = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['id_hotel'] = $dati['id_hotel'];
                $query_bis = "SELECT nome,id FROM hotel WHERE id = ?";
                $stmt_bis = $dbh->prepare($query_bis);
                $stmt_bis->bindParam(1, $dati['id_hotel'], PDO::PARAM_INT);
                $stmt_bis->execute();
                if ($stmt_bis->rowCount() > 0) {
                    while ($dati_bis = $stmt_bis->fetch(PDO::FETCH_ASSOC)) {
                        $result[$i]['nome'] = $dati_bis['nome'];
                        $result[$i]['id'] = $dati_bis['id'];
                    }
                }
                $i++;
            }
        } else $result = 'error';

        return $result;
    }

    function delRelatedHotel($dbh, $params)
    {
        $params = explode(",", $params);
        $id_struttura = $params[0];
        $id_hotel = $params[1];
        $query = "DELETE FROM strutture_hotel WHERE id_struttura = ? AND id_hotel = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_hotel, PDO::PARAM_INT);
        $stmt->execute();
        return 'success';
    }

    function delStruttura($dbh, $id)
    {

        $query = "SELECT email,indirizzo_struttura FROM strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $email = $dati['email'];
                $indirizzo_struttura = $dati['indirizzo_struttura'];

                $query = "DELETE FROM strutture WHERE email = ? AND indirizzo_struttura = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $email, PDO::PARAM_STR);
                $stmt->bindParam(2, $indirizzo_struttura, PDO::PARAM_STR);
                $stmt->execute();
                return ("success");
            }
        } else return ("error");
    }


    function getCategoria($dbh, $id, $id_lang)
    {
        $query = "SELECT * FROM categorie_strutture WHERE related_id = ? AND shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->bindParam(2, $id_lang, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result['id'] = $dati['id'];
                $result['nome'] = $dati['nome'];
                $result['immagine'] = $dati['immagine'];
                $result['slug'] = $dati['slug'];
                $result['abilitata'] = $dati['abilitata'];
                $result['related_id'] = $dati['related_id'];
            }
            return $result;
        } else return ('error');
    }


    function getCategoriaByID($dbh, $id)
    {
        $query = "SELECT * FROM categorie_strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result['nome'] = $dati['nome'];
                $result['immagine'] = $dati['immagine'];
                $result['slug'] = $dati['slug'];
                $result['abilitata'] = $dati['abilitata'];
            }
            return $result;
        } else return ('error');
    }

    function getGuestsRow($dbh, $params)
    {
        $query = "SELECT * FROM ospiti_hotel WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $key => $value) {
                $result[$key] = $value;
            }
        } else $result = 'error';
        return $result;
    }


    function delEvento($dbh, $params)
    {
        $query = "DELETE FROM eventi WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params, PDO::PARAM_INT);
        $stmt->execute();


        $query = "DELETE FROM strutture_eventi WHERE id_evento = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params, PDO::PARAM_INT);
        $stmt->execute();

        $result = 'success';
        return $result;
    }


    function enableEvento($dbh, $params)
    {
        $query = "UPDATE eventi SET abilitato = 1 WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params, PDO::PARAM_INT);
        $stmt->execute();
        $result = 'success';
        return $result;
    }


    function disableEvento($dbh, $params)
    {
        $query = "UPDATE eventi SET abilitato = 0 WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params, PDO::PARAM_INT);
        $stmt->execute();
        $result = 'success';
        return $result;
    }


    function enableStruttura($dbh, $params)
    {
        $query = "SELECT email FROM strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $email = $dati['email'];
            }
        }


        $query = "UPDATE strutture SET abilitata = 1 WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = 'success';
        return $result;
    }


    function disableStruttura($dbh, $params)
    {
        $query = "SELECT email FROM strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $params, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $email = $dati['email'];
            }
        }


        $query = "UPDATE strutture SET abilitata = 0 WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = 'success';
        return $result;
    }

    function getStruttureHotel($dbh)
    {
        if ($_SESSION['level'] <= 2) {
            $query = "SELECT * FROM hotel WHERE shortcode_lingua = ? ORDER BY nome ASC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $_SESSION['lang'], PDO::PARAM_INT);
        } else {
            $query = "SELECT * FROM hotel WHERE shortcode_lingua = ? AND email = ? ORDER BY nome ASC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $_SESSION['lang'], PDO::PARAM_INT);
            if ($_SESSION['super_level'] == true) {
                $email = 'info@hotellondon.co.uk'; //per i test
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(2, $_SESSION['email'], PDO::PARAM_STR);
            }
        }

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['related_id'] = $dati['related_id'];
                $result[$i]['id'] = $dati['id'];
                $result[$i]['nome'] = $dati['nome'];
                $result[$i]['email'] = $dati['email'];
                $result[$i]['indirizzo'] = $dati['indirizzo'];
                $i++;
            }
            return $result;
        } else return ('error');
    }

    function getElencoStrutture($dbh)
    {
        session_start();
        if ($_SESSION['level'] <= 2) {
            $query = "SELECT * FROM strutture WHERE shortcode_lingua = ? ORDER BY nome_struttura ASC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $_SESSION['lang'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $i = 0;
                while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $result[$i]['nome'] = $dati['nome_struttura'];
                    $result[$i]['id'] = $dati['id'];
                    $result[$i]['email'] = $dati['email'];
                    $result[$i]['indirizzo'] = $dati['indirizzo'];
                    $i++;
                }
                return $result;
            }
        } else {
            $query = "SELECT * FROM strutture WHERE shortcode_lingua = ? ORDER BY nome_struttura ASC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $_SESSION['lang'], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $i = 0;
                while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($dati['created_by'] == $_SESSION['id_user']) {
                        $result[$i]['nome'] = $dati['nome_struttura'];
                        $result[$i]['id'] = $dati['id'];
                        $result[$i]['email'] = $dati['email'];
                        $result[$i]['indirizzo'] = $dati['indirizzo'];
                        $i++;
                    } else {
                        $query_bis = "SELECT * FROM strutture_hotel WHERE id_struttura = ? AND id_hotel = ?";
                        $stmt_bis = $dbh->prepare($query_bis);
                        $stmt_bis->bindParam(1, $dati['id'], PDO::PARAM_INT);
                        $stmt_bis->bindParam(2, $_SESSION['id_user'], PDO::PARAM_INT);
                        $stmt_bis->execute();
                        if ($stmt_bis->rowCount() > 0) {
                            $result[$i]['nome'] = $dati['nome_struttura'];
                            $result[$i]['id'] = $dati['id'];
                            $result[$i]['email'] = $dati['email'];
                            $result[$i]['indirizzo'] = $dati['indirizzo'];
                            $i++;
                        }
                    }
                }
                return $result;
            } else return ("error");
        }
    }


    function addStruttura($dbh, $nome, $email, $telefono, $sito, $indirizzo, $latitudine, $longitudine, $utente_abilitato, $num_eccellenze, $descrizioni_normali, $descrizione_benefit, $nomi_eccellenza, $abilitato, $descrizioni_eccellenza, $immagine_eccellenze, $lunedi, $martedi, $mercoledi, $giovedi, $venerdi, $sabato, $domenica, $immagini_hotel, $default_image, $hotel_associati, $categorie_associate, $indicizza, $convenzionato, $immagini_didascalia, $testi_didascalia, $tipo_viaggio)
    {
        $path_imgs_hotel = '';
        session_start();

        for ($i = 0; $i < sizeof($immagini_hotel); $i++) {
            $path_imgs_hotel .= $immagini_hotel[$i] . '|';
        }
        for ($i = 0; $i < sizeof($immagini_didascalia); $i++) {
            $path_imgs_didascalia .= $immagini_didascalia[$i] . '|';
        }


        $lingue = getLangsShortcode($dbh);
        for ($i = 0; $i < sizeof($lingue); $i++) {
            echo 'SUPER-' . $i;
            $shortcode_lingua = $lingue[$i]['shortcode_lingua'];
            echo "INSERISCO";

            if ($_SESSION['level'] > 2) {
                $query = "INSERT INTO strutture (nome_struttura,email,sito_web,telefono,indirizzo_struttura,latitudine,longitudine,abilitata,descrizione,descrizione_benefit,immagine_didascalia,shortcode_lingua,immagine_principale,indicizza,orari_lunedi,orari_martedi,orari_mercoledi,orari_giovedi,orari_venerdi,orari_sabato,orari_domenica,created_by,real_immagini_didascalia,real_path_immagini_didascalia,convenzionato,tipo_viaggio) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $nome, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $sito, PDO::PARAM_STR);
                $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
                $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
                $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
                $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
                $stmt->bindParam(8, $utente_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(9, $descrizioni_normali[$i], PDO::PARAM_STR);
                $stmt->bindParam(10, $descrizione_benefit[$i], PDO::PARAM_STR);
                $stmt->bindParam(11, $path_imgs_hotel, PDO::PARAM_STR);
                $stmt->bindParam(12, $shortcode_lingua, PDO::PARAM_INT);
                $stmt->bindParam(13, $default_image, PDO::PARAM_STR);
                $stmt->bindParam(14, $indicizza, PDO::PARAM_INT);
                $stmt->bindParam(15, $lunedi[1], PDO::PARAM_STR);
                $stmt->bindParam(16, $martedi[1], PDO::PARAM_STR);
                $stmt->bindParam(17, $mercoledi[1], PDO::PARAM_STR);
                $stmt->bindParam(18, $giovedi[1], PDO::PARAM_STR);
                $stmt->bindParam(19, $venerdi[1], PDO::PARAM_STR);
                $stmt->bindParam(20, $sabato[1], PDO::PARAM_STR);
                $stmt->bindParam(21, $domenica[1], PDO::PARAM_STR);
                $stmt->bindParam(22, $created_by, PDO::PARAM_INT);
                $stmt->bindParam(23, $path_imgs_didascalia, PDO::PARAM_STR);
                $stmt->bindParam(24, $testi_didascalia, PDO::PARAM_STR);
                $stmt->bindParam(25, $convenzionato, PDO::PARAM_INT);
                $stmt->bindParam(26, $tipo_viaggio, PDO::PARAM_INT);
            } else {
                $query = "INSERT INTO strutture (nome_struttura,email,sito_web,telefono,indirizzo_struttura,latitudine,longitudine,abilitata,descrizione,immagine_didascalia,shortcode_lingua,immagine_principale,indicizza,orari_lunedi,orari_martedi,orari_mercoledi,orari_giovedi,orari_venerdi,orari_sabato,orari_domenica,created_by,real_immagini_didascalia,real_path_immagini_didascalia,convenzionato,tipo_viaggio) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $nome, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $sito, PDO::PARAM_STR);
                $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
                $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
                $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
                $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
                $stmt->bindParam(8, $utente_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(9, $descrizioni_normali[$i], PDO::PARAM_STR);
                $stmt->bindParam(10, $path_imgs_hotel, PDO::PARAM_STR);
                $stmt->bindParam(11, $shortcode_lingua, PDO::PARAM_INT);
                $stmt->bindParam(12, $default_image, PDO::PARAM_STR);
                $stmt->bindParam(13, $indicizza, PDO::PARAM_INT);
                $stmt->bindParam(14, $lunedi[1], PDO::PARAM_STR);
                $stmt->bindParam(15, $martedi[1], PDO::PARAM_STR);
                $stmt->bindParam(16, $mercoledi[1], PDO::PARAM_STR);
                $stmt->bindParam(17, $giovedi[1], PDO::PARAM_STR);
                $stmt->bindParam(18, $venerdi[1], PDO::PARAM_STR);
                $stmt->bindParam(19, $sabato[1], PDO::PARAM_STR);
                $stmt->bindParam(20, $domenica[1], PDO::PARAM_STR);
                $stmt->bindParam(21, $created_by, PDO::PARAM_INT);
                $stmt->bindParam(22, $path_imgs_didascalia, PDO::PARAM_STR);
                $stmt->bindParam(23, $testi_didascalia, PDO::PARAM_STR);
                $stmt->bindParam(24, $convenzionato, PDO::PARAM_INT);
                $stmt->bindParam(25, $tipo_viaggio, PDO::PARAM_INT);
            }

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (isset($_SESSION['level']) && $_SESSION['level'] <= 2)
                $created_by = 0;
            else
                $created_by = $_SESSION['id_user'];


            $stmt->execute();

            if ($i == 0) {
                $query = "SELECT id FROM strutture WHERE email = ? AND indirizzo_struttura = ? ORDER BY id DESC LIMIT 1";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $email, PDO::PARAM_STR);
                $stmt->bindParam(2, $indirizzo, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                    $id = $dati['id'];
                }
            }


        }


        $query = "UPDATE strutture SET related_id = ? WHERE email = ? AND indirizzo_struttura = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $indirizzo, PDO::PARAM_STR);
        $stmt->execute();

        for ($i = 0; $i < sizeof($hotel_associati); $i++) {
            $query = "INSERT INTO strutture_hotel (id_struttura,id_hotel,convenzionato) VALUES (?,?,?)";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $hotel_associati[$i], PDO::PARAM_INT);
            $stmt->bindParam(3, $convenzionato, PDO::PARAM_INT);
            $stmt->execute();
        }
        for ($i = 0; $i < sizeof($categorie_associate); $i++) {
            $query = "SELECT * FROM categorie_strutture WHERE id = ? ORDER BY id ASC";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $categorie_associate[$i], PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_ita = $dati['related_id'];
            }

            $query = "INSERT INTO strutture_categorie (id_struttura,id_categoria,email_struttura) VALUES (?,?,?)";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $id_ita, PDO::PARAM_INT);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->execute();
        }
        //Aggiungo i servizi
        for ($i = 0; $i < sizeof($lingue); $i++) {


            $is_abilitato = explode("||", $abilitato[$i]);
            $is_abilitato = $is_abilitato[$i]; //in lingua corrente
            echo '<br/>' . $is_abilitato;

            for ($z = 0; $z < sizeof($descrizioni_eccellenza); $z++) {
                $descrizione_servizio = $descrizioni_eccellenza[$z];
                $descrizione_servizio = explode("||", $descrizione_servizio);
                echo '<br/>servizio ' . $z . ' lang ' . $i . ' ->' . $descrizione_servizio[$i];
            }

            for ($z = 0; $z < sizeof($nomi_eccellenza); $z++) {
                $nome_servizio = $nomi_eccellenza[$z];
                $nome_servizio = explode("||", $nome_servizio);
                echo '<br/>servizio ' . $z . ' lang ' . $i . ' ->' . $nome_servizio[$i];
            }

            for ($z = 0; $z < $num_eccellenze; $z++) {


                $descrizione_servizio = $descrizioni_eccellenza[$z];
                $descrizione_servizio = explode("||||", $descrizione_servizio);

                $nome_servizio = $nomi_eccellenza[$z];
                $nome_servizio = explode("||", $nome_servizio);


                $is_abilitato = explode("||", $abilitato[$z]);
                $is_abilitato = $is_abilitato[$z]; //in lingua corrente


                $query = "INSERT INTO eccellenze (struttura_collegata,titolo,testo,immagine,abilitato,shortcode_lingua) VALUES (?,?,?,?,?,?)";
                $stmt = $dbh->prepare($query);
                $is_abilitato = 1;
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->bindParam(2, $nome_servizio[$i], PDO::PARAM_STR);
                $stmt->bindParam(3, $descrizione_servizio[$i], PDO::PARAM_STR);
                $stmt->bindParam(4, $immagine_eccellenze[$z], PDO::PARAM_STR);
                $stmt->bindParam(5, $is_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(6, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                $stmt->execute();


            }
        }
    }


    function getDatiStruttura($dbh, $id)
    {
        $query = "SELECT * FROM strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['id'] = $dati['id'];
                $result[$i]['nome_struttura'] = $dati['nome_struttura'];
                $result[$i]['abilitata'] = $dati['abilitata'];
                $result[$i]['indicizza'] = $dati['indicizza'];
                $result[$i]['indirizzo_struttura'] = $dati['indirizzo_struttura'];
                $result[$i]['immagine_principale'] = $dati['immagine_principale'];
                $result[$i]['immagine_didascalia'] = $dati['immagine_didascalia'];
                $result[$i]['email'] = $dati['email'];
                $result[$i]['sito_web'] = $dati['sito_web'];
                $result[$i]['telefono'] = $dati['telefono'];
                $result[$i]['convenzionato'] = $dati['convenzionato'];
                $result[$i]['descrizione'] = $dati['descrizione'];
                $result[$i]['descrizione_benefit'] = $dati['descrizione_benefit'];
                $result[$i]['latitudine'] = $dati['latitudine'];
                $result[$i]['longitudine'] = $dati['longitudine'];
                $result[$i]['orari_lunedi'] = $dati['orari_lunedi'];
                $result[$i]['orari_martedi'] = $dati['orari_martedi'];
                $result[$i]['orari_mercoledi'] = $dati['orari_mercoledi'];
                $result[$i]['orari_giovedi'] = $dati['orari_giovedi'];
                $result[$i]['orari_venerdi'] = $dati['orari_venerdi'];
                $result[$i]['orari_sabato'] = $dati['orari_sabato'];
                $result[$i]['orari_domenica'] = $dati['orari_domenica'];
                $result[$i]['created_by'] = $dati['created_by'];
                $result[$i]['real_immagini_didascalia'] = $dati['real_immagini_didascalia'];
                $result[$i]['real_path_immagini_didascalia'] = $dati['real_path_immagini_didascalia'];
                $result[$i]['tipo_viaggio'] = $dati['tipo_viaggio'];

            }
            return $result;
        }
    }

    function getEccellenzeStruttura($dbh, $id)
    {
        $query = "SELECT * FROM eccellenze WHERE struttura_collegata = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $key => $value) {
                $result[$key] = $value;
            }
            return $result;
        }
    }

    function getCatStruttura($dbh, $id)
    {
        $query = "SELECT * FROM strutture_categorie WHERE id_struttura = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['id_struttura'] = $dati['id_struttura'];
                $result[$i]['id_categoria'] = $dati['id_categoria'];
                $result[$i]['email_struttura'] = $dati['email_struttura'];
                $i++;
            }
            return $result;
        } else return ("error");
    }


    function getDescrizioniStruttura($dbh, $id_lingua, $id_struttura)
    {
        $query = "SELECT * FROM strutture WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tel = $dati['telefono'];
                $email = $dati['email'];
                $lat = $dati['latitudine'];
                $lon = $dati['longitudine'];
                $created_by = $dati['created_by'];
                $indirizzo = $dati['indirizzo_struttura'];
            }
            $query = "SELECT * FROM strutture WHERE telefono = ? AND email = ? AND latitudine = ? AND longitudine = ? AND created_by = ? AND indirizzo_struttura = ? AND shortcode_lingua = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $tel, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $lat, PDO::PARAM_STR);
            $stmt->bindParam(4, $lon, PDO::PARAM_STR);
            $stmt->bindParam(5, $created_by, PDO::PARAM_INT);
            $stmt->bindParam(6, $indirizzo, PDO::PARAM_STR);
            $stmt->bindParam(7, $id_lingua, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                $result['descrizione'] = $dati['descrizione'];
                $result['descrizione_benefit'] = $dati['descrizione_benefit'];
                return ($result);
            } else return ($id_lingua);


        }
    }


    function updateStruttura($dbh, $nome, $email, $telefono, $sito, $indirizzo, $latitudine, $longitudine, $utente_abilitato, $num_eccellenze, $descrizioni_normali, $descrizione_benefit, $nomi_eccellenza, $abilitato, $descrizioni_eccellenza, $immagine_eccellenze, $lunedi, $martedi, $mercoledi, $giovedi, $venerdi, $sabato, $domenica, $immagini_hotel, $default_image, $hotel_associati, $categorie_associate, $indicizza, $convenzionato, $id_struttura, $immagini_didascalia, $testi_didascalia, $tipo_viaggio)
    {
        $path_imgs_hotel = '';
        session_start();

        for ($i = 0; $i < sizeof($immagini_hotel); $i++) {
            $path_imgs_hotel .= $immagini_hotel[$i] . '|';
        }
        for ($i = 0; $i < sizeof($immagini_didascalia); $i++) {
            $path_imgs_didascalia .= $immagini_didascalia[$i] . '|';
        }


        $query = "SELECT email,indirizzo_struttura,related_id FROM strutture WHERE id = ? ORDER BY id ASC LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $email_old = $dati['email'];
            $indirizzo_old = $dati['indirizzo_struttura'];
            $related_id = $dati['related_id'];
        }

        $query = "DELETE FROM eccellenze WHERE struttura_collegata = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $related_id, PDO::PARAM_INT);
        $stmt->execute();


        $lingue = getLangsShortcode($dbh);
        for ($i = 0; $i < sizeof($lingue); $i++) {
            $shortcode_lingua = $lingue[$i]['shortcode_lingua'];

            if ($_SESSION['level'] > 2) {
                $query = "UPDATE strutture SET nome_struttura = ?, email = ?, sito_web = ?, telefono = ?, indirizzo_struttura = ?, latitudine = ?, longitudine = ?, abilitata = ?, descrizione = ?, descrizione_benefit = ?, immagine_didascalia = ?, shortcode_lingua = ?, immagine_principale = ?, indicizza = ?, orari_lunedi = ?, orari_martedi = ?, orari_mercoledi = ?, orari_giovedi = ?, orari_venerdi = ?, orari_sabato = ?, orari_domenica = ?, real_immagini_didascalia = ?, real_path_immagini_didascalia = ?, convenzionato = ?, tipo_viaggio = ? WHERE related_id = ? AND shortcode_lingua = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $nome, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $sito, PDO::PARAM_STR);
                $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
                $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
                $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
                $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
                $stmt->bindParam(8, $utente_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(9, $descrizioni_normali[$i], PDO::PARAM_STR);
                $stmt->bindParam(10, $descrizione_benefit[$i], PDO::PARAM_STR);
                $stmt->bindParam(11, $path_imgs_hotel, PDO::PARAM_STR);
                $stmt->bindParam(12, $shortcode_lingua, PDO::PARAM_INT);
                $stmt->bindParam(13, $default_image, PDO::PARAM_STR);
                $stmt->bindParam(14, $indicizza, PDO::PARAM_INT);
                $stmt->bindParam(15, $lunedi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(16, $martedi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(17, $mercoledi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(18, $giovedi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(19, $venerdi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(20, $sabato[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(21, $domenica[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(22, $path_imgs_didascalia, PDO::PARAM_STR);
                $stmt->bindParam(23, $testi_didascalia, PDO::PARAM_STR);
                $stmt->bindParam(24, $convenzionato, PDO::PARAM_INT);
                $stmt->bindParam(25, $tipo_viaggio, PDO::PARAM_INT);


                $stmt->bindParam(26, $related_id, PDO::PARAM_INT);
                $stmt->bindParam(27, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
            } else {
                $query = "UPDATE strutture SET nome_struttura = ?, email = ?, sito_web = ?, telefono = ?, indirizzo_struttura = ?, latitudine = ?, longitudine = ?, abilitata = ?, descrizione = ?, immagine_didascalia = ?, shortcode_lingua = ?, immagine_principale = ?, indicizza = ?, orari_lunedi = ?, orari_martedi = ?, orari_mercoledi = ?, orari_giovedi = ?, orari_venerdi = ?, orari_sabato = ?, orari_domenica = ?, real_immagini_didascalia = ?, real_path_immagini_didascalia = ?, convenzionato = ?, tipo_viaggio = ? WHERE related_id = ? AND shortcode_lingua = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $nome, PDO::PARAM_STR);
                $stmt->bindParam(2, $email, PDO::PARAM_STR);
                $stmt->bindParam(3, $sito, PDO::PARAM_STR);
                $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
                $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
                $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
                $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
                $stmt->bindParam(8, $utente_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(9, $descrizioni_normali[$i], PDO::PARAM_STR);
                $stmt->bindParam(10, $path_imgs_hotel, PDO::PARAM_STR);
                $stmt->bindParam(11, $shortcode_lingua, PDO::PARAM_INT);
                $stmt->bindParam(12, $default_image, PDO::PARAM_STR);
                $stmt->bindParam(13, $indicizza, PDO::PARAM_INT);
                $stmt->bindParam(14, $lunedi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(15, $martedi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(16, $mercoledi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(17, $giovedi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(18, $venerdi[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(19, $sabato[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(20, $domenica[$size - 1], PDO::PARAM_STR);
                $stmt->bindParam(21, $path_imgs_didascalia, PDO::PARAM_STR);
                $stmt->bindParam(22, $testi_didascalia, PDO::PARAM_STR);
                $stmt->bindParam(23, $convenzionato, PDO::PARAM_INT);
                $stmt->bindParam(24, $tipo_viaggio, PDO::PARAM_INT);


                $stmt->bindParam(25, $related_id, PDO::PARAM_INT);
                $stmt->bindParam(26, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
            }

            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (isset($_SESSION['level']) && $_SESSION['level'] <= 2)
                $created_by = 0;
            else
                $created_by = $_SESSION['id_user'];


            $is_abilitato = explode("||", $abilitato[$i]);
            $is_abilitato = $is_abilitato[0]; //in lingua corrente

            $size = sizeof($lunedi);

            $stmt->execute();


        }
        $query = "DELETE FROM strutture_hotel WHERE id_struttura = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
        $stmt->execute();
        $query = "DELETE FROM strutture_categorie WHERE id_struttura = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
        $stmt->execute();

        for ($i = 0; $i < sizeof($hotel_associati); $i++) {
            $query = "INSERT INTO strutture_hotel (id_struttura,id_hotel,convenzionato) VALUES (?,?,?)";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
            $stmt->bindParam(2, $hotel_associati[$i], PDO::PARAM_INT);
            $stmt->bindParam(3, $convenzionato, PDO::PARAM_INT);
            $stmt->execute();
        }
        for ($i = 0; $i < sizeof($categorie_associate); $i++) {
            $query = "INSERT INTO strutture_categorie (id_struttura,id_categoria,email_struttura) VALUES (?,?,?)";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
            $stmt->bindParam(2, $categorie_associate[$i], PDO::PARAM_INT);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->execute();
        }
        //Aggiungo i servizi
        for ($i = 0; $i < sizeof($lingue); $i++) {


            for ($z = 0; $z < $num_eccellenze; $z++) {

                $descrizione_servizio = $descrizioni_eccellenza[$z];
                $descrizione_servizio = explode("||||", $descrizione_servizio);

                $nome_servizio = $nomi_eccellenza[$z];
                $nome_servizio = explode("||", $nome_servizio);


                $is_abilitato = explode("||", $abilitato[$z]);
                $is_abilitato = $is_abilitato[$z]; //in lingua corrente
                $query = "INSERT INTO eccellenze (struttura_collegata,titolo,testo,immagine,abilitato,shortcode_lingua) VALUES (?,?,?,?,?,?)";
                $stmt = $dbh->prepare($query);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
                $stmt->bindParam(2, $nome_servizio[$i], PDO::PARAM_STR);
                $stmt->bindParam(3, $descrizione_servizio[$i], PDO::PARAM_STR);
                $stmt->bindParam(4, $immagine_eccellenze[$z], PDO::PARAM_STR);
                $stmt->bindParam(5, $is_abilitato, PDO::PARAM_INT);
                $stmt->bindParam(6, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                $stmt->execute();


            }
        }

        for ($i = 0; $i < sizeof($hotel_associati); $i++) {
            if ($_SESSION['level'] <= 2) {
                $da = 0;
                $a = $hotel_associati[$i];
                $tipo = 2;
            } else {
                $a = 0;
                $da = $_SESSION['id_user'];
                $tipo = 3;
            }

            $query = "INSERT INTO notifiche (da,a,tipo,data,letto) VALUES (?,?,?,?,0)";
            $stmt = $dbh->prepare($query);
            $today = date('d/m/Y H:i');

            $stmt->bindParam(1, $da, PDO::PARAM_STR);
            $stmt->bindParam(2, $a, PDO::PARAM_STR);
            $stmt->bindParam(3, $tipo, PDO::PARAM_INT);
            $stmt->bindParam(4, $today, PDO::PARAM_STR);
            $stmt->execute();
        }
    }


    function getResetCode($dbh, $params)
    {
        $email = $params;
        $found = false;
        $query = "SELECT * FROM hotel WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $found = true;
            $type = 'hotel';
        } else {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $found = true;
                $type = 'users';
            }
        }

        if ($found != true)
            $result = 'error';
        else {

            $randomid = mt_rand(100000, 999999);
            /*
            //invio la mail con il codice di recupero
            require_once 'vendor/autoload.php';

            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.example.org', 25))
              ->setUsername('your username')
              ->setPassword('your password')
            ;

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message('Wonderful Subject'))
              ->setFrom(['john@doe.com' => 'John Doe'])
              ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
              ->setBody('Here is the message itself')
              ;

            // Send the message
            $result = $mailer->send($message);

            */
            if ($type == "hotel") {
                $query = "UPDATE hotel SET restore_code = ? WHERE email = ?";
            } else
                $query = "UPDATE users SET restore_code = ? WHERE email = ?";

            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $randomid, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = 'success';
        }

        return $result;
    }


    function verifyReset($dbh, $email, $code)
    {
        $found = false;
        $query = "SELECT * FROM hotel WHERE email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $found = true;
            $type = 'hotel';
        } else {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $found = true;
                $type = 'users';
            }
        }


        if ($found == false)
            $result = 'error';
        else {
            if ($type == 'hotel')
                $query = "SELECT * FROM hotel WHERE email = ? AND restore_code = ?";
            else
                $query = "SELECT * FROM users WHERE email = ? AND restore_code = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->bindParam(2, $code, PDO::PARAM_STR);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $result = 'success';
            } else $result = 'error';
        }

        return $result;
    }


    function getConvenzioneInfo($dbh, $id_struttura, $id_lingua)
    {
        $id_user = $_SESSION['id_user'];

        $query = "SELECT * FROM convenzioni_strutture WHERE id_struttura = ? AND id_hotel = ? AND shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_user, PDO::PARAM_INT);
        $stmt->bindParam(3, $id_lingua, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $i = 0;
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $result[$i]['testo_convenzione'] = $dati['testo_convenzione'];
            }
            return $result;
        } else return ('error');
    }


    function updateConvenzione($dbh, $descrizioni, $id_struttura)
    {
        session_start();
        $query = "DELETE FROM convenzioni_strutture WHERE id_struttura = ? AND id_hotel = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
        $stmt->bindParam(2, $_SESSION['id_user'], PDO::PARAM_INT);
        $stmt->execute();

        $lingue = getLangsShortcode($dbh);
        for ($i = 0; $i < sizeof($lingue); $i++) {
            $query = "INSERT INTO convenzioni_strutture (id_struttura,id_hotel,shortcode_lingua,testo_convenzione) VALUES (?,?,?,?)";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id_struttura, PDO::PARAM_INT);
            $stmt->bindParam(2, $_SESSION['id_user'], PDO::PARAM_INT);
            $stmt->bindParam(3, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
            $stmt->bindParam(4, $descrizioni[$i], PDO::PARAM_STR);
            $stmt->execute();
            $result = 'success';
        }

        return $result;
    }


    function setScriptTable($dbh)
    {
        session_start();
        $_SESSION['downloaded_datatable'] = true;
    }


    function addEvento($dbh, $nome, $email, $sito, $telefono, $indirizzo, $latitudine, $longitudine, $data_inizio, $ora_inizio, $data_fine, $ora_fine, $benefit, $img_evento, $recupera, $recupera_convenzione, $struttura_associata, $nome_evento, $descrizione_evento)
    {
        session_start();
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $lingue = getLangsShortcode($dbh);
        $shortcode_lingua = $lingue[0]['shortcode_lingua'];

        $query = "INSERT INTO eventi (nome_struttura,email,sito_web,telefono,indirizzo,latitudine,longitudine,data_inizio_evento,ora_inizio_evento,benefit,img_evento,recupera_struttura,recupera_convenzione,struttura_collegata,tipo_struttura_collegata,shortcode_lingua,created_by,nome_evento,data_fine_evento,ora_fine_evento) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $dbh->prepare($query);
        $tipo_struttura = 1; //non serve più, usare explode su struttura_associata invece


        if ($_SESSION['level'] <= 2)
            $created_by = 0;
        else
            $created_by = $_SESSION['id_user'];

        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $sito, PDO::PARAM_STR);
        $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
        $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
        $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
        $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
        $stmt->bindParam(8, $data_inizio, PDO::PARAM_STR);
        $stmt->bindParam(9, $ora_inizio, PDO::PARAM_STR);
        $stmt->bindParam(10, $benefit[$i], PDO::PARAM_STR);
        $stmt->bindParam(11, $img_evento, PDO::PARAM_STR);
        $stmt->bindParam(12, $recupera, PDO::PARAM_INT);
        $stmt->bindParam(13, $recupera_convenzione, PDO::PARAM_INT);
        $stmt->bindParam(14, $struttura_associata[0], PDO::PARAM_STR);
        $stmt->bindParam(15, $tipo_struttura, PDO::PARAM_STR);
        $stmt->bindParam(16, $shortcode_lingua, PDO::PARAM_INT);
        $stmt->bindParam(17, $created_by, PDO::PARAM_INT);
        $stmt->bindParam(18, $nome_evento, PDO::PARAM_STR);
        $stmt->bindParam(19, $data_fine, PDO::PARAM_STR);
        $stmt->bindParam(20, $ora_fine, PDO::PARAM_STR);


        $stmt->execute();


        $query = "SELECT * FROM eventi WHERE nome_struttura = ? AND email = ? AND sito_web = ? AND data_inizio_evento = ? AND data_fine_evento = ? AND created_by = ? AND nome_evento = ? ORDER BY id ASC LIMIT 1";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $sito, PDO::PARAM_STR);
        $stmt->bindParam(4, $data_inizio, PDO::PARAM_STR);
        $stmt->bindParam(5, $data_fine, PDO::PARAM_STR);
        $stmt->bindParam(6, $created_by, PDO::PARAM_INT);
        $stmt->bindParam(7, $nome_evento, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $dati = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_evento = $dati['id'];
        }

        for ($i = 0; $i < sizeof($lingue); $i++) {
            $shortcode_lingua = $lingue[$i]['shortcode_lingua'];

            for ($g = 0; $g < sizeof($struttura_associata); $g++) {
                $query = "INSERT INTO strutture_eventi (id_evento,shortcode_lingua,testo_convenzione,id_struttura,descrizione_evento) VALUES (?,?,?,?,?)";

                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
                $stmt->bindParam(2, $shortcode_lingua, PDO::PARAM_INT);
                $stmt->bindParam(3, $benefit[$i], PDO::PARAM_STR);
                $stmt->bindParam(4, $struttura_associata[$g], PDO::PARAM_STR);
                $stmt->bindParam(5, $descrizione_evento[$i], PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }


    function updateEvento($dbh, $nome, $email, $sito, $telefono, $indirizzo, $latitudine, $longitudine, $data_inizio, $ora_inizio, $data_fine, $ora_fine, $benefit, $img_evento, $recupera, $recupera_convenzione, $struttura_associata, $nome_evento, $id_evento, $descrizione_evento)
    {
        session_start();

        $query = "SELECT abilitato FROM eventi WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
        $stmt->execute();
        $dati = $stmt->fetch(PDO::FETCH_ASSOC);
        $abilitato = $dati['abilitato'];


        $query = "DELETE FROM eventi WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
        $stmt->execute();


        $query = "DELETE FROM strutture_eventi WHERE id_evento = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
        $stmt->execute();


        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $lingue = getLangsShortcode($dbh);
        $shortcode_lingua = $lingue[0]['shortcode_lingua'];

        $query = "INSERT INTO eventi (nome_struttura,email,sito_web,telefono,indirizzo,latitudine,longitudine,data_inizio_evento,ora_inizio_evento,benefit,img_evento,recupera_struttura,recupera_convenzione,struttura_collegata,tipo_struttura_collegata,shortcode_lingua,created_by,nome_evento,data_fine_evento,ora_fine_evento,id,abilitato) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $dbh->prepare($query);
        $tipo_struttura = 1; //non serve più, usare explode su struttura_associata invece


        if ($_SESSION['level'] <= 2)
            $created_by = 0;
        else
            $created_by = $_SESSION['id_user'];

        $stmt->bindParam(1, $nome, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $sito, PDO::PARAM_STR);
        $stmt->bindParam(4, $telefono, PDO::PARAM_STR);
        $stmt->bindParam(5, $indirizzo, PDO::PARAM_STR);
        $stmt->bindParam(6, $latitudine, PDO::PARAM_STR);
        $stmt->bindParam(7, $longitudine, PDO::PARAM_STR);
        $stmt->bindParam(8, $data_inizio, PDO::PARAM_STR);
        $stmt->bindParam(9, $ora_inizio, PDO::PARAM_STR);
        $stmt->bindParam(10, $benefit[$i], PDO::PARAM_STR);
        $stmt->bindParam(11, $img_evento, PDO::PARAM_STR);
        $stmt->bindParam(12, $recupera, PDO::PARAM_INT);
        $stmt->bindParam(13, $recupera_convenzione, PDO::PARAM_INT);
        $stmt->bindParam(14, $struttura_associata[0], PDO::PARAM_STR);
        $stmt->bindParam(15, $tipo_struttura, PDO::PARAM_STR);
        $stmt->bindParam(16, $shortcode_lingua, PDO::PARAM_INT);
        $stmt->bindParam(17, $created_by, PDO::PARAM_INT);
        $stmt->bindParam(18, $nome_evento, PDO::PARAM_STR);
        $stmt->bindParam(19, $data_fine, PDO::PARAM_STR);
        $stmt->bindParam(20, $ora_fine, PDO::PARAM_STR);
        $stmt->bindParam(21, $id_evento, PDO::PARAM_INT);
        $stmt->bindParam(22, $abilitato, PDO::PARAM_INT);


        $stmt->execute();

        for ($i = 0; $i < sizeof($lingue); $i++) {
            $shortcode_lingua = $lingue[$i]['shortcode_lingua'];

            for ($g = 0; $g < sizeof($struttura_associata); $g++) {
                $query = "INSERT INTO strutture_eventi (id_evento,shortcode_lingua,testo_convenzione,id_struttura,descrizione_evento) VALUES (?,?,?,?,?)";

                $stmt = $dbh->prepare($query);
                $stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
                $stmt->bindParam(2, $shortcode_lingua, PDO::PARAM_INT);
                $stmt->bindParam(3, $benefit[$i], PDO::PARAM_STR);
                $stmt->bindParam(4, $struttura_associata[$g], PDO::PARAM_STR);
                $stmt->bindParam(5, $descrizione_evento[$i], PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }


    function getStrutturaInfo($dbh, $tipo, $id)
    {
        if ($tipo == 2) {
            $query = "SELECT * FROM strutture WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                $result['nome'] = $dati['nome_struttura'];
            }
        } else {
            $query = "SELECT * FROM hotel WHERE id = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dati = $stmt->fetch(PDO::FETCH_ASSOC);
                $result['nome'] = $dati['nome'];
            }
        }

        return $result;
    }


    function getEventInfo($dbh, $id_evento, $id_lingua)
    {
        $query = "SELECT * FROM eventi WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($dati['shortcode_lingua'] == $id_lingua) {
                    $result['nome_struttura'] = $dati['nome_struttura'];
                    $result['id'] = $dati['id'];
                    $result['created_by'] = $dati['created_by'];
                    $result['data'] = $dati['data_inizio_evento'];
                    $result['recupera_struttura'] = $dati['recupera_struttura'];
                    $result['recupera_convenzione'] = $dati['recupera_convenzione'];
                    $result['recupera_convenzione'] = $dati['recupera_convenzione'];
                    $result['ora'] = $dati['ora_inizio_evento'];
                    $result['email'] = $dati['email'];
                    $result['telefono'] = $dati['telefono'];
                    $result['indirizzo'] = $dati['indirizzo'];
                    $result['latitudine'] = $dati['latitudine'];
                    $result['longitudine'] = $dati['longitudine'];
                    $result['benefit'] = $dati['benefit'];
                    $result['img_evento'] = $dati['img_evento'];
                    $result['sito_web'] = $dati['sito_web'];
                    $result['nome_evento'] = $dati['nome_evento'];
                    $result['data_fine_evento'] = $dati['data_fine_evento'];
                    $result['ora_fine_evento'] = $dati['ora_fine_evento'];
                    $result['struttura_collegata'] = $dati['struttura_collegata'];
                } else {
                    $query_bis = "SELECT * FROM eventi WHERE nome_struttura = ? AND data_inizio_evento = ? AND data_fine_evento = ? AND ora_inizio_evento = ? AND ora_fine_evento = ? AND struttura_collegata = ?";
                    $stmt_bis = $dbh->prepare($query_bis);
                    $stmt_bis->bindParam(1, $dati['nome_struttura'], PDO::PARAM_STR);
                    $stmt_bis->bindParam(2, $dati['data_inizio_evento'], PDO::PARAM_STR);
                    $stmt_bis->bindParam(3, $dati['data_fine_evento'], PDO::PARAM_STR);
                    $stmt_bis->bindParam(4, $dati['ora_inizio_evento'], PDO::PARAM_STR);
                    $stmt_bis->bindParam(5, $dati['ora_fine_evento'], PDO::PARAM_STR);
                    $stmt_bis->bindParam(6, $dati['struttura_collegata'], PDO::PARAM_INT);
                    $stmt_bis->execute();
                    if ($stmt_bis->rowCount() > 0) {
                        while ($dati_bis = $stmt_bis->fetch(PDO::FETCH_ASSOC)) {
                            $result['nome_struttura'] = $dati_bis['nome_struttura'];
                            $result['data'] = $dati_bis['data_inizio_evento'];
                            $result['recupera_struttura'] = $dati_bis['recupera_struttura'];
                            $result['recupera_convenzione'] = $dati_bis['recupera_convenzione'];
                            $result['ora'] = $dati_bis['ora_inizio_evento'];
                            $result['email'] = $dati_bis['email'];
                            $result['telefono'] = $dati_bis['telefono'];
                            $result['indirizzo'] = $dati_bis['indirizzo'];
                            $result['latitudine'] = $dati_bis['latitudine'];
                            $result['longitudine'] = $dati_bis['longitudine'];
                            $result['benefit'] = $dati_bis['benefit'];
                            $result['id'] = $dati_bis['id'];
                            $result['created_by'] = $dati_bis['created_by'];
                            $result['img_evento'] = $dati_bis['img_evento'];
                            $result['sito_web'] = $dati_bis['sito_web'];
                            $result['nome_evento'] = $dati_bis['nome_evento'];
                            $result['data_fine_evento'] = $dati_bis['data_fine_evento'];
                            $result['ora_fine_evento'] = $dati_bis['ora_fine_evento'];
                            $result['struttura_collegata'] = $dati_bis['struttura_collegata'];
                        }
                    } else $result = 'error';
                }
            }
            return $result;
        } else return ("error");
    }


    function updateEventoSmall($dbh, $benefit, $id_evento)
    {
        session_start();
        echo 'ok';
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $lingue = getLangsShortcode($dbh);
        $shortcode_lingua = $lingue[0]['shortcode_lingua'];
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM strutture_eventi WHERE id_evento = ? AND shortcode_lingua = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
        $stmt->bindParam(2, $_SESSION['lang'], PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo 'ok';
            while ($dati = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sc = $dati['id_struttura'];
                $struttura_collegata = explode("-", $dati['id_struttura']);
                $struttura_info = getStrutturaInfo($dbh, $struttura_collegata[0], $struttura_collegata[1]);
                if ($struttura_collegata[1] == $_SESSION['id_user'] && $struttura_collegata[0] == 1)
                    //modifico la descrizione qui
                    for ($i = 0; $i < sizeof($lingue); $i++) {
                        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $query_bis = "UPDATE strutture_eventi SET testo_convenzione = ? WHERE id_evento = ? AND id_struttura = ? AND shortcode_lingua = ?";
                        $stmt_bis = $dbh->prepare($query_bis);
                        $stmt_bis->bindParam(1, $benefit[$i], PDO::PARAM_STR);
                        $stmt_bis->bindParam(2, $id_evento, PDO::PARAM_INT);
                        $stmt_bis->bindParam(3, $sc, PDO::PARAM_STR);
                        $stmt_bis->bindParam(4, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                        $stmt_bis->execute();
                    }

                else {
                    $strutture_hotel = getElencoStrutture($dbh);
                    $strutture_string = '';
                    for ($d = 0; $d < sizeof($strutture_hotel); $d++) {
                        $strutture_string .= $strutture_hotel[$d]['id'] . '|';
                    }
                    $search = explode("-", $dati['id_struttura']);
                    if ($search[0] == 2) {
                        $search = $search[1];
                        if (strpos($strutture_string, $search) !== false) {
                            //modifico la descrizione qui
                            for ($i = 0; $i < sizeof($lingue); $i++) {
                                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                $query_bis = "UPDATE strutture_eventi SET testo_convenzione = ? WHERE id_evento = ? AND id_struttura = ? AND shortcode_lingua = ?";
                                $stmt_bis = $dbh->prepare($query_bis);
                                $stmt_bis->bindParam(1, $benefit[$i], PDO::PARAM_STR);
                                $stmt_bis->bindParam(2, $id_evento, PDO::PARAM_INT);
                                $stmt_bis->bindParam(3, $search, PDO::PARAM_STR);
                                $stmt_bis->bindParam(4, $lingue[$i]['shortcode_lingua'], PDO::PARAM_INT);
                                $stmt_bis->execute();
                            }
                        }
                    }

                }
            }
        }
        return ("success");
    }


    function delRelatedStrutturaEvento($dbh, $type, $id, $id_evento)
    {
        $query = "DELETE FROM strutture_eventi WHERE id_evento = ? AND id_struttura = ?";
        $stmt = $dbh->prepare($query);
        $id_struttura_type = $type . '-' . $id;
        $stmt->bindParam(1, $id_evento, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_struttura_type, PDO::PARAM_STR);
        $stmt->execute();
        return ("success");
    }


}