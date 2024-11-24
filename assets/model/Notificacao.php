<?php
class Notificacao {
    private $id;
    private $user_id;
    private $mensagem;
    private $dt_notification;
    private $is_active;

    public function __construct($id, $user_id, $mensagem, $dt_notification , $is_active) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->mensagem = $mensagem;
        $this->dt_notification = $dt_notification;
        $this->is_active = $is_active;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;
    }

    public function getDtNotification() {
        return $this->dt_notification;
    }

    public function setDtNotification($dt_notification) {
        $this->dt_notification = $dt_notification;
    }

    public function getIsActive() {
        return $this->is_active;
    }
}
?>