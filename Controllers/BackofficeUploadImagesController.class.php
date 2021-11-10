<?php
require_once 'Database/LanguageRepository.class.php';
require_once 'Database/TranslationRepository.class.php';
require_once 'Database/UserRepository.class.php';
require_once 'Middlewares/SessionManager.class.php';
require_once 'Models/Languages.class.php';
require_once 'Models/Translations.class.php';
require_once 'Models/User.class.php';
require_once 'ViewModels/BackOfficeViewModel.class.php';
require_once 'Views/JsonView.class.php';

class BackofficeUploadImagesController
{
    protected $language_repository;
    protected $translation_repository;
    protected $user_repository;

    public function __construct()
    {
        $this->language_repository = new LanguageRepository();
        $this->translation_repository = new TranslationRepository();
        $this->user_repository = new UserRepository();
    }

    public function http_post(array &$params): IView
    {
        if (isset($params['administrators'])) {
            return new JsonView(false);
        } else {

            $user = SessionManager::get_user();
            if (User::is_empty($user)) {
                return new JsonView(false);
            }


            // Count total files
            $countfiles = count($params['immagini_form']['name']);

// Upload directory
            $upload_location = $params['DOCUMENT_ROOT'] . "/uploads/";

// To store uploaded files path
            $files_arr = array();

// Loop all files
            for ($index = 0; $index < $countfiles; $index++) {

                if (isset($params['immagini_form']['name'][$index]) && $params['immagini_form']['name'][$index] != '') {
                    // File name
                    $filename_backup = $params['immagini_form']['name'][$index];

                    $randomNumber = rand(0, 10000000000);

                    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') - 1; $i != 32; $x = rand(0, $z), $s .= $a{$x}, $i++) ;

                    $filename = $randomNumber . $s;

                    // Get extension
                    $ext = strtolower(pathinfo($filename_backup, PATHINFO_EXTENSION));

                    // Valid image extension
                    $valid_ext = array("png", "jpeg", "jpg");

                    // Check extension
                    if (in_array($ext, $valid_ext)) {

                        // File path
                        $path = $upload_location . $filename . '.' . $ext;

                        // Upload file
                        if (move_uploaded_file($params['immagini_form']['tmp_name'][$index], $path)) {
                            $files_arr[] = '/backoffice/uploads/' . $filename . '.' . $ext;
                        }
                    }
                }
            }

            return new JsonView($files_arr);
        }
    }
}