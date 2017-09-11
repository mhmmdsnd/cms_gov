<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/17/2017
 * Time: 1:44 PM
 */
class Trncomment_model extends CI_Model
{
    private $trn_comment = 'trn_usercomment';
    private $sys_users = 'sys_users';
    private $case_id = 'caseId';

    function getCommentCase($caseId)
    {
        $comment = array();
        $this->db->select('caseId, commentId, pcommentId, comment, dateComment,statusComment, userId, concat(firstname," ",lastname) as author ');
        $this->db->from($this->trn_comment);
        $this->db->join($this->sys_users,$this->trn_comment.'.userId = '.$this->sys_users.'.id', 'inner');
        $this->db->where($this->case_id,$caseId);
        $this->db->order_by('commentId','asc');
        $result = $this->db->get();
        foreach ($result->result() as $rst)
        {
            $comment[] = array('caseId' =>$rst->caseId, 'commentId'=>$rst->commentId,'pcommentId'=>$rst->pcommentId,
                'comment'=>$rst->comment,'dateComment'=>$rst->dateComment, 'statusComment'=>$rst->statusComment
            , 'userId'=>$rst->userId,'author'=>$rst->author);
        }
        return $comment;
    }
    function addComment ($data)
    {
        $this->db->insert($this->trn_comment,$data);
        return $this->db->insert_id();
    }
}