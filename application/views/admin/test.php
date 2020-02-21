<pre>
<?php
// print_r($posts);
print_r("----------");
print_r($tests);


foreach ($posts as $post) {
    $data = $this->Post_model->fetchAll_subject_subjectInfo($post['id']);
    // echo $data[0]['name_thai'];
}
?>
</pre>

data-idpost="<?= $post['post_id']; ?>"
data-idsubinfo="<?= $post['poif_id']; ?>"
data-idsubject="<?= $post['sj_id']; ?>"
data-sec="<?= $post['poif_section']; ?>"
data-term="<?= $post['poif_term']; ?>"
data-years="<?= $post['poif_years']; ?>"
data-teacherid="<?= $post['tc_id']; ?>"
data-daywork="<?= $post['poif_daywork']; ?>"
data-timeworkstart="<?= $post['poif_timework_start']; ?>"
data-timeworkend="<?= $post['poif_timework_end']; ?>"
data-workstart="<?= $post['poif_work_start']; ?>"
data-workend="<?= $post['poif_work_end']; ?>"
data-nisitnum="<?= $post['poif_num_st']; ?>"
data-url="<?= $post['poif_url']; ?>"
data-quali="<?= $post['post_qualification']; ?>"
data-status="<?= $post['post_status']; ?>"
data-toggle="modal" data-target="#updatePost"