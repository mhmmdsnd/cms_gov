<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/13/2017
 * Time: 6:59 PM
 */
class Trnkomunitas_model extends CI_Model
{
    private $trn_komunitas = "trn_komunitas";
    private $trn_berita = "trn_berita";
    private $pk_komunitas = 'komunitasId';
    private $pk_berita = 'beritaId';

    #START KOMUNITAS
    function get_paged_list($limit=10,$offset=0, $order_column='',$order_type='asc')
    {
        $dtkomunitas = array();
        $this->db->select('komunitasId, komunitasName, komunitasDesc, Author, komunitasStatus, reftypeName ');
        $this->db->from($this->trn_komunitas);
        $this->db->join('sys_reftype',$this->trn_komunitas.'.komunitasStatus = sys_reftype.reftypeCode and reftypeGroup = "statusKomunitas"','inner');
        $this->db->where('komunitasStatus = 1');
        if (empty($order_column)||empty($order_type))
            $this->db->order_by($this->pk_komunitas,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        $this->db->limit($limit,$offset);
        $result = $this->db->get();
        foreach ($result->result() as $rst)
        {
            $dtkomunitas[] = array('komunitasId' =>$rst->komunitasId, 'komunitasName'=>$rst->komunitasName,'komunitasDesc'=>$rst->komunitasDesc,
                'Author'=>$rst->Author,'komunitasStatus'=>$rst->komunitasStatus, 'reftypeName'=>$rst->reftypeName);
        }
        return $dtkomunitas;
    }
    function count_all()
    {
        return $this->db->count_all($this->trn_komunitas);
    }
    function get_by_id ($id)
    {
        $this->db->where($this->pk_komunitas,$id);
        return $this->db->get($this->trn_komunitas);
    }
    function save($data)
    {
        $this->db->insert($this->trn_komunitas,$data);
        return $this->db->insert_id();
    }
    function update ($id, $data)
    {
        $this->db->where($this->pk_komunitas,$id);
        $this->db->update($this->trn_komunitas,$data);
    }
    function delete ($id)
    {
        $this->db->where($this->pk_komunitas,$id);
        $this->db->delete($this->trn_komunitas);
    }
    #START FRONT.KOMUNITAS
    function komunitasView()
    {
        $this->db->order_by($this->pk_komunitas,'desc');
        return $this->db->get($this->trn_komunitas);
    }
    function statusKomunitas($id,$data)
    {
        $this->db->where($this->pk_komunitas,$id);
        $this->db->update($this->trn_komunitas,$data);
    }
    function get_komunitas()
    {
        $this->db->order_by($this->pk_komunitas,'asc');
        $hasil = $this->db->get($this->trn_komunitas);
        foreach ($hasil->result_array() as $list)
        {
            $result[''] = "Select ...";
            $result[$list['komunitasId']] = $list['komunitasName'];
        }
        return $result;
    }
    #END FRONT.KOMUNITAS
    #END KOMUNITAS

    #START BERITA
    function getKomunitasBerita ($komunitasId, $limit=10,$offset=0, $order_column='',$order_type='asc')
    {
        $dtkomunitas = array();
        $this->db->select('beritaId, '.$this->trn_berita.'.komunitasId, komunitasName,  beritaTitle, tglberita
        , concat(firstname," ",lastname) as username,  reftypeName ');
        $this->db->from($this->trn_berita);
        $this->db->join('sys_reftype',$this->trn_berita.'.statusBerita = sys_reftype.reftypeCode and reftypeGroup = "statusBerita"','inner');
        $this->db->join($this->trn_komunitas,$this->trn_berita.'.komunitasId = '.$this->trn_komunitas.'.komunitasId','inner');
        $this->db->join('sys_users',$this->trn_berita.'.author = sys_users.id','inner');
        if ($komunitasId != NULL) $this->db->where($this->trn_berita.'.komunitasId = "'.$komunitasId.'"');
        if (empty($order_column)||empty($order_type))
            $this->db->order_by($this->pk_berita,'asc');
        else
            $this->db->order_by($order_column,$order_type);
        $this->db->limit($limit,$offset);
        $result = $this->db->get();
        foreach ($result->result() as $rst)
        {
            $dtkomunitas[] = array('beritaId' =>$rst->beritaId, 'beritaTitle'=>$rst->beritaTitle,'tglberita'=>$rst->tglberita,
                'komunitasName'=>$rst->komunitasName,'reftypeName'=>$rst->reftypeName,'komunitasId'=>$rst->komunitasId);
        }
        return $dtkomunitas;
    }
    function berita_count()
    {
        return $this->db->count_all($this->trn_berita);
    }
    function berita_by_id ($beritaId)
    {
        $this->db->where($this->pk_berita,$beritaId);
        return $this->db->get($this->trn_berita);
    }
    function berita_save($data)
    {
        $this->db->insert($this->trn_berita,$data);
        return $this->db->insert_id();
    }
    function berita_update ($beritaId, $data)
    {
        $this->db->where($this->pk_berita,$beritaId);
        $this->db->update($this->trn_berita,$data);
    }
    function berita_delete ($beritaId)
    {
        $this->db->where($this->pk_berita,$beritaId);
        $this->db->delete($this->trn_berita);
    }
    #START FRONT.BERITA
    function beritaView($id)
    {
        $this->db->where($this->pk_komunitas,$id);
        return $this->db->get($this->trn_berita);
    }
    #END FRONT.BERITA
    #END BERITA
}