import smtplib


def send_email(to_email, verification_code):
    # Replace with your Gmail email address
    gmail_user = 'arongeorgejain2025@mca.ajce.in'
    gmail_password = 'A2r0o0n2'  # Replace with your Gmail password

    subject = 'Email verification'
    body = f'''\
        <html>
            <body>
                <p>Dear User,</p>
                <p>We received a request to activate your password.</p>
                <p>Kindly click the below link to activate:</p>
                <a href="http://localhost/supermarket/newpassword.php">http://localhost/supermarket/newpassword.php</a>
                <br><br>
                <p>With regards,</p>
                <p>The Corner Store</p>
            </body>
        </html>
    '''

    email_text = f'''\
    From: {gmail_user}
    To: {to_email}
    Subject: {subject}
    MIME-Version: 1.0
    Content-Type: text/html
    {body}
    '''

    try:
        server = smtplib.SMTP_SSL('smtp.gmail.com', 465)
        server.ehlo()
        server.login(gmail_user, gmail_password)
        server.sendmail(gmail_user, to_email, email_text)
        server.close()
        print('Email sent!')
        return True
    except Exception as e:
        print('Something went wrong:', e)
        return False