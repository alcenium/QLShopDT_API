<?php
class GioHang_check {
    public static function laSoLonHon0 ($variable) {
        if (is_int($variable) && $variable > 0)
            return true;
        return false;
    }
}
?>