<?php
define("G_Cap_Key_Client", "");
define("G_Cap_Key_Server", "");

class GoogleService
{
    public static function VerifyCaptcha()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $g_key = $_POST["g-recaptcha-response"];
        $ch = curl_init("https://www.google.com/recaptcha/api/siteverify");

        $data = array(
            "secret" => G_Cap_Key_Server,
            "response" => "$g_key",
            "remoteip" => "$ip"
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER,0);
        $cres = curl_exec($ch);
        curl_close($ch);
        $cres = json_decode($cres);
        return $cres->success;
    }
}
?>



<?php function RenderGoogleCaptcha(){ ?>
<div class="g-recaptcha" data-sitekey="<?php echo G_Cap_Key_Client;?>"></div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php } ?>