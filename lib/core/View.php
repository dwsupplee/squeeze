<?php

class SQUEEZE_View {
  public function load($view, $data = array()) {
    extract($data);

    ob_start();
    include COMMITMENT_REPORT_PLUGIN_PATH .'/views/'. $view .'.php';
    $viewData = ob_get_contents();
    ob_end_clean();

    return $viewData;
  }
}