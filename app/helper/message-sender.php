<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class GmailSender
{

    public function send($to, $subject, $template): bool
    {

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nguyenhoanghiep478@gmail.com';
            $mail->Password = 'gqifrbhuteavupgh';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('nguyenhoanghiep478@gmail.com', 'Siuuuuu Shop');
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $template;
            $mail->send();
        } catch (Exception $e) {
            echo '' . $e->getMessage();
        }
        return true;
    }



    function getVerifyTemplate($name, $verifyUrl)
    {
        return "
        <div style='font-family: Arial, sans-serif; max-width:600px; margin:auto; padding:20px; border:1px solid #e0e0e0; border-radius:8px;'>
            <h2 style='color:#333;'>Chào {$name},</h2>
            <p>Cảm ơn bạn đã đăng ký tài khoản tại <b>Siuuuuu Shop</b>.</p>
            <p>Vui lòng nhấn vào nút bên dưới để xác thực tài khoản của bạn:</p>
            <a href='{$verifyUrl}' style='display:inline-block; padding:12px 24px; background-color:#28a745; color:white; text-decoration:none; border-radius:5px;'>
                Xác Thực Tài Khoản
            </a>
            <p style='margin-top:20px;'>Nếu bạn không đăng ký tài khoản, vui lòng bỏ qua email này.</p>
            <hr>
            <p style='font-size:12px; color:#888;'>Siuuuuu Shop © 2024</p>
        </div>
        ";
    }

    function getForgotPasswordTemplate($userName, $resetUrl)
    {
        return "
    <div style='font-family: Arial, sans-serif; max-width:600px; margin:auto; padding:20px; border:1px solid #e0e0e0; border-radius:8px; background-color: #f9f9f9;'>
        <h2 style='color:#333;'>Xin chào {$userName},</h2>
        <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu từ bạn.</p>
        <p>Vui lòng nhấn vào nút bên dưới để tiến hành đặt lại mật khẩu:</p>

        <a href='{$resetUrl}' 
            style='display:inline-block; padding:12px 24px; background-color:#007bff; color:white; text-decoration:none; border-radius:5px; margin:20px 0;'>
            Đặt lại mật khẩu
        </a>

        <p>Nếu bạn không yêu cầu, vui lòng bỏ qua email này. Liên kết sẽ hết hạn sau 30 phút.</p>

        <hr style='margin-top:30px;'>
        <p style='font-size:12px; color:#888;'>Siuuuuu Shop © 2024</p>
    </div>
    ";
    }


    public function generateToken()
    {
        return bin2hex(random_bytes(32));
    }
}
