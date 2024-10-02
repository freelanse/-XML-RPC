<?php
// Отключение доступа к XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Ограничение доступа к XML-RPC для определённых IP
function block_xmlrpc_except_trusted_ips() {
    if (strpos($_SERVER['REQUEST_URI'], '/xmlrpc.php') !== false) {
        $trusted_ips = array('192.168.0.1', '203.0.113.0'); // Укажите свои доверенные IP-адреса
        if (!in_array($_SERVER['REMOTE_ADDR'], $trusted_ips)) {
            wp_die('Доступ к XML-RPC заблокирован.');
        }
    }
}
add_action('init', 'block_xmlrpc_except_trusted_ips');
?>
