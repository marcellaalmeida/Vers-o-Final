<?php
    class QuartoDAO {
        public function create($quarto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO quarto(numero, preco_diaria, status_idstatus, tipo_idtipo) 
                     VALUES (:n, :p, :s, :t)"
                );
                
                $query->bindValue(':n',$quarto->getNumero(), PDO::PARAM_INT);
                $query->bindValue(':p',$quarto->getPreco_Diaria(), PDO::PARAM_STR);

                // Bind para a chave estrangeira
                $query->bindValue(':s',$quarto->getStatus()->getIdStatus(), PDO::PARAM_INT);
                $query->bindValue(':t',$quarto->getTipo()->getIdTipo(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM quarto");                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $quartos = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Funcionário

                    $daoStatus = new StatusDAO();
                    $status = $daoStatus->find($linha['status_idstatus']);

                    $daoTipo = new TipoDAO();
                    $tipo = $daoTipo->find($linha['tipo_idtipo']);

                    // Construindo um objeto do Gerente
                    $quarto = new Quarto();
                    $quarto->setId($linha['idquarto']);
                    $quarto->setNumero($linha['numero']);
                    $quarto->setPreco_Diaria($linha['preco_diaria']);

                    // Definir o atributo (objeto) Funcionário

                    $quarto->setStatus($status);
                    $quarto->setTipo($tipo);

                    array_push($quartos,$quarto);
                }

                return $quartos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
        
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM quarto WHERE idquarto = :i"); //Ver aquiiiii
                $query->bindValue(':i', $id, PDO::PARAM_INT);             

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                // Para a associação com o Funcionário

                $daoStatus = new StatusDAO();
                $status = $daoStatus->find($linha['status_idstatus']);

                $daoTipo = new TipoDAO();
                $tipo = $daoTipo->find($linha['tipo_idtipo']);

                // Construindo um objeto do Gerente
                $quarto = new Quarto();
                $quarto->setId($linha['idquarto']);
                $quarto->setNumero($linha['numero']);
                $quarto->setPreco_Diaria($linha['preco_diaria']);
                // Definir o atributo (objeto) Funcionário

                $quarto->setStatus($status);
                $quarto->setTipo($tipo);

                return $quarto;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function update($quarto) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE quarto 
                     SET numero = :n, preco_diaria = :p, status_idstatus = :s,  tipo_idtipo = :t
                     WHERE idquarto = :i"
                );
                $query->bindValue(':n',$quarto->getNumero(), PDO::PARAM_INT);
                $query->bindValue(':p',$quarto->getPreco_Diaria(), PDO::PARAM_STR);
                // Bind para a chave estrangeira
                $query->bindValue(':s',$quarto->getStatus()->getIdStatus(), PDO::PARAM_INT);
                $query->bindValue(':t',$quarto->getTipo()->getIdTipo(), PDO::PARAM_INT);
                $query->bindValue(':i',$quarto->getId(), PDO::PARAM_INT);

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
                    "DELETE FROM quarto 
                     WHERE idquarto = :i"
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