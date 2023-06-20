<?php
    class DateTimeHelper
    {
        public static function ConvertDateTimeToString() : string
        {
            date_default_timezone_set('Europe/Amsterdam');
            return date("Y-m-d H:i:s", strtotime('NOW'));
        }
    }

?>