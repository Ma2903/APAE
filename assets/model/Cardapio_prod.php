<?php
    class Cardapio_produtos {
        
        private $id;
        private $cardapio_id;
        private $produto_id;
        private $quantidade;
        
        public function __construct($id = null, $cardapio_id = null, $produto_id = null, $quantidade = null) {
            $this->id = $id;
            $this->cardapio_id = $cardapio_id;
            $this->produto_id = $produto_id;
            $this->quantidade = $quantidade;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getCardapioId() {
            return $this->cardapio_id;
        }
        
        public function setCardapioId($cardapio_id) {
            $this->cardapio_id = $cardapio_id;
        }
        
        public function getProdutoId() {
            return $this->produto_id;
        }
        
        public function setProdutoId($produto_id) {
            $this->produto_id = $produto_id;
        }
        
        public function getQuantidade() {
            return $this->quantidade;
        }
        
        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }
    }

?>