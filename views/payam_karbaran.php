<?php
include plugin_dir_path(__FILE__).'/jdf.php';
$mrn_isinbox=$_GET['page'] === 'marn_message_inbox' ?true :false;
$mrn_sended='پیام های ارسالی';
$mrn_dariaft='پیام های دریافتی';
$mrn_page_title=$mrn_isinbox ? $mrn_dariaft : $mrn_sended;

function mrngetmessage($isinbox){
    global $wpdb;
    $query;
    $mrn_table=$wpdb->prefix."user_message";

    $current_userid=get_current_user_id();

    if($isinbox){
        $query="SELECT * FROM {$mrn_table} WHERE to_user = {$current_userid} ";
    }else{
        $query="SELECT * FROM {$mrn_table} WHERE from_user = {$current_userid} ";
    }

    $query .= "ORDER BY id DESC";

    return  $wpdb->get_results($query,OBJECT);
}

function mrn_get_username($userID){
    if($user=get_user_by('id',$userID)){
        return $user->user_login;
    }
}


function mrn_convert_date($date){
    if(function_exists('jdate')){
        return jdate('m F Y ساعتH:i:s',$date);
    }
}
?>
<div class="wrap">
    <h2><?= $mrn_page_title; ?></h2>
    <div></div>
<?php
$mrn_girande='گیرنده';
$mrn_ferestande='فرستنده';
$mrn_tarikh_ersal='تاریخ ارسال';
$mrn_tarikh_daryaft='تاریخ دریافت';
?>
    <table class="widefat">
    <thead>
    <tr>
            <th>ردیف</th>
            <th>عنوان پیام</th>
            <th><?= $mrn_isinbox ?  $mrn_ferestande: $mrn_girande ;?></th>
            <th><?= $mrn_isinbox ?  $mrn_tarikh_ersal :$mrn_tarikh_daryaft ;?></th>
            <th>نوع پیام</th>
            <th>وضعیت</th>
    </tr>
    </thead>
        <tbody>
        <?php if($mrn_message =mrngetmessage($mrn_isinbox)):  ?>
        <?php foreach($mrn_message as $message): ?>
        <tr>
            <td>پیام</td>   
            <td><?php echo $message->subject;?></td>  
            <td><?php echo $mrn_isinbox ? mrn_get_username($message->from_user) : mrn_get_username($message->to_user);  ?></td>  
            <td><?= mrn_convert_date($message->sent_at); ?></td>  
            <td>پیام</td>  
            <td>پیام</td>  
        </tr>
        <?php endforeach; ?>
        <?php  endif;?>
        <tr>
            <td>پیام</td>   
            <td>پیام</td>  
            <td>پیام</td>  
            <td>پیام</td>  
            <td>پیام</td>  
            <td>پیام</td>  
        </tr>
        <tr>
            <td>پیام</td>   
            <td>پیام</td>  
            <td>پیام</td>  
            <td>پیام</td>  
            <td>پیام</td>  
            <td>پیام</td>  
        </tr>
        </tbody>
    
    </table>
</div>