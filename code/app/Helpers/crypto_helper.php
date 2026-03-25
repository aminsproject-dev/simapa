<?php

use Config\Services;

if (!function_exists('encrypt_data')) {
    /**
     * Encrypt data securely
     *
     * @param mixed $data
     * @return string
     */
    function encrypt_data($data): string
    {
        $encrypter = Services::encrypter();

        $payload = serialize($data);

        $ciphertext = $encrypter->encrypt($payload);

        return rtrim(strtr(base64_encode($ciphertext), '+/', '-_'), '=');
    }
}

if (!function_exists('decrypt_data')) {
    /**
     * Decrypt encrypted data
     *
     * @param string $encrypted
     * @return mixed|null
     */
    function decrypt_data(string $encrypted)
    {
        try {
            $encrypter = Services::encrypter();

            $ciphertext = base64_decode(
                strtr($encrypted, '-_', '+/')
            );

            if ($ciphertext === false) {
                return null;
            }

            return unserialize($encrypter->decrypt($ciphertext));
        } catch (\Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('hash_data')) {
    /**
     * Hashing data
     *
     * @param string $data
     * @return mixed|null
     */
    function hash_data(string $data)
    {
        try {
            $hashing = password_hash($data, PASSWORD_BCRYPT);
            return $hashing;
        } catch (\Throwable $e) {
            // Jika data rusak
            return null;
        }
    }
}
