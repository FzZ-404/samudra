<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_model extends CI_Model {

  /* kompat: dipanggil index admin lama */
  public function get_all(){ return $this->all(); }

  /* === QUIZZES === */
  public function all(){
    return $this->db->order_by('id','DESC')->get('quizzes')->result();
  }
  public function published(){
    return $this->db->where('published',1)->order_by('id','DESC')->get('quizzes')->result();
  }
  public function find($id){
    return $this->db->get_where('quizzes',['id'=>$id])->row();
  }
  public function create($data){
    $this->db->insert('quizzes',$data);
    return $this->db->insert_id();
  }
  public function update($id,$data){ return $this->db->update('quizzes',$data,['id'=>$id]); }
  public function delete($id){ return $this->db->delete('quizzes',['id'=>$id]); }

  /* === QUESTIONS + CHOICES === */
  public function add_question($quiz_id,$question){
    $this->db->insert('quiz_questions',[
      'quiz_id'=>$quiz_id,
      'question'=>$question
    ]);
    return $this->db->insert_id();
  }

  public function add_choice($question_id,$text,$is_correct=0){
    return $this->db->insert('quiz_choices',[
      'question_id'=>$question_id,
      'choice_text'=>$text,
      'is_correct'=>$is_correct?1:0
    ]);
  }

  /* === ATTEMPTS (untuk sisi user, biarkan ada) === */
  public function start_attempt($quiz_id,$user_id){
    $this->db->insert('quiz_attempts',[
      'quiz_id'=>$quiz_id,
      'user_id'=>$user_id,
      'started_at'=>date('Y-m-d H:i:s')
    ]);
    return $this->db->insert_id();
  }
  public function save_answer($attempt_id,$question_id,$choice_id,$is_correct){
    $this->db->insert('quiz_answers',[
      'attempt_id'=>$attempt_id,
      'question_id'=>$question_id,
      'choice_id'=>$choice_id,
      'is_correct'=>$is_correct
    ]);
  }
  public function finish_attempt($attempt_id,$score){
    $this->db->update('quiz_attempts',[
      'score'=>$score,
      'finished_at'=>date('Y-m-d H:i:s')
    ],['id'=>$attempt_id]);
  }
}
