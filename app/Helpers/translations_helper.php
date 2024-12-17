<?php

if (!function_exists('getTranslation')) {
    function getTranslation($key)
    {
        $db = \Config\Database::connect();
        $language = session()->get('language') ?? get_cookie('lang') ?? 'en'; // Default to 'en' if no session or cookie is found

        // Ensure 'langEn' and 'langIndo' are the column names being selected
        $languageColumn = ($language === 'indo') ? 'langIndo' : 'langEn'; // Default to 'langEn' for 'en'

        $query = $db->table('translations')
            ->select($languageColumn)
            ->where('langKey', $key) // Use 'langKey' as per your migration
            ->get();
        $result = $query->getRow();

        return $result ? $result->$languageColumn : $key; // Return the translation if found, otherwise return the key itself
    }
}
