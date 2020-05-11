
<?php
class Creds {

  public static $api_key = "";
  public static $account_id = "987654321";

  function __construct() {

  }

  public static function write_rest_url($endpoint) {
    $str = "https://leadexeciscool/";
    $str .= self::$account_id . '/';
    return $str;
  }
  //not in use - incorrect format
  public static function write_headers_arr() {
    return  ["Authorization" => 'Token token="' .
    self::$api_key .
    '"', "Content-Type" => "application/x-www-form-urlencoded"];
  }

}
?>
