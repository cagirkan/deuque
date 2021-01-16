<?php

    class main extends CI_Controller{

        public function index(){

            $this->load->view("index.php");

        }

        public function data(){
            $this->load->model("answers_model");
            $data['answers'] = $this->answers_model->getAllData();

            $this->load->view("answers.php",$data);
        }

        public function login(){
            $this->load->view("login.php");
        }

        public function signup(){
            $this->load->view("signup.php");
        }
        public function profile(){
            $this->load->view("profile.php");
        }
        public function aboutUs(){
            $this->load->view("about-us.php");
        }
        public function show(){
            $this->load->view("show.php");
        }
        public function contact(){
            $this->load->view("contact.php");
        }
        public function questionnaires(){
            $this->load->view("questionnaires.php");
        }
        public function questionnaire(){
            $this->load->view("questionnaire.php");
        }



    }

?>