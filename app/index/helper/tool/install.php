<?php

use think\facade\Db;
use think\db\exception\DbException;

// 检查函数是否存在
function checkFunction($f, $m = false) {
    return function_exists($f) ?
        ['status' => true, 'badge' => '<span class="badge rounded-pill bg-success">正常</span>'] :
        ['status' => false, 'badge' => '<span class="badge rounded-pill bg-' . ($m ? 'danger' : 'warning') . '">不支持</span>'];
}

// 检查版本是否满足要求
function checkVersion($current, $required, $message) {
    if (empty($current)) {
        // 如果没有获取到版本号，直接返回通过
        return ['status' => true, 'badge' => '<span class="badge rounded-pill bg-success">正常</span>'];
    }
    return version_compare($current, $required, '>=') ?
        ['status' => true, 'badge' => '<span class="badge rounded-pill bg-success">正常</span>'] :
        ['status' => false, 'badge' => '<span class="badge rounded-pill bg-danger">不支持</span>', 'message' => $message];
}

// 检查是否为SSL环境
function isSSL() {
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
}

// 获取所有环境检查的结果
function getEnvironmentChecks() {
    // 检查PHP版本
    $phpCheck = checkVersion(PHP_VERSION, '8.0.0', '请使用PHP8.0版本及以上运行此程序！');

    // 检查MySQL版本
    $mysql_version = '';
    if (function_exists('shell_exec')) {
        try {
            $mysql_version = trim(shell_exec('mysql -V'));
            $mysql_version_number = preg_replace('/[^0-9.]/', '', $mysql_version);
        } catch (Exception $e) {
            // 如果执行失败，记录日志但继续
            error_log("Failed to execute shell command to get MySQL version: " . $e->getMessage());
        }
    }

    // 如果无法获取MySQL版本，直接返回通过
    if (empty($mysql_version)) {
        $mysqlCheck = ['status' => true, 'badge' => '<span class="badge rounded-pill bg-success">正常</span>'];
    } else {
        $mysqlCheck = checkVersion($mysql_version_number, '5.6.0', '请使用MySQL5.6版本及以上运行此程序！');
    }

    // 检查sodium扩展
    $sodiumCheck = extension_loaded('sodium') ?
        ['status' => true, 'badge' => '<span class="badge rounded-pill bg-success">正常</span>'] :
        ['status' => false, 'badge' => '<span class="badge rounded-pill bg-danger">不支持</span>', 'message' => '请确保加载了sodium扩展'];

    // 检查SSL
    $sslCheck = isSSL() ?
        ['status' => true, 'badge' => '<span class="badge rounded-pill bg-success">正常</span>'] :
        ['status' => false, 'badge' => '<span class="badge rounded-pill bg-danger">不支持</span>', 'message' => '请确保在HTTPS环境下运行此程序'];

    // 合并所有检查结果
    $checks = [
        'php' => $phpCheck,
        'mysql' => $mysqlCheck,
        'sodium' => $sodiumCheck,
        'ssl' => $sodiumCheck,
    ];

    // 检查是否有任何一项不通过
    $allChecksPass = array_reduce($checks, function($carry, $item) {
        return $carry && $item['status'];
    }, true);

    return ['checks' => $checks, 'allChecksPass' => $allChecksPass];
}