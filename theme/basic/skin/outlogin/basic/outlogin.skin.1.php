<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);

//커뮤니티 그룹 리스트
$community = sql_query("SELECT bo_table,bo_subject FROM g5_board where gr_id='community' order by bo_subject desc");
//정보 그룹 리스트
$info = sql_query("SELECT bo_table,bo_subject FROM g5_board where gr_id='info' order by bo_subject desc");
?>

<!-- 로그인 전 아웃로그인 시작 { -->
<?php if (strpos($_SERVER['PHP_SELF'], "bbs")): ?>
<div class="aside-wrap">
    <section class="aside-box">
        <a href="<?php echo G5_BBS_URL ?>/login.php" class="aside-login">로그인</a>
        <div class="aside-menu aside-home">
            <p class="aside-subtitle">홈</p>
            <ul class="aside-list">
                <li class="new"><a href="<?php echo G5_BBS_URL ?>/new.php">전체</a></li>
            </ul>
        </div>
        <div class="aside-menu aside-info">
            <p class="aside-subtitle">정보</p>
            <ul class="aside-list">
                <?php
                    while ($row = sql_fetch_array($info)) { ?>
                    <li class="<?php echo $row['bo_table'] ?>"><a href="<?php echo G5_BBS_URL."/board.php?bo_table={$row['bo_table']}" ?>"><?php echo $row['bo_subject'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="aside-menu aside-community">
            <p class="aside-subtitle">커뮤니티</p>
            <ul class="aside-list">
                <?php
                    while ($row = sql_fetch_array($community)) { ?>
                    <li class="<?php echo $row['bo_table'] ?>"><a href="<?php echo G5_BBS_URL."/board.php?bo_table={$row['bo_table']}" ?>"><?php echo $row['bo_subject'] ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </section>

</div>
<?php endif ?>

<script>
$omi = $('#ol_id');
$omp = $('#ol_pw');
$omi_label = $('#ol_idlabel');
$omi_label.addClass('ol_idlabel');
$omp_label = $('#ol_pwlabel');
$omp_label.addClass('ol_pwlabel');

$(function() {
    const asideName = ".<?php echo $_GET['bo_table'] ? $_GET['bo_table'] : 'new' ?>";
    $(asideName).addClass('color');
    $("#auto_login").click(function(){
        if ($(this).is(":checked")) {
            if(!confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?"))
                return false;
        }
    });
});

function fhead_submit(f)
{
    return true;
}
</script>
<!-- } 로그인 전 아웃로그인 끝 -->
