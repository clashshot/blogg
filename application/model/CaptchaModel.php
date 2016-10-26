<?php

/**
 * Class CaptchaModel
 *
 * This model class handles all the captcha stuff.
 * Currently this uses the excellent Captcha generator lib from https://github.com/Gregwar/Captcha
 * Have a look there for more options etc.
 */
class CaptchaModel
{

    /**
     * Checks if the entered captcha is the same like the one from the rendered image which has been saved in session
     * @param $captcha string The captcha characters
     * @return bool success of captcha check
     */
    public static function checkCaptcha($captcha)
    {
        $secretkey = '6Ldk-wgUAAAAALBiRDKRuj3_2DMezrB2YaHCaMnZ';
        $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha");
        $responseData = json_decode($verifyResponse);
        if($responseData->success == '1'){
            return true;
        }

        return false;
    }
}
