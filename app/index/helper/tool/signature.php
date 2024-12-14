<?php

// 引入 libsodium 扩展
if (!extension_loaded('sodium')) {
    die('The Sodium extension is required.');//缺少拓展错误提示
}

// 定义生成签名的函数
function generateSignature($botSecret, $plainToken, $eventTs) {
    // 生成种子
    $seed = $botSecret;
    while (strlen($seed) < SODIUM_CRYPTO_SIGN_SEEDBYTES) {
        $seed .= $seed;
    }
    $seed = substr($seed, 0, SODIUM_CRYPTO_SIGN_SEEDBYTES);

    // 生成密钥对
    $keyPair = sodium_crypto_sign_seed_keypair($seed);
    $privateKey = sodium_crypto_sign_secretkey($keyPair);

    // 构造消息
    $msg = $eventTs . $plainToken;

    // 签名
    $signature = sodium_crypto_sign_detached($msg, $privateKey);

    // 编码签名
    $signatureHex = bin2hex($signature);

    return $signatureHex;
}

?>