<?php

class BodyParams {
  public static $meta_params = array('VID'=>'','LID'=>'376','AID'=>'');
  public static $companies = array(
     null,
    'Anderson',
    'Connors',
    'Ehrlich',
    'EnviroSafe',
    'Fischer',
    'Pratt',
    'Western'
  );
  public static $meta_data = array(
    'VID' => [
      '',
      '101',
      '202',
      '303',
      '404',
      '505',
      '606',
      '707'
    ],
    'AID' => [
      [''],
      ['','111','112'],
      ['','211','212'],
      ['','311','312'],
      ['','411','412'],
      ['','511','512'],
      ['','611','612'],
      ['','711','712']
      ]
  );
  public static $forms = array(
    [''],
    ['','stupeform1','dumform1'],
    ['','stuckform2','yuckform2'],
    ['','stupeform3','dumform3'],
    ['','stuckform4','yuckform4'],
    ['','stupeform5','dumform5'],
    ['','stuckform6','yuckform6'],
    ['','stuckform7','yuckform7']
  );

  public static function get_form_meta($brand,$form) {
    $result = self::$meta_params;
    $new_val = '';
    $valid = 0;
    foreach($result as $key => $val) {
      if (!$val) {
        $name_index = array_search($brand,self::$companies);
        if (is_array(self::$meta_data[$key][0])) {
          $form_index = ($name_index) ? (
            isset(self::$forms[$name_index]) ?
              array_search($form,self::$forms[$name_index]) : null
            ) : null;
          if ($form_index) {
            $result[$key] = self::$meta_data[$key][$name_index][$form_index];
          }
        } else {
          $new_val = ($name_index) ? self::$meta_data[$key][$name_index] : null;
          if ($new_val) {
            $result[$key] = $new_val;
          }
        }
      }
    }
    error_log(json_encode($result));
    //quick validator
    foreach(array_keys(self::$meta_params) as $meta) {
      $valid += ($meta) ? 1 : 0;
    }
    return ($valid===count(array_keys(self::$meta_params))) ?
    $result : false;
  }

  public static function form_params($keys,$fields) {
    $result = self::get_form_meta($fields[0],$fields[1]);
    $form_labels = array_slice($keys,2);
    $form_fields = array_slice($fields,2);
    $index = 0;
    foreach($form_labels as $form_label) {
      if ( $form_label && isset($form_fields[$index]) ) {
        $result[$form_label] = $form_fields[$index];
      }
      $index++;
    }
    return (count($form_fields)+3===count(array_keys($result))) ? $result : false;
  }
}
?>
a
