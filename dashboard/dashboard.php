<?php
class dashboard
{

    // database connection and table name
    private $conn;
    public $monto1;
    public $cantidadcitas;
    public $cantidadconsultas;
    public $cantidadcitasvencidas;
    public $tblcitas;
    public $tblconsultas;





    public $codigousuario;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // GET ALL
    function dash()
    {
        // P = pendiente
        // R = Realizado
        // A = Anulado
        // C = En proceso

        try {
            $sqlQuery = "SELECT  IFNULL(sum(monto),0)  as  monto1 FROM consulta WHERE estado = 'F' and  fecha =  CURRENT_DATE()";
       

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();

            $num = $stmt->rowCount();

            // return $stmt;

            $sqlQuery2 = "SELECT count(*) as  cantidadcitas FROM citas WHERE fecha = CURRENT_DATE() and estado = 'A'  ";

            $stmt2 = $this->conn->prepare($sqlQuery2);
            // bind given email value
            $stmt2->execute();

            $sqlQuery3 = "SELECT  count(*) as  cantidadconsultas FROM consulta WHERE estado in('A','F') and fecha  = CURRENT_DATE()";

            $stmt3 = $this->conn->prepare($sqlQuery3);
            // bind given email value
            $stmt3->execute();


            $sqlQuery8 = "SELECT count(*) as  cantidadcitas2 FROM citas WHERE fecha < CURRENT_DATE() and estado = 'A'  ";

            $stmt8 = $this->conn->prepare($sqlQuery8);
            // bind given email value
            $stmt8->execute();
          
            $sqlQuery5 = "SELECT b.nombre,
       a.horario FROM citas a, paciente b
       where a.id_paciente = b.id_paciente
       and a.fecha = CURRENT_DATE()";
      

            $stmt5 = $this->conn->prepare($sqlQuery5);
            $stmt5->execute();

            $sqlQuery6 = "SELECT 
       b.nombre,
       a.monto
       FROM consulta a, paciente b 
       where a.id_paciente = b.id_paciente
       and a.estado = 'F'
       and a.fecha = CURRENT_DATE()";

            $stmt6 = $this->conn->prepare($sqlQuery6);
            // bind given email value
            $stmt6->execute();

            if ($num > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                $row4 = $stmt8->fetch(PDO::FETCH_ASSOC);
                $row5 = $stmt5->fetchall(PDO::FETCH_ASSOC);
                $row6 = $stmt6->fetchall(PDO::FETCH_ASSOC);


                $this->monto1 = $row['monto1'];
                $this->cantidadcitas = $row2['cantidadcitas'];
                $this->cantidadconsultas = $row3['cantidadconsultas'];
                $this->cantidadcitasvencidas = $row4['cantidadcitas2'];
                $this->tblcitas= $row5;
                $this->tblconsultas = $row6;

                return true;
            }
        } catch (PDOException $exception) {
            var_dump($exception);


            return false;
        }

        return false;
    }
}
