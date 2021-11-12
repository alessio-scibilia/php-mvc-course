<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Database/GuestRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/HttpRedirectView.class.php';
require_once 'Views/HtmlView.class.php';
require_once 'Views/Html404.class.php';

class BackofficeGuestsUploadController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;
    protected $guest_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
        $this->guest_repository = new GuestRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['guests'])) {
            return new Html404();
        } else {
            $languages = new Languages($this->language_repository->list_all());
            $id_lingua = SessionManager::get_lang();
            $languages->select($id_lingua);

            $translations = new Translations($this->translation_repository->list_by_language($id_lingua));
            $title = $translations->get('gestione_ospiti') . ' | ' . $translations->get('nome_sito');

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new HttpRedirectView('/backoffice');
            }

            if (isset($params['file_ospiti']))
                $countfiles = 1;
            else
                $countfiles = 0;
            // Upload directory
            $upload_location = $params['DOCUMENT_ROOT'] . "/import/";

            // To store uploaded files path
            $files_arr = array();

            // Loop all files
            for ($index = 0; $index < $countfiles; $index++) {

                if (isset($_FILES['file_ospiti']['name'][$index]) && $_FILES['file_ospiti']['name'][$index] != '') {
                    // File name
                    $filename_backup = $_FILES['file_ospiti']['name'];

                    $randomNumber = rand(0, 10000000000);

                    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') - 1; $i != 32; $x = rand(0, $z), $s .= $a{$x}, $i++) ;

                    $filename = $randomNumber . $s;

                    // Get extension
                    $ext = strtolower(pathinfo($filename_backup, PATHINFO_EXTENSION));

                    // Valid image extension
                    $valid_ext = array("csv", "xls");

                    // Check extension
                    if (in_array($ext, $valid_ext)) {

                        // File path
                        $path = $upload_location . $filename . '.' . $ext;

                        // Upload file
                        if (move_uploaded_file($_FILES['file_ospiti']['tmp_name'], $path)) {
                            $files_arr[] = '/import/' . $filename . '.' . $ext;
                        }


                    }
                }
            }

            if ($ext == 'csv') {
                $file = fopen($params['DOCUMENT_ROOT'] . '/import/' . $filename . '.' . $ext, 'r');
                $i = 0;
                while (($line = fgetcsv($file)) !== FALSE) {
                    //$line is an array of the csv elements
                    if ($i > 1) {
                        $dati = $line[0];
                        $new = explode(";", $dati);

                        $new_user['hotel_associato'] = $user->id;

                        $new_user['nome'] = $new[0];
                        $new_user['cognome'] = $new[1];
                        $new_user['telefono'] = $new[2];
                        $new_user['email'] = $new[3];
                        $new_user['data_checkin'] = $new[4];
                        $new_user['data_checkout'] = $new[5];
                        $new_user['numero_ospiti'] = $new[6];

                        if (empty($new[7]))
                            $password_text = mt_rand(100000, 999999);
                        else
                            $password_text = $new[7];

                        $new_user['password'] = md5($password_text);
                        $new_user['numero_stanza'] = $new[8];

                        $this->guest_repository->add($new_user);

                    }
                    $i++;
                }
                fclose($file);
            } else if ($ext == 'xls') {
                require_once 'Middlewares/excelReader/excel_reader.php';
                $r = 1;
                $excel = new PhpExcelReader;
                $excel->setOutputEncoding('UTF-8');
                $excel->read($params['DOCUMENT_ROOT'] . '/import/' . $filename . '.' . $ext);
                foreach ($excel->sheets[0]['cells'] as $row) {
                    if ($r > 3) {
                        $new_user['hotel_associato'] = $user->id;

                        $new_user['nome'] = $row[1];
                        $new_user['cognome'] = $row[2];
                        $new_user['telefono'] = $row[3];
                        $new_user['email'] = $row[4];


                        $data_checkin = date("Y-m-d", strtotime($row[5]));

                        $checkin = ($data_checkin - 25569) * 86400;


                        $data_checkout = date("Y-m-d", strtotime($row[6]));
                        $checkout = ($data_checkout - 25569) * 86400;

                        $new_user['data_checkin'] = $checkin;
                        $new_user['data_checkout'] = $checkout;
                        $new_user['numero_ospiti'] = $row[7];
                        $new_user['numero_stanza'] = $row[9];

                        if (empty($row[8]))
                            $password_text = mt_rand(100000, 999999);
                        else
                            $password_text = $row[8];

                        $new_user['password'] = md5($password_text);

                        $this->guest_repository->add($new_user);
                    }
                    $r++;
                }
                $excel = null;
            }

            $rows = $this->guest_repository->get_all_guests();
            $guests = Guest::guests($rows);
            //$guests = array(); // TODO: da leggere da DB

            //'d92fgov02dm2jf493fspamwi2d0za201',
            $view_model = new BackOfficeViewModel('backoffice.guests.list', $title, $languages, $translations);
            $view_model->user = $user;
            $view_model->guests = $guests;
            $view_model->menu_active_btn = 'guests';

            return new HtmlView($view_model);
        }
    }
}