<?php

/**
 * Render widget Cloudflare Turnstile di form
 * Cara pakai: <?= turnstile_widget() ?>
 */
if (!function_exists('turnstile_widget')) {
    function turnstile_widget(): string
    {
        helper('setting');
        $siteKey = get_site_key();

        if (empty($siteKey)) {
            return '<!-- TURNSTILE_SITE_KEY belum diatur di database -->';
        }

        $callbackHandlers = <<<HTML
            <script>
                window.onTurnstileLoad = function() {
                    console.log("Cloudflare Turnstile berhasil dimuat");
                };

                window.onTurnstileError = function() {
                    console.error("Cloudflare Turnstile gagal dimuat. Kemungkinan site key salah atau domain tidak sesuai.");

                    const container = document.querySelector(".cf-turnstile");
                    if (container) {
                        container.innerHTML = `
                            <div style="
                                color: #b30000;
                                background: #ffe6e6;
                                border: 1px solid #b30000;
                                padding: 10px;
                                border-radius: 5px;
                                font-size: 14px;
                                margin-top: 10px;
                            ">
                                Error: Gunakan web browser dekstop atau web browser mobile phone<br>
                            </div>
                        `;
                    }
                };
            </script>
        HTML;

        return <<<HTML
            <div class="cf-turnstile"
                 data-sitekey="{$siteKey}"
                 data-theme="auto"
                 data-callback="onTurnstileLoad"
                 data-error-callback="onTurnstileError">
            </div>
            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
            {$callbackHandlers}
            HTML;
    }
}

/**
 * Verifikasi hasil captcha ke server Cloudflare
 * Cara pakai: if (verify_turnstile($this->request)) { ... }
 */
if (!function_exists('verify_turnstile')) {
    function verify_turnstile($request): bool
    {
        helper('setting');
        $secretKey = get_secret_key();
        $token = $request->getPost('cf-turnstile-response');

        if (empty($token) || empty($secretKey)) {
            session()->setFlashdata('error', 'Turnstile token atau secret key kosong');
            log_message('error', 'Turnstile token atau secret key kosong.');
            return false;
        }

        $verifyUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
        $data = http_build_query([
            'secret' => $secretKey,
            'response' => $token,
            'remoteip' => $request->getIPAddress(),
        ]);

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $data,
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($verifyUrl, false, $context);
        $result = json_decode($response, true);

        if (!isset($result['success'])) {
            session()->setFlashdata('error', 'Turnstile response invalid: ' . $response);
            log_message('error', 'Turnstile response invalid: ' . $response);
            return false;
        }

        return $result['success'] === true;
    }
}
