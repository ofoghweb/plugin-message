<div class="wrap">
    <h2>ارسال پیام جدید</h2>
    <form action="" method="post">
        <div class="notice ">
            <p>برای ارسال پیام می توانید از طریق
                <span style="color: red">شناسه کاربری</span>
                یا
                <span style="color: red">ایمیل کاربر</span>
                اقدام کنید</p>
        </div>
        <div>
            <?php
            do_action('mrn_befor_send_message');
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
        <input type="submit" class="button-primary" value="ارسال پیام" id="send">
    </form>
</div>