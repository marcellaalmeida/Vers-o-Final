<?php
    class ReservaHasQuartoDAO {
        public function create($reservaHasQuarto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO reserva_has_quarto(reserva_id_reserva, quarto_idquarto) 
                     VALUES (:r, :q)"
                );
                
                // Bind para as chaves estrangeiras
                $query->bindValue(':r',$reservaHasQuarto->getReserva()->getId(), PDO::PARAM_INT);
                $query->bindValue(':q',$reservaHasQuarto->getQuarto()->getId(), PDO::PARAM_INT);
                
                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        // Método read deverá filtrar Reservas a partir de um id de compra
        public function read($idReserva) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM reserva_has_quarto WHERE reserva_id_reserva = :r");
                $query->bindValue(':r',$idReserva, PDO::PARAM_INT);                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $compraReservas = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Reserva
                    $daoReserva = new ReservaDAO();
                    $Reserva = $daoReserva->find($linha['reserva_id_reserva']);  
                    $daoQuarto = new QuartoDAO();
                    $quarto = $daoQuarto->find($linha['quarto_idquarto']);

                   // Construindo um objeto do reserva
                    $reservaHasQuarto = new ReservaHasQuarto();
                    $reservaHasQuarto->setReserva($Reserva);                    
                    $reservaHasQuarto->setQuarto($quarto);

                    array_push($compraReservas,$reservaHasQuarto);
                }

                return $compraReservas;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        // Método destroy irá apagar um registro a partir da combinação das duas chaves primárias
        public function destroy($reserva_id_reserva, $quarto_idquarto) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM reserva_has_quarto 
                     WHERE reserva_id_reserva = :r and quarto_idquarto = :q"
                );
                $query->bindValue(':r',$reserva_id_reserva, PDO::PARAM_INT);
                $query->bindValue(':q',$quarto_idquarto, PDO::PARAM_INT);
                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }