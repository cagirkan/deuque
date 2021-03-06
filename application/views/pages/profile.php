<?php
if ($this->session->userdata('currently_logged_in'))
    include dirname(__DIR__, 1) . '/sections/header-user.php';
else
    include dirname(__DIR__, 1) . '/sections/header.php';
$questionnaires = json_decode(json_encode($usersQns), true);
$userInfo = json_decode(json_encode($user), true);
$qnsCount = json_decode(json_encode($count), true);
?>
<div class="container">

    <div class="row mt-5 ml-3">
        <div class="col-md-4 col-4">
            <div class="card">
                <div class="d-flex justify-content-center">
                    <img alt="" class="card-img-top rounded-circle pt-4" src="<?php echo base_url() ?>assets/img/ibrahim.jpg">
                </div>
                <div class="p-4">
                    <dd class="text-dark"><strong><?php echo $userInfo[0]['name'] . ' ' . $userInfo[0]['surname']?></strong>
                    <dd class="text-info"><?php echo $userInfo[0]['user_name']?>
                    <dd class="profile-rank"><strong>Type: </strong><?php echo $userInfo[0]['user_type'] ? 'Admin' : 'Member';?>
                    <dd class="questionnaire-count"><strong>Questionnaires:</strong> <?php echo $qnsCount[0]['COUNT(*)']; ?>
                    <dd class="profile-joined"><strong>Joined:</strong> <?php echo $userInfo[0]['user_joinDate']?>
                </div>
            </div>
        </div>
        <div class="col-8">
            <h2><strong>QUESTIONNAIRES</strong></h2>
            <ul class=" list-group p-2">
                <?php
                foreach ($questionnaires as $row)
                {
                    if($row['publish_status']){
                        $qnStatus['color'] = 'btn-secondary';
                        $qnStatus['state'] = 'disabled';
                    }
                    else{
                        $qnStatus['color'] = 'btn-primary';
                        $qnStatus['state'] = '';
                    }
                    echo '<li class="d-flex justify-content-between list-group-item"><a href="' .base_url(). 'fill/' .$row['questionnaire_id']. '">' . $row['questionnaire_name'] . '</a>
    <div>
        <a href ="'.base_url().'edit/'.$row['questionnaire_id'].'"><button class="'.$qnStatus['color'].'" '.$qnStatus['state'].'>Edit <i class="fa fa-pencil"></i></button></a>
        <a href="'.base_url().'publish/'.$row['questionnaire_id'].'"><button class="'.$qnStatus['color'].'" '.$qnStatus['state'].'>Publish <i class="fa fa-toggle-on"></i></button></a>
        <input type="text" value="'.base_url().'fill/'.$row['questionnaire_id'].'" id="myInput">


<button class="btn-primary" onclick="myFunction(\''.base_url().'fill/'.$row['questionnaire_id'].'\')">
  Copy<i class="fa fa-share-alt" ></i>
  </button>


    </div>
</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<script>
    function myFunction(url) {
        copyToClipboard(url);
    }

    function copyToClipboard(text) {
        var dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
    }
</script>
<?php include dirname(__DIR__, 1) . '/sections/footer.php';?>
