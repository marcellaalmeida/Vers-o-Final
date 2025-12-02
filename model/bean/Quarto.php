<?php
    class Quarto {
        // Atributos
        private $id;
        private $numero;
        private $preco_diaria;
        private $status;
        private $tipo;

        // Métodos
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getNumero() {
            return $this->numero;
        }

        public function setNumero($numero) {
            $this->numero = $numero;
        }

        public function getPreco_Diaria() {
            return $this->preco_diaria;
        }

        public function setPreco_Diaria($preco_diaria) {
            $this->preco_diaria = $preco_diaria;
        }

         // Get e set do atributo que faz associação (normal)
        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }


        // Método para retornar uma string do objeto
        public function __toString() {
            return (string) $this->numero;
        }
                
    }