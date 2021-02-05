
$(document).ready(function sendEmail(){
    var mail = 'mailto:Mail.invite.com?subject=Mail Invitation&body=For sending mail invitation please Ctrl + click link below %0D%0Afile:///\\\apckrm06a\\Namlos\\Kaizen_mails\\Kaizen_Mail\\Testing\\bin\\Debug\\Testing.exe';
    var a = document.createElement('a');
    a.href = mail;
    a.click();
}
);