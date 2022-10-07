
<?php
if (!function_exists('rupiah')) {
        function rupiah($rupiah)
        {
            return number_format($rupiah,0,',','.');
        }
}
?>