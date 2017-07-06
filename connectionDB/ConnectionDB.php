<?php


    function getbdd(){
        try{
                $hote='localhost';
                $port='3306';
                $db= 'paris_asmoza';
                $user='root';
                $password='';

                return new PDO('mysql:host='.$hote.
                    ';port='.$port.
                    ';dbname='.$db,
                    $user,
                    $password,
                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
                );

        }
        catch(\Exception $e){
            echo 'Là il y a une erreur : '.$e->getTraceAsString();
        }
    }

    /**
     * fonction de requetage de base de données
     * @param $sql
     * @param null $params
     * @return mixed
     */
     function executeRequest($cxn, $sql, $params = null)
    {
        if ($params == null) {
            $result = $cxn->query($sql);
        } else {
            $result = $cxn->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }

























