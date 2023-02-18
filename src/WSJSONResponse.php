<?php

class WSJSONResponse {

    private $request_uc;
    private $request_action;
    private $success;
    private $response;

    public function __construct($request_uc, $request_action, $success, $response) {
        $this->request_uc = $request_uc;
        $this->request_action = $request_action;
        $this->success = $success;
        $this->response = $response;
    }

    public function __toString() {
        $tab = array();
        $tab["request_uc"] = $this->request_uc;
        $tab["request_action"] = $this->request_action;
        $tab["success"] = $this->success;
        $tab["response"] = json_encode($this->response);
        return json_encode($tab, JSON_PRETTY_PRINT);
    }

}
