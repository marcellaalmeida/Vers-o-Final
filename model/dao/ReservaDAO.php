<?php
class ReservaDAO {
    public function create($reserva) {
        try {
            $query = BD::getConexao()->prepare(
                "INSERT INTO reserva(data_checkin,data_checkout,valor_total,funcionario_id_funcionario,hospede_id_hospede,status_reserva_idstatus_reserva) 
                VALUES (:d, :c, :v, :f, :h, :s)"
            );
            $query->bindValue(':d',$reserva->getData_Checkin(), PDO::PARAM_STR);
            $query->bindValue(':c',$reserva->getData_Checkout(), PDO::PARAM_STR);
            $query->bindValue(':v',$reserva->getValor_Total(), PDO::PARAM_STR);
            $query->bindValue(':f',$reserva->getFuncionario()->getId(), PDO::PARAM_INT);
            $query->bindValue(':h',$reserva->getHospede()->getId(), PDO::PARAM_INT);
            $query->bindValue(':s',$reserva->getStatus_Reserva()->getIdStatusReserva(), PDO::PARAM_INT);

            if(!$query->execute())
                print_r($query->errorInfo());
        }
        catch(PDOException $e) {
            echo "Erro #1: " . $e->getMessage();
        }
    }

    public function read() {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM reserva");                

            if(!$query->execute())
                print_r($query->errorInfo());

            $reservas = array();
            foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                // VERIFICAÇÃO DE SEGURANÇA
                if (!$linha) continue;
                
                $daoFuncionario = new FuncionarioDAO();
                $funcionario = $daoFuncionario->find($linha['funcionario_id_funcionario']);
                
                $daoHospede = new HospedeDAO();
                $hospede = $daoHospede->find($linha['hospede_id_hospede']);
                
                $daoStatus = new StatusReservaDAO();
                $statusreserva = $daoStatus->find($linha['status_reserva_idstatus_reserva']);

                $reserva = new Reserva();
                $reserva->setId($linha['id_reserva']);
                $reserva->setData_Checkin($linha['data_checkin']);
                $reserva->setData_Checkout($linha['data_checkout']);
                $reserva->setValor_Total($linha['valor_total']);
                $reserva->setFuncionario($funcionario);
                $reserva->setHospede($hospede);
                $reserva->setStatus_Reserva($statusreserva);

                array_push($reservas,$reserva);
            }
            return $reservas;
        }
        catch(PDOException $e) {
            echo "Erro #2: " . $e->getMessage();
        }
    }
    
    public function find($id) {
        try {
            $query = BD::getConexao()->prepare("SELECT * FROM reserva WHERE id_reserva = :i");
            $query->bindValue(':i', $id, PDO::PARAM_INT);             

            if(!$query->execute())
                print_r($query->errorInfo());

            $linha = $query->fetch(PDO::FETCH_ASSOC);
            
            // VERIFICAÇÃO DE SEGURANÇA
            if (!$linha) {
                return null;
            }
            
            $daoFuncionario = new FuncionarioDAO();
            $funcionario = $daoFuncionario->find($linha['funcionario_id_funcionario']);
            
            $daoHospede = new HospedeDAO();
            $hospede = $daoHospede->find($linha['hospede_id_hospede']);
            
            $daoStatus = new StatusReservaDAO();
            $statusreserva = $daoStatus->find($linha['status_reserva_idstatus_reserva']);

            $reserva = new Reserva();
            $reserva->setId($linha['id_reserva']);
            $reserva->setData_Checkin($linha['data_checkin']);
            $reserva->setData_Checkout($linha['data_checkout']);
            $reserva->setValor_Total($linha['valor_total']);
            $reserva->setFuncionario($funcionario);
            $reserva->setHospede($hospede);
            $reserva->setStatus_Reserva($statusreserva);

            return $reserva;
        }
        catch(PDOException $e) {
            echo "Erro #3: " . $e->getMessage();
        }
    }

    public function update($reserva) {
        try {
            $query = BD::getConexao()->prepare(
                "UPDATE reserva 
                 SET data_checkin = :d, data_checkout = :c, valor_total = :v, 
                     funcionario_id_funcionario = :f, hospede_id_hospede = :h, 
                     status_reserva_idstatus_reserva = :s
                 WHERE id_reserva = :i"
            );
            $query->bindValue(':d',$reserva->getData_Checkin(), PDO::PARAM_STR);
            $query->bindValue(':c',$reserva->getData_Checkout(), PDO::PARAM_STR);
            $query->bindValue(':v',$reserva->getValor_Total(), PDO::PARAM_STR);
            $query->bindValue(':f',$reserva->getFuncionario()->getId(), PDO::PARAM_INT);
            $query->bindValue(':h',$reserva->getHospede()->getId(), PDO::PARAM_INT);
            $query->bindValue(':s',$reserva->getStatus_Reserva()->getIdStatusReserva(), PDO::PARAM_INT);
            $query->bindValue(':i',$reserva->getId(), PDO::PARAM_INT);

            if(!$query->execute())
                print_r($query->errorInfo());
        }
        catch(PDOException $e) {
            echo "Erro #4: " . $e->getMessage();
        }
    }

    public function destroy($id) {
        try {
            $query = BD::getConexao()->prepare(
                "DELETE FROM reserva 
                 WHERE id_reserva = :i"
            );
            $query->bindValue(':i',$id, PDO::PARAM_INT);

            if(!$query->execute())
                print_r($query->errorInfo());
        }
        catch(PDOException $e) {
            echo "Erro #5: " . $e->getMessage();
        }
    }
}