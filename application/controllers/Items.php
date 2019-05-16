<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends MY_Controller
{
	public function index(){
        $data = $this->ion_auth_data;
        $this->load->model('Item_model', 'item');
        $data['items'] = $this->item->where('active', 1)->as_array()->get_all();
        $this->load->view('items/items_list', $data);
    }
}