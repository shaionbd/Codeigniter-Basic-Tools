<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends MY_Controller {

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
	protected function _loader(){
		/*
		* 
		* Load all the Model to use database
		* Load all the library
		*
		*/
		$this->load->model('post');
		$this->load->model('user');
		$this->load->library('form_validation');
	}
	public function index(){
		// load all dependency
		$this->_loader();	
		$data = (array)$this->user->find($this->user());
		
		$this->parser->parse('pages/account',['data' => $data, 'title'=>'Social Site | Account']);
		/*
		*
		* For Blade Template we can use 
		* $this->load->view('welcome_message',['data' => $data]);
		*
		* view is the custom function
		*			Orginal function of the library is function render(){}
		*
		*/
	}
	//get the login page for {/login} url
	public function getLogin(){
		if($this->user())
			return redirect('/');
		$this->parser->parse('pages/login',['title'=> 'Social Site | Login']);
	}

	public function postSignIn(){
		/*
		* 
		* Load all the Model to use database
		* Load all the library
		*
		*/
		$this->_loader();
		
		// get email and password from sign_in form
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		/*
		*
		* Check the validation of submitting form
		* Server side validation is need since
		*		 Client side validation can be modified by {Hacker}
		*
		*/
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('password','Password','required|min_length[4]');

		// check the validation error
		if ($this->form_validation->run() == FALSE){
            $this->parser->parse('pages/login',['title'=> 'Social Site | Login']);
        }
        else{
        	/*
					* Login Validation
					* Check for login 
					* if email and password match then
					*		 redirect to home page
					* Before redirect to home page
					*		 Start session
					*		 Set the user_id to the session via auth()
        	*/
        	if($user_id = $this->user->check($email,$password)){
        		$this->auth($user_id);
        		return redirect('/');
        	}else{
        		/*
						* Login Fail
						* Return the Login Page with error message
						* with Temporary session
        		*/
        		$message = 'Wrong email or password';
        		$this->session->set_flashdata('errormessage', $message);
        		// return to login page
        		$this->parser->parse('pages/login',['title'=> 'Social Site | Login']);
        	}
        }

	}
	public function postSignUp(){
		/*
		* 
		* Load all the Model to use database
		* Load all the library
		*
		*/
		$this->_loader();
		
		// get email and password from sign_in form
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		/*
		*
		* Check the validation of submitting form
		* Server side validation is need since
		*		 Client side validation can be modified by {Hacker}
		*
		*/
		$this->form_validation->set_rules('fname','First Name','required|min_length[1]');
		$this->form_validation->set_rules('lname','Last Name','required|min_length[1]');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]',
			[
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
        	]
		);
		$this->form_validation->set_rules('password','Password','required|min_length[4]');

		// check the validation error
		if ($this->form_validation->run() == FALSE){
			$this->parser->parse('pages/login',['title'=> 'Social Site | Login']);
		}else{
			// create data object to insert in database
			$data = new stdClass;
			$data->fname = $fname;
			$data->lname = $lname;
			$data->email = $email;
			$data->password = $password;

			// check if data is inserted
			if($this->user->save('users', $data)){
				$this->session->set_flashdata('successmessage', 'Account has been created!!');
				return redirect('login');			
			}else{
				$this->session->set_flashdata('errormessage', 'Something went wrong!!');
			}
			
		}
	}
	public function postUserAccount(){
		/*
		* 
		* Load all the Model to use database
		* Load all the library
		*
		*/
		$this->_loader();

		// get email and password from sign_in form
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$image = $_FILES['user_image']['name'];

		// change image name
		$new_name=str_replace(' ', '_', $image);

		/*
		*
		* Check the validation of submitting form
		* Server side validation is need since
		*		 Client side validation can be modified by {Hacker}
		*
		*/
		$this->form_validation->set_rules('fname','First Name','required|min_length[1]');
		$this->form_validation->set_rules('lname','Last Name','required|min_length[1]');
		
		// update users table of db
		$data = $this->user->find($this->user());
		$data->fname = $fname;
		$data->lname = $lname;
		$data->image = $new_name;
		$this->parser->parse('pages/account',['title'=>'Social Site | Account','data'=>(array)$data]);


		// upload image in asset/img file
		$this->do_upload($new_name);

		if($this->user->update($this->user(), $data)){
			$this->session->set_flashdata('successmessage', 'Account has been updated!!');
			return redirect('account');
		}else{
			$this->session->set_flashdata('errormessage', 'Something went wrong!!');
			return redirect('account');
		}

	}
	/*
	*		file upload library function 
	*		-all you need just copy and call this function
	*		-customize $config[] variable(array)
	*		-load library and pass the $config variable
	*		-then call the do_upload() function with file name (from your form)
	*/
	public function do_upload($new_name)
  {
  	// initialize image info
    $config['upload_path']          = 'assets/img/';
    $config['allowed_types']        = 'jpeg|gif|jpg|png';
    $config['file_name'] 						= $new_name;

    //load upload library and initialize it
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    // upload file
    if ( ! $this->upload->do_upload('user_image'))
    {
      $error = array('error' => $this->upload->display_errors());
      $this->session->set_flashdata('errormessage', $error);
    }
    else
    {
      $update = array('upload_data' => $this->upload->data());
    }
  }
	/*
	* getLogOut function is used for logout
	* it will unset/destroy all the session that are being
	*		created during browsing the project 
	*/
	public function getLogOut(){
		/*
		* destroy the session
		* to destroy the session, php session_destroy()
		*		function may be used
		* then redirect the home/main page
		*/
		$this->session->sess_destroy();
		return redirect('/');
	}
}
