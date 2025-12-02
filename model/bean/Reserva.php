<?php
    class Reserva {
        // Atributos
        private $id;
        private $data_checkin;
        private $data_checkout;
        private $valor_total;
        private $funcionario; // Associação com a classe TipoProduto
        private $hospede; // Associação com a classe TipoProduto
        private $status_reserva; // Associação com a classe TipoProduto
        private $quarto; // Associação com a classe TipoProduto

        // Métodos
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getData_Checkin() {
            return $this->data_checkin;
        }

        public function setData_Checkin($data_checkin) {
            $this->data_checkin = $data_checkin;
        }

        public function getData_Checkout() {
            return $this->data_checkout;
        }

        public function setData_Checkout($data_checkout) {
            $this->data_checkout = $data_checkout;
        }

        public function getValor_Total() {
            return $this->valor_total;
        }

        public function setValor_Total($valor_total) {
            $this->valor_total = $valor_total;
        }
        
        // Get e set do atributo que faz associação (normal)
        public function getFuncionario() {
            return $this->funcionario;
        }

        public function setFuncionario($funcionario) {
            $this->funcionario = $funcionario;
        }

         public function getHospede() {
            return $this->hospede;
        }

        public function setHospede($hospede) {
            $this->hospede = $hospede;
        }

         public function getStatus_Reserva() {
            return $this->status_reserva;
        }

        public function setStatus_Reserva($status_reserva) {
            $this->status_reserva = $status_reserva;
        }

        // Método para retornar uma string do objeto
        public function __toString() {
            return $this->data_checkin;
        }
    }