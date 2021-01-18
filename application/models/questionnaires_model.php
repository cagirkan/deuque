<?php
class questionnaires_model extends CI_Model
{
    public function getUsersQns($userId)
    {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('questionnaires');
        return $query->result();
    }
    public function getRecentQns()
    {
        $this->db->order_by('datetime_created', 'DESC');
        $query = $this->db->get('questionnaires', 5);
        return $query->result();
    }
    public function getPopularQns()
    {
        $this->db->order_by('participant_count', 'DESC');
        $query = $this->db->get('questionnaires', 5);
        return $query->result();
    }
    public function getSearchedQns($searched)
    {
        $this->db->like('questionnaire_name', $searched, 'both');
        $this->db->or_like('questionnaire_subtext', $searched, 'both');
        $query = $this->db->get('questionnaires');

        return $query->result();
    }
    public function getSearchedUsers($searched)
    {
        $this->db->like('user_name', $searched, 'both');
        $this->db->or_like('name', $searched, 'both');
        $this->db->or_like('surname', $searched, 'both');
        $query = $this->db->get('users');

        return $query->result();
    }

    public function getQnsCount($userId)
    {
        $query = $this->db->query("SELECT COUNT(*) FROM questionnaires WHERE user_id = ".$userId);
        return $query->result();
    }

    public function getUserById($userId)
    {
        $this->db->where('user_id', $userId);
        $query = $this->db->get('users');
        return $query->result();
    }

    public function getQn($qnId){
        $this->db->where('questionnaire_id', $qnId);
        $query = $this->db->get('questionnaires');
        return $query->result();
    }

    public function getQuestions($qnId){
        $this->db->where('questionnaire_id', $qnId);
        $query = $this->db->get('questions');
        return $query->result();
    }

    public function insertQn($qnId){
        $data = array(
            'questionnaire_id' => $qnId,
            'user_id' => $this->session->userdata('user_id'),
            'questionnaire_type' => 0,
            'questionnaire_name' => $this->input->post('qnName'),
            'questionnaire_subtext' => $this->input->post('description'),
            'participant_count' => 0,
            'publish_status' => 0,
        );

        return $this->db->insert('questionnaires', $data);
    }
    public function insertQuestion(){
        $data = array(
            'questionnaire_id' => $this->input->post('qnId'),
            'question_name' => $this->input->post('questionName'),
            'question_subtext' => $this->input->post('questionDescription'),
            'option_1' => $this->input->post('option1'),
            'option_2' => $this->input->post('option2'),
            'option_3' => $this->input->post('option3'),
            'option_4' => $this->input->post('option4'),
            'option_5' => $this->input->post('option5'),
            'option_6' => $this->input->post('option6'),
            'option_7' => $this->input->post('option7'),
            'option_8' => $this->input->post('option8'),
        );
       /* $length = 8;
        $optCount = 0;
        for ($i=1;$i<=$length;$i++) {
            $entry = $this->input->post("option".$i);
            if (!empty($entry)) {
                $data["sib".$i] = $entry;
                $sibcount++;
            }
        }*/

        return $this->db->insert('questions', $data);
    }

}
