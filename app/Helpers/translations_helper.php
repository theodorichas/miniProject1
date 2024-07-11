<?php


if (!function_exists('getTranslation')) {
    function getTranslation($key)
    {
        $db = \Config\Database::connect();
        $language = session()->get('language') ?? get_cookie('lang') ?? 'en'; // Default to 'en' if no session or cookie is found

        // Ensure 'en' and 'indo' are the only options
        if (!in_array($language, ['en', 'indo'])) {
            $language = 'en';
        }

        $query = $db->table('translations')
            ->select($language)
            ->where('key', $key)
            ->get();
        $result = $query->getRow();
        return $result ? $result->$language : $key; // Return the translation if found, otherwise return the key itself
    }
}
