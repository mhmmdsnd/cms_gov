<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/23/2017
 * Time: 4:17 PM
 */
Class Berita extends CI_Controller {

    private $limit = 10;
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('trnkomunitas_model');
    }

    function index($komunitasId='', $offset=0, $order_column='beritaId', $order_type='asc')
    {
        if($this->session->userdata('logged_in'))
        {
            if (!$komunitasId) $komunitasId=NULL;
            if (!$offset) $offset=0;
            if (!$order_column) $order_column = 'beritaId';
            if (!$order_type) $order_type = 'asc';

            $data['result'] = $this->trnkomunitas_model->getKomunitasBerita($komunitasId,$this->limit, $offset, $order_column, $order_type);

            $config['base_url']=site_url('berita/index/');
            $config['total_rows']=$this->trnkomunitas_model->berita_count();
            $config['per_page']=$this->limit;
            $config['uri_segment']='3';
            $this->pagination->initialize($config);
            $data['paginator']=$this->pagination->create_links();

            //table data
            $this->template->set('title',$this->lang->line('title_news_list'));
            $this->template->load('cpanel/template','berita_view',$data);
        }
        else
        {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }
    function create($komunitasId='')
    {
        $session = $this->session->userdata('logged_in');
        if($session['id']) $author = $session['id'];
        else $author = $session['id'];

        if($komunitasId) {
            $komunitasId = $komunitasId;
            $data['komId'] = $komunitasId;
        }
        else {
            $komunitasId = $this->input->post('komunitasId');
            $data['komId'] = '';
        }

        $data['listkomunitas'] = $this->trnkomunitas_model->get_komunitas();

        $now = date('Y-m-d H:i:s'); #DATE TODAY
        if($this->input->post('action')==$this->lang->line('btn_submit')){
            $data_berita = array('komunitasId' => $komunitasId,
                'beritaTitle' => $this->input->post('beritaTitle'),
                'content'=>$this->input->post('content'),'tglberita'=>$now,
                'author'=>$author,'statusBerita'=>1);
            $this->trnkomunitas_model->berita_save($data_berita);
            //redirect
            redirect('berita/index/'.$komunitasId);
        }
        //table data
        $this->template->set('title',$this->lang->line('title_news_form'));
        $this->template->load('cpanel/template','berita_addupdate',$data);
    }
    function update($beritaId)
    {
        $session = $this->session->userdata('logged_in');
        if($session['id']) $author = $session['id'];
        else $author = $session['id'];

        $data['komId'] = '';
        $data['listkomunitas'] = $this->trnkomunitas_model->get_komunitas(); #list komunitas
        $data['detail'] = $this->trnkomunitas_model->berita_by_id($beritaId)->row();

        $now = date('Y-m-d H:i:s'); #DATE TODAY
        if($this->input->post('action')==$this->lang->line('btn_update')){
            $data_berita = array('komunitasId' => $this->input->post('komunitasId'),
                'beritaTitle' => $this->input->post('beritaTitle'),
                'content'=>$this->input->post('content'));
            $this->trnkomunitas_model->berita_update($beritaId, $data_berita);
            //redirect
            redirect('berita/');
        }
        //table data
        $this->template->set('title',$this->lang->line('title_news_form'));
        $this->template->load('cpanel/template','berita_addupdate',$data);
    }
    function detail($beritaId)
    {
        $data['detail'] = $this->trnkomunitas_model->berita_by_id($beritaId)->row();

        //table data
        $this->template->set('title',$this->lang->line('title_news_form'));
        $this->template->load('cpanel/template','berita_addupdate',$data);
    }
    function delete()
    {
        $id = $this->uri->segment(3);
        $this->trnkomunitas_model->berita_delete($id);
        redirect('berita/', '');
    }
    function process($beritaId,$statusBerita)
    {
        $update = array('statusBerita'=>$statusBerita);
        $this->trnkomunitas_model->berita_update($beritaId,$update);
        redirect('berita/');
    }

}