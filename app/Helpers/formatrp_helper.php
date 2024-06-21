<?php
// File: app/Helpers/FormatHelper.php
function formatRupiah($value)
{
    return 'Rp. ' . number_format($value, 0, ',', '.');
}
