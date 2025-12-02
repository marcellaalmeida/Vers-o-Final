<?php
    class ReservaHasQuarto {
        // Atributos
        private $reserva; // Associação com a classe Reserva
        private $quarto; // Associação com a classe Quarto

        // Métodos
        public function getReserva() {
            return $this->reserva;
        }

        public function setReserva($reserva) {
            $this->reserva = $reserva;
        }

        public function getQuarto() {
            return $this->quarto;
        }

        public function setQuarto($quarto) {
            $this->quarto = $quarto;
        }

    }