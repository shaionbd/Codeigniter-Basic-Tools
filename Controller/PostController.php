<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostController extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function _loader(){
		/*
		* 
		* Load all the Model to use database
		* Load all the library
		*
		*/
		$this->load->model('post');
		$this->load->model('user');
		$this->load->model('like');
		$this->load->library('form_validation');
	}

	public function index(){
		// load all dependency
		$this->_loader();		
		$data = $this->post->all();
		
		$this->parser->parse('home',['data' => $data, 'title'=>'Social Site']);
		//$this->load->view('welcome_message',['data' => $data]);
	}
	public function getPost(){
		// load all dependency
		$this->_loader();		
		$data = $this->post->find($this->user());
		$this->parser->parse('home',['posts' => $data, 'title'=>'Social Site | Post']);
		//$this->load->view('welcome_message',['data' => $data]);
	}

	function postCreatePost(){
		// load all dependency
		$this->_loader();
		// check authenticate
		if($this->user()){
			// get body value from form
			$body = $this->input->post('body');
			/*
			*
			* Check the validation of submitting form
			* Server side validation is need since
			*		 Client side validation can be modified by {Hacker}
			*
			*/
			$this->form_validation->set_rules('body','Post Body','required|min_length[1]');
			// check the validation error
			if ($this->form_validation->run() == FALSE){
				$this->parser->parse('pages/login',['title'=> 'Social Site | Login']);
			}else{
				// create data object to insert in database
				$data = new stdClass;
				$data->body = $body;
				$data->user_id = $this->user();

				// check if data is inserted
				if($this->post->save($data)){
					$this->session->set_flashdata('successmessage', 'Post has created!!!');
					return redirect('/');			
				}else{
					$this->session->set_flashdata('errormessage', 'Something went wrong!!');
				}
				
			}
		}
		$this->session->set_flashdata('errormessage', 'You are not authenticated!!');
	}

	public function getPostUpdate($id){
		// load all dependency
		$this->_loader();

		// get the updated value from form
		$body = $this->input->get('post-body');
		/*
		*
		* Check the validation of submitting form
		* Server side validation is need since
		*		 Client side validation can be modified by {Hacker}
		*
		*/

		// find the value of id in {db}
		$editPost = $this->post->find($id);
		if($editPost && isset($body)){
			//check if the user is authenticated
			if($this->isUser($editPost->user_id)){
				// update the db
				$data = new stdClass;
				$data->body = $body;
				$this->post->update($id, $data);
				// Set success message and redirect to home page
				$this->session->set_flashdata('successmessage','Post has been updated');
			}else{
				// Set error message and redirect to home page
				$this->session->set_flashdata('errormessage','Sorry!!! You are not authorized to update this post !!!');
			}
		}else{
			$this->session->set_flashdata('errormessage','Sorry!!! No post found !!!');
		}
		return redirect('/');
	}

	public function getPostDelete($id){
		// load all dependency
		$this->_loader();

		// find the value of id in {db}
		$getPost= $this->post->find($id);

		//check if the user is authenticated
		if($this->isUser($getPost->user_id)){
			if($getPost){
				if($this->post->delete($id)){
					$this->session->set_flashdata('successmessage','Post has been removed!!');
				}
			}else{
				$this->session->set_flashdata('errormessage','Sorry!!! No post found !!!');
			}
		}else{
			$this->session->set_flashdata('errormessage','Sorry!!! You are not authorized to update this post !!!');
		}
		return redirect('/');
	}

	public function getPostLike(){
		$this->_loader();
		//get post id of like link
		$id = $_GET['postid'];
		$message = '';

		// find if it is already 
		$postLike = $this->like->find($id);

		if($postLike){
			$this->like->delete($postLike->id);
			$message = 'Like';
		}else{
			$like = new stdClass;
			$like->user_id = $this->user();
			$like->is_like = 1;
			$like->post_id = $id;
			$this->like->save($like);
			$message = 'Liked';
		}
		echo $message;
	}

	public function getPostAPI(){

		$this->load->model('post');
		$posts = $this->post->getAllPosts();

		$json = file_get_contents(APPPATH . 'views/api/post.json');
		$data = json_decode($json);
		$data = array();
		foreach($posts as $post){
			$data[] =  (array)$post;
		}
		$jsonEn=json_encode($data);
		echo print_r($jsonEn);
	}
}