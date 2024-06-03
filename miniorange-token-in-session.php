<?php

namespace Zenmo;

/*
 * Plugin Name: Zenmo MiniOrange Token-in-Session
 * Plugin URI: https://github.com/Zenmo/miniorange-token-in-session
 * Description: Stores OAuth2 ID and Access tokens in user session after login via MiniOrange OAuth2 Client plugin
 */

/**
 * @param \WP_User $wordPressUser
 * @param array{
 *     access_token: string,
 *     expires_in: string,
 *     refresh_expires_in: int,
 *     refresh_token: string,
 *     token_type: "Bearer",
 *     id_token: string,
 *     not-before-policy: 0,
 *     session_state: string,
 *     scope: string,
 * } $tokens
 * @return void
 */
function store_token_in_session(\WP_User $wordPressUser, array $tokens) {
    session_start();

    $_SESSION['id_token'] = $tokens['id_token'];
    $_SESSION['access_token'] = $tokens['access_token'];

    session_write_close();
}

add_action('mo_oauth_logged_in_user_token', "Zenmo\\store_token_in_session", 10, 2);
