<?php

class Acesso
{
	
	public function acessoAdmin($login, $senha, $dt, $empresa)
	{
		if ($login != '' && $senha != '' && $dt != '' && $empresa != '') {
			try {  
                $stmt = Conexao::getInstance()->prepare('SELECT * FROM ACESSO_ADM
                										 WHERE LOGIN = :login
                										 AND SENHA = :senha
                                                         AND EMPRESA = :empresa');
                $stmt->bindParam(':login', $login);
                $stmt->bindParam(':senha', md5($senha));
                $stmt->bindParam(':empresa', $empresa);

                $stmt->execute();

                $final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($final_result)) {
                	$this->openSession($final_result[0]['LOGIN']);
                	return $this->setLogAdmin($login, $dt, $empresa);
                }
                return 'acesso negado';
            } catch (Exception $e) {
                return $e->getMessage();
            }
		}
        return 'Parâmetros incorretos!';
	}

    private function setLogAdmin($login, $dt, $empresa)
    {
        try {  
                $stmt = Conexao::getInstance()->prepare('INSERT INTO LOG_ADMIN
                                                                            (
                                                                                LOGIN, 
                                                                                DT_ACESSO, 
                                                                                EMPRESA
                                                                            )
                                                                    VALUES  (
                                                                                :login,
                                                                                :dt,
                                                                                :empresa
                                                                            );');
                
                $stmt->bindParam(':login', $login);
                $stmt->bindParam(':dt', $dt);
                $stmt->bindParam(':empresa', $empresa);
                $stmt->execute();
                return 'ok';
            } catch (Exception $e) {
                return $e->getMessage();
            }
    }

	private function openSession($loginUser)
	{
		$_SESSION['login_personal_adm'] = $loginUser;
	}
}