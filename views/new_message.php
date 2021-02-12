<div class="wrap">
    <h2 > پیام جدید </h2>

    <?php
    function mrn_to_user($username_or_email){
        if(is_email($username_or_email)){
            return email_exists($username_or_email);
        }else{
            if ($user=get_user_by('login',$username_or_email)){
                return $user->ID;
            }

        }
        return false;
    }

    function mrn_motice($message,$type){
        echo <<<NOTICE
<div class="notice is-dismissible notice-{$type}"><p>$message</p></div>
NOTICE;

    }

    function mrn_send_message($from,$to,$subject,$type,$message){
        global $wpdb;

        $table=$wpdb->prefix.'user_message';

        return $wpdb->insert(
                $table,
                array(
                    'from_user' =>$from,
                    'to_user' => $to,
                    'subject' =>$subject,
                    'message' => $message,
                    'type' => $type,
                    'sent_at' =>current_time('mysql')
                ),
                array(
                        '%d','%d','%s','%s','%d','%s'
                )
        );
    }

if (isset($_POST['send'])){
    $mrn_from_user=get_current_user_id();
    if (  $mrn_to_user=mrn_to_user($_POST['payam_karbaran_girande'])){
        if ($mrn_to_user == $mrn_from_user){
            mrn_motice('شما نمی توانید به خودتان پیام ارسال کنید','error');
        }else{
            $mrn_message_data=array(
                'from'     =>$mrn_from_user,
                'to'       =>$mrn_to_user,
                'subject'  =>$_POST['payam_karbaran_mozo'],
                'type'     =>in_array($mrn_TYPE=absint($_POST['mamoli_or_zarori']),array(1,2))?$mrn_TYPE:1,
                'message'  =>esc_html($_POST['payam_karbaran_matn']),


            );
            if (mrn_send_message(
	            $mrn_message_data['from'],
	            $mrn_message_data['to'],
	            $mrn_message_data['subject'],
	            $mrn_message_data['type'],
	            $mrn_message_data['message']
            )){
                mrn_motice('پیام شما با موفقیت ارسال شد','success');

            }else{
               mrn_motice('خطا در ارسال پیام','error');

            }
        }
    }else{
	    mrn_motice('گاربر مورد نظر موجود نیست' ,'error');
    }

}

    ?>
    <form action="" method="post">
        <div class="notice notice-info">
            <p>برای ارسال پیام می توانید از طریق
                <span style="color: red">شناسه کاربری</span>
                یا
                <span style="color: red">ایمیل کاربر</span>
                اقدام کنید</p>
        </div>
        <div>
            <?php
            do_action('mrn_new_message');
            ?>
        </div>
        <p>
        <span style="color: red">*</span>
        <label for="payam_karbaran_girande">گیرنده</label><br>
        <input type="text" class="ltr" required name="payam_karbaran_girande" id="payam_karbaran_girande">
        </p>
        <p>
        <span style="color: red">*</span>
        <label for="payam_karbaran_mozo">موضوع</label><br>
        <input type="text"  required name="payam_karbaran_mozo" id="payam_karbaran_mozo">
        </p>
        <p>
        <span style="color: red">*</span>
        <label for="payam_karbaran_matn">متن پیام</label><br>
        <textarea name="payam_karbaran_matn" required id="payam_karbaran_matn" cols="30" rows="10"></textarea>
        </p>
        <p>
            <label for="mamoli_or_zarori">نوع پیام</label><br>
            معمولی<input type="radio" name="mamoli_or_zarori" value="1" checked>
            ضروری <input type="radio" name="mamoli_or_zarori" value="2">
        </p>
        <input type="submit" name="send" class="button-primary" value="ارسال پیام" id="send">
    </form>
</div>