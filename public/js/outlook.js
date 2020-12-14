// var nodeoutlook = require('nodejs-nodemailer-outlook');

// nodeoutlook.sendEmail({
//     auth:{
//         user:"fadelcahyomanggolo.dibyo@mattel.com",
//         pass:"Mattel1"
//     },
//     from: 'LeanInsight@mattel.com',
//     to: 'gabriella.keysiarahamis@mattel.com',
//     subject: 'Hey you, awesome!',
//     html: '<b>This is bold text</b>',
//     text: 'This is text version!',
//     replyTo: 'fadelcahyo11@gmail.com',
//     onError: (e) => console.log(e),
//     onSuccess: (i) => console.log(i)
// });

var nodemailer = require('nodemailer');

// // Create the transporter with the required configuration for Outlook
// // change the user and pass !
// var transporter = nodemailer.createTransport({
//     host: "smtp-mail.outlook.com", // hostname
//     secureConnection: false, // TLS requires secureConnection to be false
//     port: 587, // port for secure SMTP
//     tls: {
//        ciphers:'SSLv3'
//     },
//     auth: {
//         user: 'fadelcahyomanggolo.dibyo@mattel.com',
//         pass: 'Mattel1'
//     }
// });

// // setup e-mail data, even with unicode symbols
// var mailOptions = {
//     from: '"Our Code World " <fadelcahyomanggolo.dibyo@mattel.com>', // sender address (who sends)
//     to: 'gabriella.keysiarahamis@mattel.com, mymail2@mail.com', // list of receivers (who receives)
//     subject: 'Hello ', // Subject line
//     text: 'Hello world ', // plaintext body
//     html: '<b>Hello world </b><br> This is the first email sent with Nodemailer in Node.js' // html body
// };

// // send mail with defined transport object
// transporter.sendMail(mailOptions, function(error, info){
//     if(error){
//         return console.log(error);
//     }

//     console.log('Message sent: ' + info.response);
// });

function sendMail(){
    
    var transporter = nodemailer.createTransport({
        host: "smtp-mail.outlook.com", // hostname
        secureConnection: false, // TLS requires secureConnection to be false
        port: 587, // port for secure SMTP
        auth: {
          user: 'fadelcahyomanggolo.dibyo@mattel.com',
          pass: 'Mattel1'
        }
      });
      
      var mailOptions = {
        from: 'fadelcahyomanggolo.dibyo@mattel.com',
        to: 'gabriella.keysiarahamis@mattel.com',
        subject: 'Sending Email using Node.js',
        text: 'That was easy!'
      };
      
      transporter.sendMail(mailOptions, function(error, info){
        if (error) {
          console.log(error);
        } else {
          console.log('Email sent: ' + info.response);
        }
      });
}


