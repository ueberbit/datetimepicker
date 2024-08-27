<?php

namespace Drupal\datetimepicker;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Security\TrustedCallbackInterface;

class DateTimePickerHelper implements TrustedCallbackInterface {

  /**
   * Callback for the date element.
   */
  public static function dateTimePickerDateCallback(&$element, $form, $form_state) {
    $element['date']['#attributes']['data-datetimepicker-settings'] = Json::encode($element['#datetimepicker_settings']);
    $element['date']['#attributes']['data-datetimepicker-widget'] = TRUE;
  }

  /**
   * Callback for the time element.
   */
  public static function dateTimePickerTimeCallback(&$element, $form, $form_state) {
    $settings = [
      'closeOnDateSelect' => TRUE,
      'datepicker' => TRUE,
      'format' => $element['#date_date_format'],
      'timepicker' => FALSE,
    ] + $element['#datetimepicker_settings'];

    $element['date']['#attributes']['data-datetimepicker-settings'] = Json::encode($settings);
    $element['date']['#attributes']['data-datetimepicker-widget'] = TRUE;

    $settings = [
      'datepicker' => FALSE,
      'format' => $element['#date_time_format'],
      'timepicker' => TRUE,
    ] + $element['#datetimepicker_settings'];

    $element['time']['#attributes']['data-datetimepicker-settings'] = Json::encode($settings);
    $element['time']['#attributes']['data-datetimepicker-widget'] = TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public static function trustedCallbacks() {
    return [
      'dateTimePickerDateCallback',
      'dateTimePickerTimeCallback',
    ];
  }

}
