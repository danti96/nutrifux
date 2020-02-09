<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class esteticista extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('esteticista_model');
        $this->load->library('upload');
        $this->load->model('department/department_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group(array('admin', 'Accountant'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['esteticistas'] = $this->esteticista_model->getesteticista();
        $data['departments'] = $this->department_model->getDepartment();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('esteticista', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $department = $this->input->post('department');
        $profile = $this->input->post('profile');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[10]|xss_clean');
        // Validating Department Field   
        $this->form_validation->set_rules('department', 'Department', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('profile', 'Profile', 'trim|required|min_length[5]|max_length[50]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['departments'] = $this->department_model->getDepartment();
                $data['esteticista'] = $this->esteticista_model->getesteticistaById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['departments'] = $this->department_model->getDepartment();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'department' => $department,
                    'profile' => $profile
                );
            } else {
                $error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'department' => $department,
                    'profile' => $profile
                );
            }
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New esteticista
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'Esta dirección de correo electrónico ya está registrada');
                    redirect('esteticista/addNewView');
                } else {
                    //registramos los datos en la tabla users
                    $dfg = 4;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    //obtenemos el registro del usuario de la tabla de users
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    //consulta el id de la tabla users
                    $esteticista_user_id = $this->db->get_where('esteticista', array('email' => $email))->row()->id;
                    //agregamos la ion_user_id el array $data
                    $data['ion_user_id'] =  $ion_user_id ;
                    //array_push( $data,'ion_user_id', $ion_user_id );
                    //$id_info = array('ion_user_id' => $ion_user_id);
                    //$this->esteticista_model->updateEsteticista($esteticista_user_id, $id_info);
                    //Realiza el insert en la tabla esteticista
                    $this->esteticista_model->insertEsteticista($data);
                    $this->session->set_flashdata('feedback', 'Added');
                }
            } else { // Updating esteticista
                $ion_user_id = $this->db->get_where('esteticista', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->esteticista_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->esteticista_model->updateEsteticista($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('esteticista');
        }
    }

    function editesteticista() {
        $data = array();
        $data['departments'] = $this->department_model->getDepartment();
        $id = $this->input->get('id');
        $data['esteticista'] = $this->esteticista_model->getesteticistaById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editesteticistaByJason() {
        $id = $this->input->get('id');
        $data['esteticista'] = $this->esteticista_model->getesteticistaById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('esteticista', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->esteticista_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('esteticista');
    }

    function getesteticista() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['esteticistas'] = $this->esteticista_model->getesteticistaBysearch($search);
            } else {
                $data['esteticistas'] = $this->esteticista_model->getesteticista();
            }
        } else {
            if (!empty($search)) {
                $data['esteticistas'] = $this->esteticista_model->getesteticistaByLimitBySearch($limit, $start, $search);
            } else {
                $data['esteticistas'] = $this->esteticista_model->getesteticistaByLimit($limit, $start);
            }
        }
        //  $data['esteticistas'] = $this->esteticista_model->getesteticista();

        foreach ($data['esteticistas'] as $esteticista) {
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                //  $options1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" title="'.lang('edit').'" data-toggle="modal" data-id="'.$esteticista->id.'"><i class="fa fa-edit"> </i> '.lang('edit').'</button>';
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<a class="btn btn-info btn-xs btn_width" title="' . lang('edit') . '" href="esteticista/editesteticista?id=' . $esteticista->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            $options2 = '<a class="btn btn-info btn-xs detailsbutton" title="' . lang('appointments') . '"  href="appointment/getAppointmentByesteticistaId?id=' . $esteticista->id . '"> <i class="fa fa-calendar"> </i> ' . lang('appointments') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options3 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="esteticista/delete?id=' . $esteticista->id . '" onclick="return confirm(\'¿Está seguro de que desea eliminar este elemento?\');"><i class="fa fa-trash-o"> </i> ' . lang('delete') . '</a>';
            }

            $info[] = array(
                $esteticista->id,
                $esteticista->name,
                $esteticista->email,
                $esteticista->address,
                $esteticista->phone,
                $esteticista->department,
                $esteticista->profile,
                $options1 . ' ' . $options2 . ' ' . $options3,
               // $options2 . ' ' . $options3,
                    //  $options2
            );
        }

        if (!empty($data['esteticistas'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('esteticista')->num_rows(),
                "recordsFiltered" => $this->db->get('esteticista')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

}

/* End of file esteticista.php */
/* Location: ./application/modules/esteticista/controllers/esteticista.php */