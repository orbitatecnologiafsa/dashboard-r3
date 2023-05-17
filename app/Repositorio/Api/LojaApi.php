<?php


namespace  App\Repositorio\Api;

use App\Models\Loja;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class LojaApi
{

    protected $loja;
    protected $user;

    public function __construct()
    {
        $this->loja = new Loja();
        $this->user = new User();
    }

    /**
     *[cnpj_cliente] => 99999999999
     *[nome_loja] => hosana
     *[cnpj_loja] => 99999999999
     *[id_cliente] => 1
     */
    public function cadastro($loja)
    {

        $cadastro = [];
        $select =   $this->loja->where('cnpj_loja', $loja['cnpj_loja'])->get()->first();
        if (!$select) {
            if ($cadastro =  $this->loja->create($loja)) {

                return response()->json((object)["sucess" => true, "cnpj_cadastrado"  => $loja['cnpj_loja'], "id" => $cadastro->id], 200, ['Content-Type' => "application/json"]);
            }
            return response()->json(["sucess" => false, "cnpj_error"  => $loja['cnpj_loja'], "id" => $select->id], 200, ['Content-Type' => "application/json"]);
        }

        return response()->json(["sucess" => true, "cnpj_existe"  => $loja['cnpj_loja'], "id" => $select->id], 200, ['Content-Type' => "application/json", "Charset" => "utf-8"]);
    }

    public function atualizar($loja)
    {
        try {


            $select = $this->loja->where('id', $loja['id'])->get()->first();
            if ($select) {
                if ($this->loja->where('id',$loja['id'])->update($loja)) {
                    DB::statement('SET SQL_SAFE_UPDATES = 0;');
                    DB::update("update vendas set cnpj_loja =  ? where  cnpj_loja = ?", [$loja['cnpj_loja'], $select->cnpj_loja]);
                    DB::update("update caixas set cnpj_loja =  ? where  cnpj_loja = ?",  [$loja['cnpj_loja'], $select->cnpj_loja]);
                    DB::update("update estoques set cnpj_loja =  ? where  cnpj_loja =? ",  [$loja['cnpj_loja'], $select->cnpj_loja]);
                    DB::update("update estoques set cnpj_loja =  ? where  cnpj_loja =? ",  [$loja['cnpj_loja'], $select->cnpj_loja]);
                    DB::statement('SET SQL_SAFE_UPDATES = 1;');
                    return response()->json(["sucess" => true, "atualizar_loja"  => "success", "valor_antigo" => $select, "valor_novo" => $loja, "id" => $select->id], 200, ['Content-Type' => "application/json", "Charset" => "utf-8"]);
                }
                return response()->json(["sucess" => true, "atualizar_loja"  => "success", "valor_antigo" => $select, "valor_novo" => $loja, "id" => $select->id ?? 0], 200, ['Content-Type' => "application/json", "Charset" => "utf-8"]);
            }
        } catch (Exception $e) {
            return response()->json(["sucess" => false, "atualizar_loja"  => "error", "error" => $e->getMessage()], 200, ['Content-Type' => "application/json", "Charset" => "utf-8"]);
        }
    }
}
/**
 id_cliente,
 nome_loja,
 cnpj_loja,
 cnpj_cliente
 *
 */
