<?php


namespace App\Repositorio\Database;

use App\Repositorio\Database\Tabelas\TabelaCaixa;
use App\Repositorio\Database\Tabelas\TabelaEstoque;
use App\Repositorio\Database\Tabelas\TabelaVenda;
use Exception;
use Illuminate\Support\Facades\Config;
use PDO;

class DatabaseRepositorio
{

    protected $es_caixa;
    protected $es_estoque;
    protected $es_venda;

    public function __construct()
    {
        $this->es_estoque = new TabelaEstoque();
        $this->es_venda = new TabelaVenda();
        $this->es_caixa = new TabelaCaixa();
        $this->setConfigDBInstancia(session()->get('db_instancia'));
    }

    public function Conn()
    {
        try {

            $conn = new PDO("mysql:host;port=3306;", 'root', '', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            return 'error';
        }
    }

    public function criarBanco($instancia)
    {

        try {
            $conn = $this->Conn();
            if (!is_null($conn)) {

                $sql = "CREATE DATABASE IF NOT EXISTS $instancia CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;set global net_buffer_length=1000000;
                set global max_allowed_packet=1000000000;";
                $conn->beginTransaction();
                $banco = $conn->exec($sql);

                if ($banco) {
                    $this->criarTablela($instancia);
                    return true;
                }
            }
            throw new Exception("Erro ao criar o banco de dados $instancia, reveja os dados informados no .env!");
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function ConnDbInstancia($instancia)
    {

        try {
            $conn = new PDO("mysql:" . env('DB_HOST') . ";port=" . env('DB_PORT') . ";dbname=$instancia;", env('DB_USERNAME'), env('DB_PASSWORD'), [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function criarTablela($instancia)
    {
        try {
            $tabelaEstoque = $this->es_estoque->gerarTabela();
            $tabelaVenda = $this->es_venda->gerarTabela();
            $tabelaCaixa = $this->es_caixa->gerarTabela();
            $conn = $this->ConnDbInstancia($instancia);
            $conn->beginTransaction();
            $conn->exec("USE $instancia;");
            $conn->exec($tabelaEstoque);
            $conn->exec($tabelaVenda);
            $conn->exec($tabelaCaixa);
            $conn->commit();
            $this->closePDO($conn);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function closePDO(PDO $pdo)
    {
        return $pdo = null;
    }

    public function setConfigDBInstancia($instancia = null)
    {
        return Config::set('database.connections.mysql2.database', !is_null($instancia) ? $instancia : session()->get('db_instancia'));
    }
}
