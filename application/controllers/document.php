<?php
class Document extends SS_controller{
	
	var $list_args;
	
	var $section_title='文件';
	
	function __construct(){
		parent::__construct();
		
		$controller=CONTROLLER;
		
		$this->list_args=array(
			'name'=>array('heading'=>'文件名','parser'=>array('function'=>function($id,$name,$filename){
				if($name==''){
					$name=$filename;
				}
				return '<a href="/document/download/'.$id.'">'.$name.'</a>';
			},'args'=>array('{id}','{name}','{filename}'))),
			'time_insert'=>array('heading'=>'上传时间','parser'=>array('function'=>function($time_insert){return date('Y-m-d H:i',$time_insert);},'args'=>array('{time_insert}'))),
			'labels'=>array('heading'=>'标签','parser'=>array('function'=>array($this->$controller,'getCompiledLabels'),'args'=>array('{id}')))
		);
	}
	
	function index(){
		
		$this->config->set_user_item('search/orderby', 'document.id desc', false);
		$this->config->set_user_item('search/limit', 'pagination', false);
		
		if($this->input->get('labels')!==false){
			$labels=explode(' ',urldecode($this->input->get('labels')));
			$this->config->set_user_item('search/labels', $labels, false);
		}
		
		$search_items=array('name','labels');
		
		foreach($search_items as $item){
			if($this->input->post($item)!==false){
				if($this->input->post($item)!==''){
					$this->config->set_user_item('search/'.$item, $this->input->post($item));
				}else{
					$this->config->unset_user_item('search/'.$item);
				}
			}
		}
		
		if($this->input->post('submit')==='search' && $this->input->post('labels')===false){
			$this->config->unset_user_item('search/labels');
		}
		
		if($this->input->post('submit')==='search_cancel'){
			foreach($search_items as $item){
				$this->config->unset_user_item('search/'.$item);
			}
		}
		
		$table=$this->table->setFields($this->list_args)
			->setData($this->document->getList($this->config->user_item('search')))
			->generate();
		
		$this->load->addViewData('list',$table);
		
		$this->load->view('list');
		
		if(file_exists(APPPATH.'/views/'.CONTROLLER.'/list_sidebar'.EXT)){
			$this->load->view(CONTROLLER.'/list_sidebar',true,'sidebar');
		}else{
			$this->load->view('document/list_sidebar',true,'sidebar');
		}

	}

	function download($id){
		$document=$this->document->fetch($id);
		
		$this->document->exportHead($document['filename']);
		
		$filename='../uploads/'.$document['id'];
		
		$filename=iconv("utf-8","gbk",$filename);//Windows服务器的文件名采用gbk编码保存
		readfile($filename);
	}
	
	function submit(){
		
		$config=array(
			'upload_path'=>'../uploads/',
			'allowed_types'=>'*',
			'encrypt_name'=>true
		);
		
		$this->load->library('upload', $config);
		$this->document->data=$this->input->sessionPost('');
		$this->document->labels=$this->input->sessionPost('labels');
		
		try{
			if (!$this->upload->do_upload('document')) {
				$this->output->message($this->upload->display_errors(), 'warning');
				throw new Exception;
			}
			
			$file_info = $this->upload->data();
			
			$file_info['mail_name']=substr($file_info['client_name'], 0, -strlen($file_info['file_ext']));
			
			$document_id=$this->document->add(array(
				'name'=>$file_info['mail_name'],
				'filename'=>$file_info['client_name'],
				'extname'=>$file_info['file_ext'],
				'size'=>$file_info['file_size']
			));
			
			rename('../uploads/'.$file_info['file_name'],'../uploads/'.$document_id);
			
			$data=array(
				'id'=>$document_id,
				'name'=>$file_info['mail_name']
			);
			$this->output->data=$data;
			
		}catch(Exception $e){
			$this->output->status='fail';
		}
		
		$this->output->as_ajax=true;

	}
	
	function update($id){
		if($this->input->post('document')){
			$this->document->update($id,$this->input->post('document'));
		}
	}
}
?>