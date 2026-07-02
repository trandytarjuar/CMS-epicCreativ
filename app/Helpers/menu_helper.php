<?php

if (!function_exists('get_segments')) {
    function get_segments()
    {
        return service('uri')->getSegments();
    }
}

if (!function_exists('current_page')) {
    function current_page()
    {
        $segments = get_segments();
        return $segments[0] ?? '';
    }
}

if (!function_exists('current_lang')) {
    function current_lang()
    {
        $segments = get_segments();
        return $segments[1] ?? '';
    }
}

if (!function_exists('is_active')) {
    function is_active($page, $lang = null)
    {
        $currentPage = current_page();
        $currentLang = current_lang();

        if ($lang !== null) {
            return ($currentPage == $page && $currentLang == $lang) ? 'active' : '';
        }

        return ($currentPage == $page) ? 'active' : '';
    }
}

if (!function_exists('is_menu_open')) {
    function is_menu_open($page)
    {
        return current_page() == $page ? 'menu-open' : '';
    }
}

//////////////////////////////////////////////////
// 🔥 ROLE BASED
//////////////////////////////////////////////////

if (!function_exists('has_role')) {
    function has_role($roles)
    {
        $userRole = session()->get('role');

        if (is_string($roles)) {
            $roles = [$roles];
        }

        return in_array($userRole, $roles);
    }
}

//////////////////////////////////////////////////
// 🔥 BONUS: MULTI PAGE ACTIVE
//////////////////////////////////////////////////

if (!function_exists('is_active_multi')) {
    function is_active_multi($pages = [])
    {
        return in_array(current_page(), $pages) ? 'active' : '';
    }
}
function is_dashboard()
{
    return uri_string() == '' ? 'active' : '';
}
