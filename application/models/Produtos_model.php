<?php

defined('BASEPATH') or exit('Ação não permitida');

class Produtos_model extends CI_Model {
    
    public function get_all () {
        
        $this->db->select([
            'produtos.*',
            'categorias.categoria_id',
            'categorias.categoria_nome as produto_categoria',
            'marcas.marca_id',
            'marcas.marca_nome as produto_marca',
            'fornecedores.fornecedor_id',
            'fornecedores.fornecedor_nome_fantasia as produto_fornecedor',
            
        ]);
        $this->db->join('categorias','categoria_id = produto_categoria_id','LEFT');
        $this->db->join('marcas','marca_id = produto_marca_id','LEFT');
        $this->db->join('fornecedores','fornecedor_id = produto_fornecedor_id','LEFT');
        
        return $this->db->get('produtos')->result();
    }
    
}